<?php

namespace App\Imports;

use App\Models\product;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ProductImportMapping implements ToModel ,WithStartRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

        //Handling mapping 

        $NameAttr_Index = session('NameAttr_Index');
        $QtyAttr_Index = session('QtyAttr_Index');
        $TypeAttr_Index = session('TypeAttr_Index');

        //dd( $TypeAttr_Index);

        return new product([
           'name'    => $row[ $NameAttr_Index],
           'qty'     =>  $row[ $QtyAttr_Index], 
           'type'    =>  $row[ $TypeAttr_Index],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}