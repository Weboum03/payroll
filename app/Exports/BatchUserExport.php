<?php
  
namespace App\Exports;
  
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class BatchUserExport implements FromCollection, WithHeadings
{
    protected $data;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return collect($this->data);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [
            'Unique ID',
            'EMP ID',
            'Employee Name',
            'Date of Joining',
            'Worker Type',
            'Job Title',
            'Department',
            'Location',
            'Gender',
            'Date of Birth',
            'PAN Number',
            'Payroll Month',
            'Actual Payable days',
            'Working days',
            'Loss of Pay days',
            'Days Payable',
            'Gross Salary',
            'Deduction',
            'Net Pay'
        ];
    }
}