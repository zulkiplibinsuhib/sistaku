@extends('layout')
@section('title','Mata Kuliah')
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

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show col-4" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Create Mata Kuliah
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'matkul'])}}
                <table class="table table-borderless">

                    <tr>
                        <td><label class="offset-4">Kode Mata Kuliah</label> </td>
                        <td>{{ Form::text('kode_matkul',null,['placeholder'=>'Enter Kode Mata Kuliah ','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td> <label class="offset-4">Mata Kuliah</label> </td>
                        <td>{{ Form::text('matkul',null,['placeholder'=>'Enter Mata Kuliah','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td> <label class="offset-4">SKS</label> </td>
                        <td>{{ Form::number('sks',null,['placeholder'=>'Enter SKS','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Teori</label> </td>
                        <td>{{ Form::number('teori',null,['placeholder'=>'Enter jam teori','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Praktek</label> </td>
                        <td>{{ Form::number('praktek',null,['placeholder'=>'Enter jam praktek','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Jam / Minggu</label> </td>
                        <td>{{ Form::number('jam_minggu',null,['placeholder'=>'Enter jam per minggu','class'=>'form-control col-10 offset-1','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="kurikulum" class="offset-4">Kurikulum</label></td>
                        <td> <select name="kurikulum" class="form-control offset-1 col-10" >
                            <option selected disabled>Pilih Kurikulum</option>
                            @foreach($kurikulum as $kurikulum)
                            <option value="{{$kurikulum->nama}}">{{$kurikulum->nama}}</option>
                            @endforeach
                           
                        </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label for="semester" class="offset-4">Semester</label></td>
                        <td>
                            <div class="form-group offset-1">

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="semester" value="1"
                                        class="custom-control-input" name="semester">
                                    <label class="custom-control-label" for="customRadioInline1">1</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="semester" value="2"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">2</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline3" name="semester" value="3"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline3">3</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline4" name="semester" value="4"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline4">4</label>
                                </div> 
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline5" name="semester" value="5"
                                        class="custom-control-input" name="semester">
                                    <label class="custom-control-label" for="customRadioInline5">5</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline6" name="semester" value="6"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline6">6</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline7" name="semester" value="7"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline7">7</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline8" name="semester" value="8"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline8">8</label>
                                </div>


                            </div>
                        </td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>
                        <td><label for="prodi" class="offset-4 ">Prodi</label></td>
                        <td><select name="prodi" class="form-control offset-1 col-10">
                                <option selected disabled>Pilih Prodi</option>
                                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select></td>
                    </tr>

                    @endif
                    </td>
                    </tr>

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Input</button>
                    <a href="{{ route('matkul.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
