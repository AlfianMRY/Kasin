@extends('layouts.master')
@php
    $title = 'Kas Anggota';
    $active = 'kas';
    $no = 1;
    $noout = 1;
@endphp
@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <style>
    
  </style>
@endpush
@section('content')
<div class="card p-3">
  Total Dana Kas : Rp. {{ number_format($total - $totalout) }}
</div>
  {{-- Pemasukan --}}
  <div class="card">
    <div class="card-header  d-flex" >
      <h3 class="card-title">Data Pemasukan Kas</h3>
      <h3 class="card-title ml-auto" >Total Pemasukan Kas Rp. {{ number_format($total) }}</h3>
    </div>
    <a href="/exportpdfkasin"class="btn btn-info">Export PDF</a>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="kasin" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Total Pembayaran</th>
            <th>Berapa x Bayar</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $a)
            @php
                $total = 0;
                $tbayar = [];
            @endphp 
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>
                        @foreach ($kas as $k)
                            @if ($k->anggota_id == $a->id)
                               @php
                                   $total = $total + $k->nominal ;
                               @endphp 
                            @endif
                        @endforeach
                        Rp. {{ number_format($total) }}
                    </td>
                    <td>
                        @foreach ($kas as $k)
                            @if ($k->anggota_id == $a->id)
                               @php
                                   $tbayar[] = $k->nominal ;
                               @endphp 
                            @endif
                        @endforeach
                        {{ count($tbayar) }}
                    </td>
                    <td class="d-flex justify-content-center">
                        <div class="btn-group">
                            <a href="/kas/{{ $a->id }}" class=" btn btn-sm bg-info">
                                <i class="fas fa-user-secret"></i>
                                Detail 
                            </a>
                          <button type="submit" class="btn btn-sm bg-success" data-toggle="modal" data-target="#modal-lg{{ $a->id }}">
                            <i class="fas fa-money-bill-wave"></i>
                             Bayar
                          </button>
                        </div>
                    </td>
                </tr>

                {{-- Bayar Kas --}}
                <div class="modal fade" id="modal-lg{{ $a->id }}">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-success">
                        <h4 class="modal-title">{{ $a->nama }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/kas/{{ $a->id }}" method="post">
                          @csrf
                          @method('PUT')
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Nominal Bayar</label>
                                      <input id="nominal" type="number" class="form-control" name="nominal" placeholder="10000" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Tanggal</label>
                                      <input type="date" class="form-control" name="tgl_bayar"  required>
                                  </div>
                              </div>
                              <label  class="form-label">Keterangan</label>
                              <textarea class="form-control" name="keterangan" rows="3"></textarea>
                          </div>
                          <hr class="my-4">
                          <div class="row">
                              <div class="ml-auto">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success"> Tambah</button>
                              </div>
                          </div>
                        </form>
                      </div>
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


  <hr>
      <div class="card">
        <form action="/exportpdfkasout" method="post">
          @csrf
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Mulai</label>
                  <input type="date" class="form-control" name="from">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <input type="date" class="form-control" name="to">
                </div>
              </div>
            </div>
            <div class="text-success">
              * Jika keduanya kosong maka akan menampilkan semua data
            </div>
          </div>
          <div class="card-body d-flex">
              <button class="btn btn-success ml-auto" type="submit">Export</button>
            
          </div>
        </form>
      </div>


  {{-- Pengeluaran --}}
  <div class="card">
    <div class="card-header d-flex">
      <h3 class="card-title">Data Pengeluaran Kas</h3>
      <h3 class="card-title ml-auto">Total Pengeluaran Kas Rp. {{ number_format($totalout) }}</h3>
    </div>
      {{-- <a href="/exportpdfkasout" class="btn btn-info">Export PDF</a> --}}
    
      
    <!-- /.card-header -->
    <div class="card-body">
      <table id="kasout" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pengeluaran</th>
            <th>Nominal Pengeluaran</th>
            <th>Keterangan Pengeluaran</th>
            <th class="d-flex">
              Action
              <button type="submit" class="btn btn-sm bg-success ml-auto" data-toggle="modal" data-target="#modal-lg-pengeluaran">
                <i class="fas fa-money-bill-wave"></i>
                  Keluar
              </button>
            </th>
          </tr>
        </thead>
        <tbody>
            @foreach ($kasout as $k)
              <tr>
                  <td>{{ $noout++ }}</td>
                  <td>{{ $k->tgl_pengeluaran }}</td>
                  <td>Rp. {{ number_format($k->nominal) }}</td>
                  <td>{{ $k->keterangan }}</td>
                  <td class="d-flex justify-content-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm bg-warning ml-auto" data-toggle="modal" data-target="#modal-lg-pengeluaran-{{ $k->id }}">
                        <i class="fas fa-edit"></i>
                        Edit
                      </button>
                      <button type="submit" class="btn btn-sm bg-danger ml-auto" data-toggle="modal" data-target="#modal-sm-del-kasout{{ $k->id }}">
                        <i class="far fa-trash-alt"></i>
                        Dell
                      </button>
                    </div>
                  </td>
              </tr>

              {{-- Delete --}}
              <div class="modal fade" id="modal-sm-del-kasout{{ $k->id }}">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header bg-danger">
                      <h4 class="modal-title">{{ $k->tgl_pengeluaran }}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                    <form action="/pengeluaran/{{ $k->id }}" method="post">
                      @csrf
                      @method('delete')
                        <p>Yakin Hapus Data Tanggal {{ $k->tgl_pengeluaran }} ?</p>
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

              {{-- edit pengeluaran Kas --}}
              <div class="modal fade" id="modal-lg-pengeluaran-{{ $k->id }}">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-warning">
                      <h4 class="modal-title">Edit Pengeluaran Kas {{ $user->name }} Tanggal {{ $k->tgl_pengeluaran }}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/pengeluaran/{{ $k->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nominal Pengeluaran</label>
                                    <input id="nominal" type="number" class="form-control" name="nominal" value="{{ $k->nominal }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengeluaran</label>
                                    <input type="date" class="form-control" name="tgl_pengeluaran" value="{{ $k->tgl_pengeluaran }}" required>
                                </div>
                            </div>
                            <label  class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{ $k->keterangan }}</textarea>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="ml-auto">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endforeach
        </tbody>
        
      </table>
    </div>
        {{-- pengeluaran Kas --}}
        <div class="modal fade" id="modal-lg-pengeluaran">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-success">
                  <h4 class="modal-title">Pengeluaran Kas {{ $user->name }}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/pengeluaran/{{ $user->id }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal Pengeluaran</label>
                                <input id="nominal" type="number" class="form-control" name="nominal" placeholder="10000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="tgl_pengeluaran"  required>
                            </div>
                        </div>
                        <label  class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="ml-auto">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success"> Tambah</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <!-- /.card-body -->
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

      $("#kasin").DataTable({
          // "buttons": ["excel", "pdf"],
        "responsive": true, "lengthChange": true, "autoWidth": false
      }).buttons().container().appendTo('#kasin_wrapper .col-md-6:eq(0)');
      $("#kasout").DataTable({
          // "buttons": ["excel", "pdf"],
        "responsive": true, "lengthChange": true, "autoWidth": false
      }).buttons().container().appendTo('#kasout_wrapper .col-md-6:eq(0)');
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