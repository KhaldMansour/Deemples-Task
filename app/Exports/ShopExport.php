<?php

namespace App\Exports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShopExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'id',
            'name',
            'floor',
            'shoplot'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Shop::select('id' , 'name' , 'floor' , 'shoplot')->get();
    }
}
