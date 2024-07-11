<?php
  
namespace App\Exports;
  
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class UsersExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $heading;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data, $heading = [])
    {
        $this->data = $data;
        $this->heading = $heading;
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
        if(!empty($this->heading)) {
            return $this->heading;
        }
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
            'Secondory Email',
            'Mobile',
            'Alternate Mobile',
            'Gender',
            'Date of Birth',
            'Password',
            'Local Address Line 1',
            'Local Address Line 2',
            'Local City/Town',
            'Local Country',
            'Local State',
            'Local Post Code',
            'Permanent Address Line 1',
            'Permanent Address Line 2',
            'Permanent City/Town',
            'Permanent Country',
            'Permanent State',
            'Permanent Post Code',
            'Employee ID',
            'Date of joining',
            'Probation End Date',
            'Company',
            'Location',
            'Qualification Degree',
            'Work Experience',
            'Immediate Manager',
            'Immediate Manager Employee Code',
            'Leave Approving Authority',
            'Leave Approving Authority Employee Code',
            'Department',
            'Job Role',
            'Grade',
            'Employement Type',
            'Aadhar Number',
            'PAN Number',
            'Holiday Year',
            'Work Pattern',
            'Salary',
            'Annual Earned Leave Entilement',
            'This Year',
            'Next Year',
        ];
    }
}