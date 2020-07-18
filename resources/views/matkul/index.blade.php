@extends('layout')
@section('title','Daftar Mata Kuliah')
@section('content')

<!-- DELETE POP-UP MODEL -->
<!-- <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="matkul/delete_matkul.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <h4>Apakah anda yakin untuk menghapus data ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- ####################################################### -->

<form class="form-inline" action="" method="get">
<select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
          <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
  </select>
  <select name="kurikulum" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Kurikulum</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
  </select>

  <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>
<table class="table table-bordered">
        <tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th>Kurikulum</th><th>Semester</th><th>Prodi</th><th colspan="2">Action</th></tr>
        @foreach ($get_ProdiAndMatkul as $row)
            <tr><td>{{ $row->kode_matkul}}</td>
                <td>{{ $row->matkul}}</td>
                <td>{{ $row->sks}}</td>
                <td>{{ $row->kurikulum}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{ $row->nama}}</td>
                <td><a href="{{ route('matkul.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a><td>
                <td>
                    <form action="{{route('matkul.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                        </form>
                </td>
            </tr>
        @endforeach
    </table>
<a href="{{ route('matkul.create') }}" class="btn btn-success ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>


@endsection()

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script> -->

<!-- $(document).ready(function () {
    $('.deletebtn').on('click',function() {
        $('#deletemodal').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#delete_id').val(data[0]);
    });
});
</script> -->