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
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Daftar Mata Kuliah
                    </h3>
                    <div class="card-tools ">
                        <select name="tahun" class="custom-select my-1 mr-sm-2 col-md-4" id="tahun">
                            <option selected disabled>Pilih Tahun Akademik</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                        <select name="semester" class="custom-select my-1 mr-sm-2 col-md-4" id="semester">
                            <option value="" selected disabled>Pilih Semester</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    {{ Form::open(['url'=>'sebaran'])}}
                    <table class=" table table-bordered table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Kelas</th>
                                <th>Kelas</th>
                                <th>Tahun Akademik</th>
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
                        <button type="submit" class="btn btn-info">Input</button>
                        <a href="{{ route('sebaran.index')}}" class="btn btn-default float-right">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log('ini tahun')
        console.log($('#tahun'))
        $('#tahun').on('input', function () {

            var kode = $(this).val();
            console.log(kode)
            $.ajax({
                type: "GET",
                url: "{{ route('sebaran.ajax_select') }}",
                dataType: "JSON",
                data: {
                    tahun: kode
                },
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#semester').empty()
                    var option = ` <option value="">Pilih Semester</option>
                        `
                    $('#semester').append(option)
                    var data = data.data;
                    data.forEach(tahun => {
                        var option = ` <option value="${tahun.semester}">${tahun.semester}</option>
                        `
                        $('#semester').append(option)

                    })






                }
            });
            return false;
        });
    });

</script>

<!-- AJAX KODE KELAS CREATE -->

<script type="text/javascript">
    $(document).ready(function () {
        console.log($('#semester'))
        $('#semester').on('input', function () {
            var get = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('sebaran.ajax_create') }}",
                dataType: "JSON",
                data: {
                    get: get
                },
                cache: false,
                success: function (data) {
                    console.log(data);
                    dosens = @json($data_dosen - > toArray(), JSON_HEX_TAG);
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
                    })
                }
            });
            return false;
        });
    });

</script>
@endsection
