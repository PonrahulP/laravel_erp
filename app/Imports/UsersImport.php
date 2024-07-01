<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::info('Row data:',$row);
        return new product([
            'product_name'=>$row['product_name'],
            'product_code'=>$row['product_code'],
            'description'=>$row['description'],
            'unit_price'=>$row['unit_price'],
            'quantity'=>$row['quantity'],
            'image'=>$row['image'],
        ]);
    }
}
