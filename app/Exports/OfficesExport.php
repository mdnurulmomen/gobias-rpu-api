<?php

namespace App\Exports;

use App\Models\Office;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class OfficesExport implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $offices_list;

    public function __construct(array $offices_list)
    {
        $this->offices = $offices_list;
    }

    public function array(): array
    {
        return $this->offices;
    }

//    public function headings(): array
//    {
//        return [
//            'office_name_bng',
//            'office_name_eng',
//        ];
//    }
}
