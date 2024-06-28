<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\Attendance\Exceptions\AlreadyTimeInException;
use App\Services\Attendance\Exceptions\AlreadyTimeOutException;
use App\Services\Attendance\Facades\Attendance;
use App\Services\Attendance\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // dd( Attendance::timeInStatus());
        // $user->getTimeIn();
        // manually set the user other than the logged-in user
        // $time = Attendance::setUser($user)->timeIn();

        try {
            Attendance::setUser($user)->timeIn();
        } catch (AlreadyTimeInException $th) {
            return $this->sendError('Already checked In');
        }

        // $user->logAttendance('in', Attendance::timeInStatus());

        return $this->sendResponse(Attendance::timeInStatus(),__('ApiMessage.retrievedMessage'));
    }

    public function getAttendance($userId, Request $request)
    {
        $user = User::find($userId);

        if(!$user) {
            return $this->sendError('User not found.');
        }

        $start = $request->start;
        $end = $request->end;

        if(!isset($start) || !isset($end)) {
            $month = '2024-06';
            $start = Carbon::parse($month)->startOfMonth();
            $end = Carbon::parse($month)->endOfMonth();
        }
        
        $response = $this->getMonthlyAttendance($user->id, $start, $end);

        return $this->sendResponse($response,__('ApiMessage.retrievedMessage'));
    }

    function getAllDaysOfMonth($start, $end)
    {
        $period = CarbonPeriod::create($start, $end)->toArray();
        $weekdays = [];
        foreach ($period as $date) {
            if (!$date->isWeekend()) {
                $weekdays[] = $date;
            }
        }
        
        return $weekdays;
    }

    public function getMonthlyAttendance($userId, $start, $end)
    {
        // Generate all days in the month
        $daysInMonth = $this->getAllDaysOfMonth($start, $end);

        // Fetch attendance records for the user in the specified month
        $attendanceRecords = AttendanceLog::where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->where('type', 'in')
            ->get()
            ->keyBy('date'); // Key by date for easier lookup

        // Initialize counters
        $presentCount = 0;
        $absentCount = 0;

        // return $attendanceRecords['2024-06-28'];
        // Iterate through each day of the month
        foreach ($daysInMonth as $day) {
            $date = $day->format('Y-m-d');
            if (isset($attendanceRecords[$date])) {
                // Check the status of the attendance record for the current day
                if ($attendanceRecords[$date]->status == 'on-time' || $attendanceRecords[$date]->status == 'late') {
                    $presentCount++;
                } else {
                    $absentCount++;
                }
            } else {
                // No record means absent
                $absentCount++;
            }
        }

        return [
            'present_count' => $presentCount,
            'absent_count' => $absentCount,
        ];
    }

    public function getMonthlyAttendanceOld($userId, $month)
    {
        $attendanceCounts = AttendanceLog::where('user_id', $userId)
            ->whereMonth('date', Carbon::parse($month)->month)
            ->whereYear('date', Carbon::parse($month)->year)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $presentCount = $attendanceCounts['present'] ?? 0;
        $absentCount = $attendanceCounts['absent'] ?? 0;

        return $attendanceCounts;
        return [
            'present_count' => $presentCount,
            'absent_count' => $absentCount,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
