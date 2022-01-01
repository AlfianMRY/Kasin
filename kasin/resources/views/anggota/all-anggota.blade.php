@extends('layouts.master')
@php
    $title = 'Daftar Anggota';
    $active = 'anggota';
    $no = 1;
@endphp

@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex">
      <div class="row dataTables_wrapper dt-bootstrap4">
          <h3 class="card-title">Data Anggota Anda</h3>
      </div>
      <button type="button" class="ml-auto  btn-sm bg-success" data-toggle="modal" data-target="#modal-lg-add">
        <i class="fas fa-user-plus"></i>
         Add 
      </button>
    </div>

    <a href="/exportpdfanggota" class="btn btn-info"> Export PDF</a>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered  table-hover overflow-hide">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Hp</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $a)
          <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $a->nama }}</td>
              <td>{{ $a->no_hp }}</td>
              <td>{{ $a->jk }}</td>
              <td>{{ $a->status }}</td>
                <td>
                   <div class="btn-group">
                      <button type="button" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#modal-lg-edit{{ $a->id }}">
                        <i class="fas fa-edit"></i>
                        Edit 
                      </button>
                      <button type="submit" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#modal-sm{{ $a->id }}">
                        <i class="far fa-trash-alt"></i>
                         Dell
                      </button>
                    </div>
                </td>
          </tr>

        {{-- Edit Data --}}
        <div class="modal fade" id="modal-lg-edit{{ $a->id  }}">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

              <div class="card card-warning">
                <div class="card-header">
                  <div class="card-title">
                    <h3>Edit Data {{ $a->nama }}</h3>
                  </div>
                </div>
                <div class="card-body">
                  <form action="{{ route('anggota.update',$a->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" class="form-control" name="nama" value="{{ $a->nama }}" required>
                        </div>

                        {{-- No Hp --}}
                        <div class="form-group">
                          <label>No Hp</label>
                          <input type="text" class="form-control" name="no_hp" value="{{  $a->no_hp }}"" required>
                        </div>
                      
                      </div>
                      <div class="col-md-6">
                        {{-- gender --}}
                        <label>Gender</label>
                        <br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" {{ $a->jk == 'Pria' ? 'checked' : '' }} type="radio" name="jk" value="Pria">
                          <label class="form-check-label" >Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" {{ $a->jk == 'Wanita' ? 'checked' : '' }} type="radio" name="jk" value="Wanita">
                          <label class="form-check-label" >Wanita</label>
                        </div>

                        <!-- status -->
                        <div class="form-group mt-4 ">
                          
                          <label>Status</label>
                          <br>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" {{ $a->status == 'Aktif' ? 'checked' : '' }} type="radio" name="status" value="Aktif">
                            <label class="form-check-label" >Aktif</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" {{ $a->status == 'Tidak Aktif' ? 'checked' : '' }} type="radio" name="status" value="Tidak Aktif">
                            <label class="form-check-label" >Tidak Aktif</label>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                    <div class="modal-footer ml-auto d-flex">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary swalDefaultSuccess">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        {{-- Delete Data --}}
        <div class="modal fade" id="modal-sm{{ $a->id }}">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h4 class="modal-title">{{ $a->nama }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              <form action="{{ route('anggota.destroy',$a->id) }}" method="post">
                @csrf
                @method('delete')
                  <p>Yakin Hapus Data {{ $a->nama }} ?</p>
                </div>
                <div class="modal-footer ml-auto">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form> 
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

          @endforeach
        </tbody>
        
      </table>
    </div>
    <!-- /.card-body -->
</div>


 {{-- Tambah Data --}}
 <div class="modal fade" id="modal-lg-add">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="card card-success">
        <div class="card-header">
          <div class="card-title">
            <h3>Tambah Data</h3>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('anggota.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">

                {{-- Nama --}}
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" placeholder="Enter ..." required>
                </div>

                {{-- No Hp --}}
                <div class="form-group">
                  <label>No Hp</label>
                  <input type="text" class="form-control" name="no_hp" placeholder="Enter ..." required>
                </div>
              
              </div>
              <div class="col-md-6">
                  {{-- gender --}}
                  <label>Gender</label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Pria">
                    <label class="form-check-label" >Pria</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Wanita">
                    <label class="form-check-label" >Wanita</label>
                  </div>

                  <!-- status -->
                  <div class="form-group mt-4 ">
                    
                    <label>Status</label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status" value="Aktif">
                      <label class="form-check-label" >Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status" value="Tidak Aktif">
                      <label class="form-check-label" >Tidak Aktif</label>
                    </div>
                  </div>
              
              </div>
            </div>
            
            <div class="modal-footer ml-auto">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary swalDefaultSuccess">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection


@push('script')
<!-- Data table -->
<script src="{{ asset('') }}assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.js"></script>

<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('') }}assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('') }}assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


{{-- icon --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    $(function () {
      


      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": true,
        // "buttons": [ "excel", "pdf"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });

      
    });
</script>
@endpush