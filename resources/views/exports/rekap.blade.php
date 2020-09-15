<table class="table table-bordered table table-striped">
    <thead>
        <tr class="text-center " valign="middle">
            <th rowspan="2" valign="middle" width="5">No</th>
            <th rowspan="2" valign="middle" width="32">Nama Dosen </th>
            <th rowspan="2" class="align-middle" width="12">NIDN</th>
            <th rowspan="2" class="align-middle" width="12">Bidang</th>
            <th colspan="2" width="12">Reguler</th>
            <th colspan="2" width="12">Karyawan</th>
            <th colspan="2" width="8">Total</th>
            <th rowspan="2" class="align-middle" width="35">Mata Kuliah Diambil</th>
            <!-- <th>Prodi</th> -->
        </tr>
        <tr class="text-center text-bold">
            <th width="7">SKS</th>
            <th width="7">JAM</th>
            <th width="7">SKS</th>
            <th width="7">Jam</th>
            <th width="7">SKS</th>
            <th width="7">Jam</th>

        </tr>
    </thead>
    <tbody>
        <?php $no=1?>

        @foreach ($get_prodiAndDosen as $row)
        <tr valign="middle">
            <td class="text-center">{{ $no++}} </td>
            <td class="text-center">{{ $row->name}}</td>
            <td class="text-center">{{ $row->nidn}}</td>
            <!-- <td>{{ $row->nama}}</td> -->
            <td class="text-center">{{ $row->bidang}}</td>
            <td class="text-center">{{ $row->jumlah_sks}}</td>
            <td class="text-center">{{ $row->jumlah_jam}}</td>
            <td class="text-center">{{ $row->jumlah_sks_karyawan}}</td>
            <td class="text-center">{{ $row->jumlah_jam_karyawan}}</td>
            <td class="text-center">{{ $row->total_sks}}</td>
            <td class="text-center">{{ $row->total_jam}}</td>
            <td> @foreach($row->matkul_diambil as $matkul) {{$row->no++}}.
                {{ $matkul->matkul }} = {{ $matkul->nama }}
                <br>@endforeach</td>

        </tr>

        @endforeach

    </tbody>
</table>
