<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    public function Import(Request $request){

     


      //save file localy
      $FileName = time().'.'.$request->ExcelFile->getClientOriginalExtension();
      $request->ExcelFile->move(public_path(''), $FileName);

      Excel::import(new ProductImport,public_path($FileName) );
        
      return redirect('/')->with('success', 'All good!');

     





      

    }

     public function ImportView()
    {
        return view('product.import');
    }
    
}
