@extends('layout')
@section('title','Mata Kuliah')
@section('content')

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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Mata Kuliah
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($matkul,['url'=>'matkul/'.$matkul->id,'method'=>'put'])}}
                <table class="table table-borderless">
                    <tr>
                        <td><label class="offset-4">Kode Mata Kuliah</label>
                        <td>{{ Form::text('kode_matkul',null,['placeholder'=>'Kode Matkul','class'=>'form-control col-10 ','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Mata Kuliah </label>
                        <td>{{ Form::text('matkul',null,['placeholder'=>'mata kuliah','class'=>'form-control col-10','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td> <label class="offset-4">SKS</label>
                        <td>{{ Form::number('sks',null,['placeholder'=>'sks','class'=>'form-control col-10','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Teori</label> </td>
                        <td>{{ Form::number('teori',null,['placeholder'=>'Enter jam teori','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Praktek</label> </td>
                        <td>{{ Form::number('praktek',null,['placeholder'=>'Enter jam praktek','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Jam / Minggu</label> </td>
                        <td>{{ Form::number('jam_minggu',null,['placeholder'=>'Enter jam per minggu','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>

                    <tr>
                        <td><label class="offset-4">Kurikulum</label>
                        <td> <select name="kurikulum" class="form-control col-10">
                                <option selected >{{empty($matkul->kurikulum)  ? 'Pilih Kurikulum' :$matkul->kurikulum}}</option>
                                @foreach($kurikulum as $kurikulum)
                                <option value="{{$kurikulum->nama}}">{{$kurikulum->nama}}</option>
                                @endforeach

                            </select>
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Semester</label> </td>
                        <td>
                            <div class="form-group row">
                                <div class="form-group col-6 ">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="semester" value="1"
                                            class="custom-control-input" name="semester"
                                            {{($matkul->semester == '1')?'checked':''}}>
                                        <label class="custom-control-label " for="customRadioInline1">1</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="semester" value="2"
                                            class="custom-control-input" {{($matkul->semester =='2')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline2">2</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline3" name="semester" value="3"
                                            class="custom-control-input" {{($matkul->semester =='3')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline3">3</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline4" name="semester" value="4"
                                            class="custom-control-input" {{($matkul->semester =='4')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline4">4</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline5" name="semester" value="5"
                                            class="custom-control-input" name="semester"
                                            {{($matkul->semester =='5')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline5">5</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline6" name="semester" value="6"
                                            class="custom-control-input" {{($matkul->semester =='6')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline6">6</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline7" name="semester" value="7"
                                            class="custom-control-input" {{($matkul->semester =='7')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline7">7</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline8" name="semester" value="8"
                                            class="custom-control-input" {{($matkul->semester =='8')?'checked':''}}>
                                        <label class="custom-control-label" for="customRadioInline8">8</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>{{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control','required','readonly'])}}
                    </tr>
                    @endif

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('matkul.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
