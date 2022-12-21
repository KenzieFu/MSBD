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
    <center><h4>GURU</h4></center>
    <table border="1" cellspacing="1" bgcolor="#000000" width="95%" align="center">
        <tr bgcolor="#ffffff">
            <td>
                <center>
                    <h5 style=" margin:1; ">NO</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Nama</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Nomor Induk Guru</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Alias</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Gender</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Alamat</h5>
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
        @foreach ($data as $as)
        <tr bgcolor="#ffffff">
            <td>
                    <center><h5 style=" margin:1; ">{{ $i }}</h5></center>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->name }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->NIG }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->alias }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->gender }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->alamat }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->Tahun_Masuk }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->updated_at }}</h5>
            </td>
        </tr>
        @php $i+=1; @endphp
        @endforeach
    </table>
</body>
</html>