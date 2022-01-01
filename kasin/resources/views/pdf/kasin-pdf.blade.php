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
  @php
      $no = 1;
  @endphp

<h1 style="text-align: center">Data Pembayaran Anggota {{ $user->name }}</h1>

<table id="customers">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Total Bayar</th>
    <th>Berapa x Bayar</th>
  </tr>
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
  </tr>
    @endforeach
  
</table>

</body>
</html>


