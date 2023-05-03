<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Imports\ProductImport;
use App\Imports\ProductImportMapping;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use Maatwebsite\Excel\HeadingRowImport;

class ProductController extends Controller
{
  public function Import(Request $request)
  {




    //save file localy
    $FileName = time() . '.' . $request->ExcelFile->getClientOriginalExtension();
    $request->ExcelFile->move(public_path(''), $FileName);

    //get Excel Headers
    $headings = (new HeadingRowImport)->toArray(public_path($FileName))[0][0];
    //Pre stored Products table to be matched
    $NormalHeaders = ['name', 'type', 'qty'];

    
    if ($this->array_equal($headings, $NormalHeaders)) {    // Same headers Matched 

      //Make Normal Import 
      Excel::import(new ProductImport, public_path($FileName));
      return redirect('/')->with('status', 'Done');
    } else {
      //Save File Name to Session 
      session(['LastFile' => $FileName]);  
      return redirect('/ConfirmImport')->with('headers', $headings);
    }
  }

  public function ImportView()
  {
    return view('product.import');
  }

  public function ConfirmImportView()
  {

    return view('product.confirm');
  }

  public function ConfirmImport(Request $request)
  {

    //Save mapped data to session
    session([
      'NameAttr_Index' => intval($request->NameAttr_Index),
      'TypeAttr_Index' => intval($request->TypeAttr_Index),
      'QtyAttr_Index' => intval($request->QtyAttr_Index),

    ]);


    Excel::import(new ProductImportMapping, public_path(session('LastFile')));
    return redirect('/')->with('status', 'Done !');
  }

  public function array_equal($a, $b)
  {   //Function used to match headers between excel file and products table
    return (is_array($a)
      && is_array($b)
      && count($a) == count($b)
      && array_diff($a, $b) === array_diff($b, $a)
    );
  }
}
