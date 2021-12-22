@extends('layouts.master')
@php
    $title = 'Kas Anggota';
    $active = 'kas';
    $no = 1;
@endphp
@section('content')

<div class="container">
<div class="card">
    <div class="card-header d-flex">
      <h2 class="">
       Detail Kas {{ $anggota->nama }}
      </h2>
      <h2 class="ml-auto">
          Total Bayar : Rp. {{ number_format($total) }}
      </h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Bayar</th>
          <th>Nominal</th>
          <th>Keterangan</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($kas as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $k->tgl_bayar }}</td>
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
                </td>
            </tr>

            {{-- Delete --}}
            <div class="modal fade" id="modal-sm-del-kasout{{ $k->id }}">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header bg-danger">
                    <h4 class="modal-title">{{ $k->tgl_bayar }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                  <form action="{{ route('kas.destroy',$k->id) }}" method="post">
                    @csrf
                    @method('delete')
                      <p>Yakin Hapus Data Tanggal {{ $k->tgl_bayar }} ?</p>
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
                    <h4 class="modal-title">Edit Kas {{ $anggota->nama }} Tanggal {{ $k->tgl_bayar }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/kas/{{ $k->id }}" method="post">
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Nominal</label>
                                  <input id="nominal" type="number" class="form-control" name="nominal" value="{{ $k->nominal }}" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Tanggal</label>
                                  <input type="date" class="form-control" name="tgl_bayar" value="{{ $k->tgl_bayar }}" required>
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
    <a href="/kas" class="btn btn-primary">Back</a>
    <!-- /.card-body -->
  </div>
    
</div>
@endsection