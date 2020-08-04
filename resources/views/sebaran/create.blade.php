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
    <table class="sebaran table table-bordered table table-striped">



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
    <tr>
        <td></td>
        <td> {{ Form::submit('Simpan Data',['class'=>'btn btn-success','id'=>'send-form'])}}
            {{ Link_to('sebaran','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}}</td>
    </tr>
</section>


<!-- AJAX KODE KELAS CREATE -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log($('#get'))
        $('#get').on('input', function () {
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
                    dosens = @json($get_data -> toArray(), JSON_HEX_TAG);
                    console.log(dosens)
                    var data = data.data;
                    table = $('#sebaran')
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
                            
                            <td id="prodi">${row.prodi}
                                <input type="hidden" name="prodi[]" value="${row.prodi}">
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
                            
                            <td>  <select class="form-control" name="dosen_mengajar[]">
                                <option selected disabled>Pilih Dosen</option>
                    `
                        dosens.forEach(dosen => {
                            sebaran +=
                                `<option value="${dosen.id}">${dosen.name}</option>`
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
