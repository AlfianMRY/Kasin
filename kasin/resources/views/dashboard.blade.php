@extends('layouts.master')
@php
    $title = 'Dashboard Anda';
    $active = 'dashboard';
    $cwe = [];
    $cwo = [];
    $aktif = 0;
    $nonaktif = 0;
@endphp
@foreach ($anggota as $a)
    @php
        if($a->jk == 'Pria'){
            $cwo[] = $a->nama;
        }if($a->jk == 'Wanita'){
            $cwe[] = $a->nama;
        }if($a->status == 'Aktif'){
            $aktif += 1;
        }if($a->status == 'Tidak Aktif'){
            $nonaktif += 1;
        }

    @endphp
    
@endforeach

@push('css')
    <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><sup style="font-size: 20px">Rp. </sup>{{ number_format($total - $totalout) }}</h3>

              <p>Total Sisa Dana</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
              
            </div>
            <a href="/kas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><sup style="font-size: 20px">Rp. </sup>{{ number_format($total) }}</h3>

              <p>Total Pemasukan</p>
            </div>
            <div class="icon">
                <ion-icon name="cash-outline"></ion-icon>

              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/kas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><sup style="font-size: 20px">Rp. </sup>{{ number_format($totalout) }}</h3>
  
                <p>Total Pengeluaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/kas#kasout" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $aktif + $nonaktif }} Orang</h3>

              <p>Total Anggota</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="/anggota" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-header">
                    <h3>
                        <b> Data Kas Anda </b>
                    </h3>
                </div>
                <div class="card-body ">
                    <table class="table" >
                        <tbody>
                            <tr>
                                <td>Total Pemasukan</td>
                                <td>=</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                            <tr>
                                <td>Total Pengeluaran </td>
                                <td>=</td>
                                <td>Rp. {{ number_format($totalout) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-bold">
                                <td>Total Dana Yang Dimiliki</td>
                                <td>=</td>
                                <td>Rp. {{ number_format($total - $totalout) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <div class="card-header">
                    <h3>
                        <b>Data Anggota Anda</b>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Total Anggota Pria</td>
                                <td>=</td>
                                <td>{{ count($cwo) }} </td>
                                <td> Orang</td>
                            </tr>
                            <tr>
                                <td>Total Anggota Wanita</td>
                                <td>=</td>
                                <td>{{ count($cwe) }} </td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>Total Anggota Aktif</td>
                                <td>=</td>
                                <td>{{ $aktif }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>Total Anggota Tidak Aktif</td>
                                <td>=</td>
                                <td>{{ $nonaktif }} </td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-bold">
                                <td>Total Anggota Anda</td>
                                <td>=</td>
                                <td>{{ $aktif + $nonaktif }} </td>
                                <td>Orang</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection