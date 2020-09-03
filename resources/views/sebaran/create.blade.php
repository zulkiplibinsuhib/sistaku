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
                        <select name="kurikulum" class="custom-select my-1 mr-sm-2 col-md-4" id="kurikulum">
                            <option selected disabled>Kurikulum</option>
                            @foreach($kurikulum as $kurikulum)
                            <option value="{{$kurikulum->nama}}">{{$kurikulum->nama}}</option>
                            @endforeach
                           
                        </select>
                        <select name="semester" class="custom-select my-1 mr-sm-2 col-md-4" id="semester" disabled>
                            <option value="" selected disabled>Pilih Semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{ Form::open(['url'=>'sebaran'])}}
                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                        <thead>
                            <tr>
                                <th>Kode Kelas</th>
                                <th>Kelas</th>
                                <th>Angkatan</th>
                                <th>Semester</th>
                                <th>Mhs</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>T</th>
                                <th>P</th>
                                <th>Jam</th>
                                <th>Dosen PDPT</th>
                                <th>Dosen Mengajar</th>
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
<script type="text/javascript">
    $(document).ready(function () {
        
        console.log($('#kurikulum'))
        $('#kurikulum').on('input', function () {

            $('#semester').prop('disabled',false)
          
            
        });
    });
</script>


<!-- AJAX KODE KELAS CREATE -->


<script type="text/javascript">
    $(document).ready(function () {
        console.log($('#semester'))
        $('#semester').on('input', function () {
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
                            <td id="kode">${row.kode}
                                <input type="hidden" name="kd_kelas[]" value="${row.kode}">
                            </td>
                            <td id="kelas">${row.kelas}
                                <input type="hidden" name="kelas[]" value="${row.kelas}">
                            </td>
                                <input type="hidden" name="prodi[]" value="${row.prodi}">
                            </td>
                            
                            <td id="tahun">${row.tahun}
                                <input type="hidden" name="tahun[]" value="${row.tahun}">
                            </td>
                            
                            <td id="semester">${row.semester}
                             <input type="hidden" name="semester[]" value="${row.semester}">
                            </td>
                            
                            <td id="mhs">${row.mhs}
                                <input type="hidden" name="mhs[]" value="${row.mhs}">
                            </td>
                            
                            <td id="matkul">${row.matkul}
                            <input type="hidden" name="mata_kuliah[]" value="${row.matkul}">
                            </td>
                            
                            <td id="sks">${row.sks}
                            <input type="hidden" name="sks[]" value="${row.sks}">
                            </td>
                            
                            <td id="teori">${row.teori}
                            <input type="hidden" name="teori[]" value="${row.teori}">
                            </td>
                            
                            <td id="praktek">${row.praktek}
                            <input type="hidden" name="praktek[]" value="${row.praktek}">
                            </td>
                            
                            <td id="jam_minggu">${row.jam_minggu}
                            <input type="hidden" name="jam[]" value="${row.jam_minggu}">
                            </td>

                            <td>  <select class="form-control" name="dosen_pdpt[]">
                                <option selected disabled>Pilih Dosen</option>

                    `
                        dosens.forEach(dosen => {
                            sebaran +=
                                `<option value="${dosen.nidn}">${dosen.name}</option>`
                        })
                        sebaran += `
                                </select></td>
                    
                            
                            <td>  <select class="form-control" name="dosen_mengajar[]">
                                <option selected disabled>Pilih Dosen</option>
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
                        $('#sebaran-table').DataTable();
                        
                    })
                }
            });
            return false;
        });
    });
    

</script>
@endsection
