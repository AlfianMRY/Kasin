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

<h1 style="text-align: center">Data Anggota {{ $user->name }}</h1>

<table id="customers">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>No Hp</th>
    <th>Jenis Kelamin</th>
    <th>Status</th>
  </tr>
  @php
    $no = 1;
  @endphp
    @foreach ($data as $a)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $a->nama }}</td>
        <td>{{ $a->no_hp }}</td>
        <td>{{ $a->jk }}</td>
        <td>{{ $a->status }}</td>
    </tr>
    @endforeach
  
</table>

</body>
</html>


