@extends('layouts.master')
@php
    $title = 'Profil';
    $active = 'Profil';
    $no = 1;
    $noout = 1;
@endphp
@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')

{{-- Profil --}}
<div class="container mt-5 shadow px-4 py-4 mb-5" style="max-width: 500px; ">
<div class="card">
  <div class="card-header">
    <h3>PROFIL</h3>
  </div>
  <div class="card-header">
    <span class="fas fa-user"></span>  {{$user->name}}
</div>
  <div class="card-body">
      <span class="fas fa-envelope"></span>  {{$user->email}}
    </div>
</div>
</div>

@endsection 

@push('script')

{{-- icon --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>