<?php

namespace App\Imports;

use App\Models\Shop;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use App\Http\Services\SyncDatabaseService;



class ShopImport implements ToCollection,WithHeadingRow,WithValidation
{

    protected $syncDatabaseService;

    public function __construct()
    {
        $this->syncDatabaseService = new SyncDatabaseService() ;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $excelIds =[];

        $databaseIds =  Shop::pluck('id')->toArray();

        foreach($rows as $row)
        {
            array_push($excelIds, $row['id']);

            $data = [
                'id' => $row['id'],
                'name' => $row['name'],
                'floor' => $row['floor'],
                'shoplot' => $row['shoplot'],
            ];
            $this->syncDatabaseService->createOrUpdate($data , $databaseIds);
        }

        $this->syncDatabaseService->syncDelete($excelIds , $databaseIds);
    }

    public function rules():array
    {
        return [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'floor' => 'required|numeric',
            'shoplot' => 'required|numeric',
        ];
    }
}
