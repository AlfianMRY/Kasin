<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1 style="text-align: center">Data Pengeluaran Kas {{ $user->name }}</h1>

<h3>Total Pengeluaran : Rp. {{ number_format($total) }}</h3>
<table id="customers">
  <tr>
    <th>No</th>
    <th>Tanggal Pengeluaran</th>
    <th>Nominal</th>
    <th>Keterangan</th>
  </tr>
  @php
    $no = 1;
  @endphp
    @foreach ($data as $a)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $a->tgl_pengeluaran }}</td>
        <td>Rp. {{ number_format($a->nominal) }}</td>
        <td>{{ $a->keterangan }}</td>
    </tr>
    @endforeach
  
</table>

</body>
</html>


