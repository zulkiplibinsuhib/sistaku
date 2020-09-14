<div class="card-body table-responsive">
    <table class="sebaran table table-bordered table table-striped" id="sebaran">
        <thead>
            <tr class="text-center " valign="middle" height="28" align="middle">
                <th width="5"><b>NO</b> </th>
                <th width="9"><b>KODE KELAS</b></th>
                <th width="10"><b>KELAS</b></th>
                <th width="8"><b>PRODI</b></th>
                <th width="6"><b>SMT</b></th>
                <th width="6"><b>MHS</b></th>
                <th width="12"><b>KODE MATKUL</b></th>
                <th width="35"><b>MATA KULIAH</b></th>
                <th width="7"><b>SKS</b></th>
                <th width="7"><b>T</b></th>
                <th width="7"><b>P</b></th>
                <th width="7"><b>JAM</b></th>
                <th width="32"><b>DOSEN MENGAJAR</b></th>
                <th width="32"><b>DOSEN PDPT</b></th>
                <th width="25"><b>KETERANGAN</b></th>
           
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;?>
            @foreach ($sebaran as $row)

            <tr class="text-center" height="15" align="right">
                <td>{{ $no++}} </td>
                <td>{{empty($row->kode) ? 'Belum Memilih Kelas' : $row->kode}}</td>
                <td>{{empty($row->keterangan) ? 'Belum Memilih Kelas' : $row->keterangan}}</td>
                <td>{{ $row->kode_prodi}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{empty($row->kode) ? '0' : $row->mhs}}</td>
                <td>{{ $row->kode_matkul}}</td>
                <td>{{ $row->matkul}}</td>
                <td>{{ $row->sks}}</td>
                <td>{{ $row->teori}}</td>
                <td>{{ $row->praktek}}</td>
                <td>{{ $row->jam_minggu}}</td>
                <td>{{empty($row->name) ? 'Belum Memilih Dosen' : $row->name}}</td>
                <td>{{empty($row->dosen_pdpt) ? 'Belum Memilih Dosen' : $row->dosen_pdpt}}</td>
                <td>{!! $row->approved ? '<span class="badge bg-primary">Approved</span>' : '<span
                        class="badge bg-danger">Pending</span>'!!}</td>

                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
