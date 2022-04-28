<?php

namespace App\Http\Services;

use Hash;
use App\Models\Shop;

class SyncDatabaseService
{
    public function createOrUpdate($data , $databaseIds)
    {
        if( !in_array($data['id'], $databaseIds))
        {
            $shop = new Shop($data);

            $shop->hash = $this->generateHash($shop);

            return $shop->save();
        }

        $shop = Shop::find($data['id']);

        if (!$this->compareHash($shop->hash , $data))
        {
            $shop->update($data);

            return $shop->save();
        }
    }

    public function syncDelete($excelIds , $databaseIds)
    {
        $toDeleteIds = array_values(array_diff($databaseIds,$excelIds));

        Shop::destroy($toDeleteIds);
    }


    public function generateHash($shop)
    {
        $data = serialize($shop['name'] . $shop['floor'] . $shop['shoplot']);

        $hash = Hash::make($data);

        return $hash;
    }

    public function compareHash($shop_hash , $data)
    {
        $check = Hash::check($shop_hash , $this->generateHash($data));

        return $check;
    }
}