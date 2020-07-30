@extends('layout')

@section('title','Input Sebaran')
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
<section class="content">
<select name="semester" class="custom-select my-1 mr-sm-2 col-md-4" id="get">
        <option selected disabled>Semester</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
    </select>
    {{ Form::open(['url'=>'sebaran'])}}
    <table class="sebaran table table-bordered table table-striped" >

       
       
    <thead>
        <tr>
            <th>Kode Kelas</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Semester</th>
            <th>Mhs</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>T</th>
            <th>P</th>
            <th>Jam</th>
            <th>Dosen Mengajar</th>
           
        </tr>
    </thead>
    <tbody id="sebaran">


    
    
       

       
    </tbody>

      
    </table>
    <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('sebaran','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
</section>


@endsection

