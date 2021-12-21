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
        </tr>
        </thead>
        <tbody>
            @foreach ($kas as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $k->tgl_bayar }}</td>
                <td>Rp. {{ number_format($k->nominal) }}</td>
                <td>{{ $k->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
        
      </table>
    </div>
    <a href="/kas" class="btn btn-primary">Back</a>
    <!-- /.card-body -->
  </div>
    
</div>
@endsection