<?php
  
namespace App\Exports;
  
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class BatchExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $column;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data, $column)
    {
        $this->data = $data;
        $this->column = $column;
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
            'First Name',
            'Last Name',
            'Company',
            'Location',
            $this->column
        ];
    }
}