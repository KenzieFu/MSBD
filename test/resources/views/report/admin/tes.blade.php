{{-- @foreach($data as $item)
            <li>
                <div >
                   
                    <div >
                        <p >
                            {{ $item->name }}
                        </p>
                        <p >
                            {{ $item->NIS }}
                        </p>
                    </div>
                </div>
@endforeach --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($data as $item)
    <div >
        <p >
            {{ $item->name }}
        </p>
        <p >
            {{ $item->NIS }}
        </p>
    </div>
    @endforeach
</body>
</html> --}}

<!DOCTYPE html>

<head>
    <title>Laporan</title>
    <style>
        h5   {margin:1;}

    </style>
        
</head>
<body>
    <table border="0">
        <tr>
            <td width="60" height="60">
                <center>
                    <img width="75" height="75" src="https://tse1.mm.bing.net/th?id=OIP.eycaQ1QFPo-DRqTLPK3XDAHaHl&pid=Api&P=0" alt="">
                </center>
            </td>
            <td width="440" height="60">
                <h4 style=" margin:1; ">
                    PEMERINTAHAN KOTA MEDAN
                    <br>
                    DINAS PENDIDIKAN
                    <br>
                    SMP HIKMATUL FADHILLAH
                </h4>
                <h6 style=" margin:1; ">
                    NPSN 10259999, JL. Denai No. 176 Medan, Kecamatan Kec. Medan Denai
                    <br>
                    Kota Medan - Prov. Sumatera Utara. Telp 081375806369, Fax null, Email
                </h6>
            </td>
        </tr>
        
    </table>
    <hr width="100%" align="center">    
    <center><h4>PESERTA DIDIK</h4></center>
    <table border="1" cellspacing="1" bgcolor="#000000" width="95%" align="center">
        <tr bgcolor="#ffffff">
            <td>
                <center>
                    <h5 style=" margin:1; ">NO</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">NIS</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Nama</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Gender</h5>
                </center>
            </td>
            {{-- <td>
                <center>
                    <h5 style=" margin:1; ">Tgl Lahir</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">NIK</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">NISN</h5>
                </center>
            </td> --}}
            <td>
                <center>
                    <h5 style=" margin:1; ">SMP(Tingkat)</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Kelas</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Tahun Masuk</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Terakhir Diupdate</h5>
                </center>
            </td>
        </tr>
        @php $i=1 @endphp
        @foreach ($tes as $item)
        {{-- @foreach ($data as $item) --}}
        
        <tr bgcolor="#ffffff">
            <td>
                    <center><h5 style=" margin:1; ">{{ $i }}</h5></center>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $item->NIS }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $item->name }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $item->gender }}</h5>
            </td>
            {{-- <td>
                    <h5 style=" margin:1; ">-</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">-</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">-</h5>
            </td> --}}
            <td>
                    <h5 style=" margin:1; ">{{ $item->SMP }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $item->nama_kelas }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $item->Tahun_Masuk }}</h5>
            </td>
            
                <td>
                    <h5 style=" margin:1; ">{{ $item->updated_at }}</h5>
                </td>
            {{-- @endforeach --}}
            
        </tr>
        @php $i+=1; @endphp
        @endforeach
    </table>
</body>
</html>
 {{-- @foreach ($users as $user)
            <tr>
            
               
                <td>{{ $user->NIS  }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nama_kelas }}</td>
                <td>{{ $user->Tahun_Masuk }}</td>
              
                <td>{{ $user->status }}</td>
                <td>{{ $user->gender}}</td>
                <td>{{ $user->SMP}}</td>
            </tr>
       
            @endforeach --}}