<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;


class ExcelExport implements ShouldAutoSize, WithHeadings, WithMapping, FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
  
    public function array(): array
    {
     
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Ürün',
            'Fiyat',
        ];
    }

   public function map($register): array
   {
    return [
        $register['title'],
        $register['price'],
    ];
   }

}
