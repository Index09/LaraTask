<?php

namespace App\Imports;

use App\Models\product;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ProductImport implements ToModel , WithStartRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

       

        return new product([
           'name'    => $row[0],
           'qty'     =>  $row[1], 
           'type'    =>  ($row[2]),
        ]);
    }


    public function startRow(): int
    {
        return 2;
    }
}