@extends('layout')
@section('title','Update Data Mata Kuliah')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> 
    </div>
@endif

    {{ Form::model($matkul,['url'=>'matkul/'.$matkul->id,'method'=>'put'])}}
    <table class="table table-bordered">
        <tr><td>Kode Mata Kuliah <td>{{ Form::text('kode_matkul',null,['placeholder'=>'Kode Matkul','class'=>'form-control','required'])}}</td></td></tr> 
        <tr><td>Mata Kuliah <td>{{ Form::text('matkul',null,['placeholder'=>'mata kuliah','class'=>'form-control','required'])}}</td></td></tr> 
        <tr><td> SKS <td>{{ Form::number('sks',null,['placeholder'=>'sks','class'=>'form-control col-md-4','required'])}}</td></td></tr> 
        <tr><td>Kurikulum<td>{{ Form::select('kurikulum',['2015'=>'2015','2016'=>'2016','2017'=>'2017'],'null',['class'=>'form-control col-md-4'])}}</td></td></tr>
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" id="prodi" class="form-control col-md-4" required>
                    @foreach($data_prodi as $prodi)
                    <option value="{{ $prodi}}">{{ $prodi}}</option>
                    @endforeach
                </select></td></tr>
        <tr><td></td><td> 
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('matkul','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}}
        </td></tr>
        </table>
@endsection