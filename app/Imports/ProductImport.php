<?php

namespace App\Imports;

use App\Models\product;

use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

        //Handling mapping 

        return new product([
           'name'    => $row[0],
           'qty'     =>  (int)$row[1], 
           'type'    =>  ($row[2]),
        ]);
    }
}