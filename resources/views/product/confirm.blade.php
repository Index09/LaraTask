@extends('layouts.app')




@section('content')

@php
    
$headers = session('headers');

@endphp
<h4> Excel headers didn`t match Products Table attributes </h4>

<form action="/ConfirmImport" enctype="multipart/form-data" method="post">
    @csrf
    <label class="custom-uploader">Products</label> 
    <select name="NameAttr_Index" id="">
        @foreach ($headers as $header )
        <option value="{{$loop->index}}">{{$header}}</option>
        @endforeach
    </select>
    <br>
    <label class="custom-uploader">Type</label> 

    <select name="TypeAttr_Index" id="">
        @foreach ($headers as $header )
        <option value="{{$loop->index}}">{{$header}}</option>
        @endforeach
    </select>
    <br>

    <label class="custom-uploader">Quantity</label> 
      
    <select name="QtyAttr_Index" id="">
        @foreach ($headers as $header )
        <option value="{{$loop->index}}">{{$header}}</option>
        @endforeach
    </select>
    <br>
       <button class="btn btn-success" name="submit" type="submit"> Confirm Import  </button>
</form>



@endsection
