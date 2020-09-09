@extends('layout')
@section('title','Input Sebaran')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
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
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Input Sebaran
                    </h3>
                    <div class="card-tools ">
                        <p class="text-bold">Kurikulum 2019</p>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{ Form::open(['url'=>'sebaran'])}}
                    <table class="sebaran-table table table-bordered table table-striped" id="table-1">
                        <h4 class="text-center">Semester 1</h4>
                        <select id="pilih_kelas" class="form-control col-2 ">
                            <option selected value="">Pilih Kode Kelas</option>
                            @foreach($pilih_kelas1 as $row)
                            <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>
                            @endforeach
                        </select>
                        <thead>
                            <tr class="text-center">
                                <th>Mata Kuliah</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                        @foreach ($semester1 as $row1)
                        <tr class="text-center">
                            <td>{{$row1->matkul}} </td>
                            <input type="hidden" name="mata_kuliah[]" value="{{$row1->id}}">
                            <input type="hidden" name="kd_kelas[]" class="kode">
                            <input type="hidden" name="semester[]" value="{{$row1->semester}}">
                            <input type="hidden" name="prodi[]" value="{{$row1->prodi}}">
                            <Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>
                            <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                    <div>
                        <button class=" btn btn-primary" id="tambah_1" value="1">Tambah Tabel</button>
                    </div>
                    <hr><br>
                    <table class="sebaran-table table table-bordered table table-striped" id="table-2">
                        <h4 class="text-center">Semester 3</h4>
                        <select id="pilih_kelas3" class="form-control col-2 ">
                            <option selected value="">Pilih Kode Kelas</option>
                            @foreach($pilih_kelas3 as $row)
                            <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>
                            @endforeach
                        </select>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                        @foreach ($semester3 as $row3)
                        <tr class="text-center">
                            <td>{{$row3->matkul}} </td>
                            <input type="hidden" name="mata_kuliah[]" value="{{$row3->id}}">
                            <input type="hidden" name="semester[]" value="{{$row3->semester}}">
                            <input type="hidden" name="kd_kelas[]" class="kode3">
                            <input type="hidden" name="prodi[]" value="{{$row3->prodi}}">
                            <Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>
                            <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                    <div>
                        <button class="btn btn-primary" id="tambah_2" value="1">Tambah Tabel</button>
                    </div>
                    <hr><br>
                    <table class="sebaran-table table table-bordered table table-striped" id="table-3">
                        <h4 class="text-center">Semester 5</h4>
                        <select id="pilih_kelas5" class="form-control col-2 ">
                            <option selected value="">Pilih Kode Kelas</option>
                            @foreach($pilih_kelas5 as $row)
                            <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>
                            @endforeach
                        </select>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                        @foreach ($semester5 as $row5)
                        <tr class="text-center">
                            <td>{{$row5->matkul}} </td>
                            <input type="hidden" name="mata_kuliah[]" value="{{$row5->id}}">
                            <input type="hidden" name="kd_kelas[]" class="kode5">
                            <input type="hidden" name="semester[]" value="{{$row5->semester}}">
                            <input type="hidden" name="prodi[]" value="{{$row5->prodi}}">
                            <Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>
                            <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                    <div>
                        <button class="btn btn-primary" id="tambah_3" value="1">Tambah Tabel</button>
                    </div>
                    <hr><br>
                    <table class="sebaran-table table table-bordered table table-striped" id="table-4">
                        <h4 class="text-center">Semester 7</h4>
                        <select id="pilih_kelas7" class="form-control col-2 ">
                            <option selected value="">Pilih Kode Kelas</option>
                            @foreach($pilih_kelas7 as $row)
                            <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>
                            @endforeach
                        </select>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                        @foreach ($semester7 as $row7)
                        <tr class="text-center">
                            <td>{{$row7->matkul}} </td>
                            <input type="hidden" name="mata_kuliah[]" value="{{$row7->id}}">
                            <input type="hidden" name="kd_kelas[]" class="kode7">

                            <input type="hidden" name="semester[]" value="{{$row7->semester}}">
                            <input type="hidden" name="prodi[]" value="{{$row7->prodi}}">
                            <Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>
                            <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->nidn}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                    <div>
                        <button class="btn btn-primary" id="tambah_4" value="1">Tambah Tabel</button>
                    </div>
                    <hr><br>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Input</button>
                        <a href="{{ route('sebaran.index')}}" class="btn btn-default ">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tambah_1').on('click', function () {
                var semester1 = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.kurikulum_2019_ganjil') }}",
                    dataType: "JSON",
                    data: {
                        semester1: semester1,

                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        dosens = @json($data_dosen -> toArray(), JSON_HEX_TAG);
                        kelass = @json($data_kelas -> toArray(), JSON_HEX_TAG);
                        console.log(dosens)
                        var data = data.data;
                        var sebaran =
                            `
                            <div id="table-add1"><table class="sebaran sebaran-table table table-bordered table table-striped" >`+
                            '<thead>' +
                            '<div >'+
                            '<select id="pilih_kelas_ajax" class="form-control col-2 float float-left ">'+
                            '<option selected value="">Pilih Kode Kelas</option>'+
                            '@foreach($pilih_kelas1 as $row)'+
                            ' <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>'+
                            ' @endforeach'+
                            '</select>'+
                            '<button type="button" class="btn btn-outline-danger float-right" title="Hapus Tabel" " id="hapus-table">X</button>'+
                            '</div>'+
                            '<tr class="text-center">' +
                            '<th>Mata Kuliah</th>' +
                            '<th>Dosen Mengajar</th>' +
                            '<th>Dosen PDPT</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '@foreach ($semester1 as $row1)' +
                            '<tr class="text-center">' +
                            '<td>{{$row1->matkul}} ' +
                            '<input type="hidden" name="mata_kuliah[]" value="{{$row1->id}}"</td>' +
                            '<input type="hidden" name="kd_kelas[]" class="kode_ajax">'+
                            '<input type="hidden" name="semester[]" value="{{$row1->semester}}">' +
                            '<input type="hidden" name="prodi[]" value="{{$row1->prodi}}">' +
                            '<Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>' +
                            '<td><select name="dosen_mengajar[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->nidn}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '<td><select name="dosen_pdpt[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->id}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '</tr>' +
                            '@endforeach' +
                            '</tbody>' +
                            '</table></div>'
                            console.log($('#table-1'))
                        $('#table-1').after(sebaran)
                    }
                });
                return false;
            });
            $('body').on('click', '#hapus-table', function () {

                console.log($(`#table-add1`))
                $('#table-add1').remove()
            })

        })

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tambah_2').on('click', function () {
                var semester3 = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.kurikulum_2019_ganjil') }}",
                    dataType: "JSON",
                    data: {
                        semester3: semester3,

                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        dosens = @json($data_dosen -> toArray(), JSON_HEX_TAG);
                        kelass = @json($data_kelas -> toArray(), JSON_HEX_TAG);
                        console.log(dosens)
                        var data = data.data;
                        var sebaran =
                            `
                            <div id="table-add2"><table class="sebaran sebaran-table table table-bordered table table-striped" id="table-add2">` +
                            '<div >'+
                            '<select id="pilih_kelas_ajax3" class="form-control col-2 float float-left ">'+
                            '<option selected value="">Pilih Kode Kelas</option>'+
                            '@foreach($pilih_kelas3 as $row)'+
                            ' <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>'+
                            ' @endforeach'+
                            '</select>'+
                            '<button type="button" class="btn btn-outline-danger float-right" title="Hapus Tabel" " id="hapus-table2">X</button>'+
                            '</div>'+
                            '<thead>' +
                            '<tr class="text-center">' +
                            '<th>Mata Kuliah</th>' +
                            '<th>Dosen Mengajar</th>' +
                            '<th>Dosen PDPT</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '@foreach ($semester3 as $row3)' +
                            '<tr class="text-center">' +
                            '<td>{{$row3->matkul}} ' +
                            '<input type="hidden" name="mata_kuliah[]" value="{{$row3->id}}"</td>' +
                            '<input type="hidden" name="kd_kelas[]" class="kode_ajax3">'+
                            '<input type="hidden" name="semester[]" value="{{$row3->semester}}">' +
                            '<input type="hidden" name="prodi[]" value="{{$row3->prodi}}">' +
                            '<Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>' +
                            '<td><select name="dosen_mengajar[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->nidn}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '<td><select name="dosen_pdpt[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->id}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '</tr>' +
                            '@endforeach' +
                            '</tbody>' +
                            '</table></div>'

                            console.log($('#table-2'))
                        $('#table-2').after(sebaran)
                    }
                });
                return false;
            });
            $('body').on('click', '#hapus-table2', function () {
                console.log('delee')
                console.log($(`#table-add2`))
                $(`#table-add2`).remove()
            })

        })

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tambah_3').on('click', function () {
                var semester5 = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.kurikulum_2019_ganjil') }}",
                    dataType: "JSON",
                    data: {
                        semester5: semester5,

                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        dosens = @json($data_dosen -> toArray(), JSON_HEX_TAG);
                        kelass = @json($data_kelas -> toArray(), JSON_HEX_TAG);
                        console.log(dosens)
                        var data = data.data;
                        var sebaran =
                            `
                            <div id="table-add3"><table class="sebaran sebaran-table table table-bordered table table-striped" id="table-add3">` +
                            '<div >'+
                            '<select id="pilih_kelas_ajax5" class="form-control col-2 float float-left ">'+
                            '<option selected value="">Pilih Kode Kelas</option>'+
                            '@foreach($pilih_kelas5 as $row)'+
                            ' <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>'+
                            ' @endforeach'+
                            '</select>'+
                            '<button type="button" class="btn btn-outline-danger float-right" title="Hapus Tabel" " id="hapus-table3">X</button>'+
                            '</div>'+
                            '<thead>' +
                            '<tr class="text-center">' +
                            '<th>Mata Kuliah</th>' +
                            '<th>Dosen Mengajar</th>' +
                            '<th>Dosen PDPT</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '@foreach ($semester5 as $row5)' +
                            '<tr class="text-center">' +
                            '<td>{{$row5->matkul}} ' +
                            '<input type="hidden" name="mata_kuliah[]" value="{{$row5->id}}"</td>' +
                            '<input type="hidden" name="kd_kelas[]" class="kode_ajax5">'+
                            '<input type="hidden" name="semester[]" value="{{$row5->semester}}">' +
                            '<input type="hidden" name="prodi[]" value="{{$row5->prodi}}">' +
                            '<Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>' +
                            '<td><select name="dosen_mengajar[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->nidn}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '<td><select name="dosen_pdpt[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->id}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '</tr>' +
                            '@endforeach' +
                            '</tbody>' +
                            '</table></div>'

                            console.log($('#table-3'))
                        $('#table-3').after(sebaran)
                    }
                });
                return false;
            });
            $('body').on('click', '#hapus-table3', function () {
                console.log('delee')
                console.log($(`#table-add3`))
                $(`#table-add3`).remove()
            })

        })

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tambah_4').on('click', function () {
                var semester7 = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.kurikulum_2019_ganjil') }}",
                    dataType: "JSON",
                    data: {
                        semester7: semester7,

                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        dosens = @json($data_dosen -> toArray(), JSON_HEX_TAG);
                        kelass = @json($data_kelas -> toArray(), JSON_HEX_TAG);
                        console.log(dosens)
                        var data = data.data;
                        var sebaran =
                            `
                            <div id="table-add4"><table class="sebaran sebaran-table table table-bordered table table-striped" >` +
                            '<div >'+
                            '<select id="pilih_kelas_ajax7" class="form-control col-2 float float-left ">'+
                            '<option selected value="">Pilih Kode Kelas</option>'+
                            '@foreach($pilih_kelas7 as $row)'+
                            ' <option value="{{$row->id}}">{{$row->kode}} - {{$row->tahun}}</option>'+
                            ' @endforeach'+
                            '</select>'+
                            '<button type="button" class="btn btn-outline-danger float-right" title="Hapus Tabel" " id="hapus-table4">X</button>'+
                            '</div>'+
                            '<thead>' +
                            '<tr class="text-center">' +
                            '<th>Mata Kuliah</th>' +
                            '<th>Dosen Mengajar</th>' +
                            '<th>Dosen PDPT</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '@foreach ($semester7 as $row7)' +
                            '<tr class="text-center">' +
                            '<td>{{$row7->matkul}} ' +
                            '<input type="hidden" name="mata_kuliah[]" value="{{$row7->id}}"</td>' +
                            '<input type="hidden" name="kd_kelas[]" class="kode_ajax7">'+
                            '<input type="hidden" name="semester[]" value="{{$row7->semester}}">' +
                            '<input type="hidden" name="prodi[]" value="{{$row7->prodi}}">' +
                            '<Input type="hidden" name="tahun_akademik[]" value="{{$year}} / {{$year1}}"></Input>' +
                            '<td><select name="dosen_mengajar[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->nidn}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '<td><select name="dosen_pdpt[]" id="" class="form-control">' +
                            '<option selected value="">Pilih Dosen</option>' +
                            '@foreach($data_dosen as $row)' +
                            '<option value="{{$row->id}}">{{$row->name}}</option>' +
                            '@endforeach' +
                            '</select></td>' +
                            '</tr>' +
                            '@endforeach' +
                            '</tbody>' +
                            '</table>' +
                            '</div></div>'

                            console.log($('#table-4'))
                        $('#table-4').after(sebaran)
                    }
                });
                return false;
            });
            $('body').on('click', '#hapus-table4', function () {
                console.log('delee')
                console.log($(`#table-add4`))
                $(`#table-add4`).remove()
            })

        })

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas'))
            $('#pilih_kelas').on('input', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas3'))
            $('#pilih_kelas3').on('input', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode3').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas5'))
            $('#pilih_kelas5').on('input', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode5').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas7'))
            $('#pilih_kelas7').on('input', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode7').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas_ajax'))
            $('body').on('input','#pilih_kelas_ajax', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode_ajax').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas_ajax3'))
            $('body').on('input','#pilih_kelas_ajax3', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode_ajax3').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas_ajax5'))
            $('body').on('input','#pilih_kelas_ajax5', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode_ajax5').val(kode);
                    }
                });
                return false;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas_ajax7'))
            $('body').on('input','#pilih_kelas_ajax7', function () {
                var get = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('sebaran.pilih_kelas') }}",
                    dataType: "JSON",
                    data: {
                        get: get
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        var json = data;
                        var kode = json.kode;
                        console.log(kode);
                        kelas = $('.kode_ajax7').val(kode);
                    }
                });
                return false;
            });
        });

    </script>



    @endsection
