@extends('layout')
@section('title','Sebaran')
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
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Create Sebaran
                    </h3>
                    <div class="card-tools ">
                        <select name="kurikulum" class="custom-select my-1 mr-sm-2 col-md-4" id="kurikulum">
                            <option selected disabled>Kurikulum</option>
                            @foreach($kurikulum as $kurikulum)
                            <option value="{{$kurikulum->nama}}">{{$kurikulum->nama}}</option>
                            @endforeach
                           
                        </select>
                        <select name="semester" class="custom-select my-1 mr-sm-2 col-md-4" id="semester" disabled>
                            <option value="" selected disabled>Pilih Semester</option>
                            @foreach ($semester as $semester)
                            <option value="{{$semester->semester}}">{{$semester->semester}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{ Form::open(['url'=>'sebaran'])}}
                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                    <select id="pilih_kelas" class="form-control col-2 " disabled>
                            <option selected value="" disabled>Pilih Kode Kelas</option>
                            @foreach($pilih_kelas as $row)
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
                        <tbody id="create-sebaran">
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Input</button>
                        <a href="{{ route('sebaran.index')}}" class="btn btn-default ">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Disable -->
<script type="text/javascript">
    $(document).ready(function () {
        console.log($('#kurikulum'))
        $('#kurikulum').on('input', function () {
            $('#semester').prop('disabled',false)
        });
        $('#semester').on('input', function () {
            $('#pilih_kelas').prop('disabled',false)
        });
    });
</script>

<!-- AJAX KODE KELAS CREATE -->

<script type="text/javascript">
    $(document).ready(function () {
        console.log($('#semester'))
        $('#semester').on('input', function () {
            $('#semester').prop('disabled',false)
            var semester = $(this).val();
            var kurikulum = $('#kurikulum').val();
            $.ajax({
                type: "GET",
                url: "{{ route('sebaran.ajax_create') }}",
                dataType: "JSON",
                data: {
                    semester: semester , kurikulum:kurikulum
                },
                cache: false,
                success: function (data) {
                    console.log(data);
                    dosens = @json($data_dosen -> toArray(), JSON_HEX_TAG);
                    console.log(dosens)
                    var data = data.data;
                    table = $('#create-sebaran')
                    table.find('.data-sebaran').remove()
                    table.find('.odd').hide()
                    data.forEach(row => {
                        sebaran = `
                        <tr class="data-sebaran">
                        <td>${row.matkul} </td>
                            <input type="hidden" name="mata_kuliah[]" value="${row.id}">
                            <input type="hidden" name="kd_kelas[]" class="kode">
                            <input type="hidden" name="semester[]" value="${row.semester}">
                            <input type="hidden" name="prodi[]" value="${row.prodi}">
                            <Input type="hidden" name="tahun_akademik[]" value="{{$year1}} / {{$year}}"></Input>

                            <td>  <select class="form-control" name="dosen_pdpt[]">
                                <option selected value="">Pilih Dosen</option>
                    `
                        dosens.forEach(dosen => {
                            sebaran +=
                                `<option value="${dosen.nidn}">${dosen.name}</option>`
                        })
                        sebaran += `
                                </select></td>
                    
                            
                            <td>  <select class="form-control" name="dosen_mengajar[]">
                                <option selected value="" >Pilih Dosen</option>
                    `
                        dosens.forEach(dosen => {
                            sebaran +=
                                `<option value="${dosen.nidn}">${dosen.name}</option>`
                        })
                        sebaran += `
                                </select></td>
                        </tr>
                    `
                        table.append(sebaran)
                        
                        
                    })
                }
            });
                
        });
    });
    

</script>
<script type="text/javascript">
        $(document).ready(function () {
            console.log($('#pilih_kelas'))
            $('body').on('input','#pilih_kelas', function () {

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
@endsection
