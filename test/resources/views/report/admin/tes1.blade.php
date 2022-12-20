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
    <center><h4>ROMBONGAN BELAJAR (nama-nama kelas)</h4></center>
    <table border="1" cellspacing="1" bgcolor="#000000" width="95%" align="center">
        <tr bgcolor="#ffffff">
            <td>
                <center>
                    <h5 style=" margin:1; ">NO</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Nama Kelas</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Tingkat Kelas</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Guru/Wali</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Tahun Ajaran</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Status</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Jumlah Murid</h5>
                </center>
            </td>
            <td>
                <center>
                    <h5 style=" margin:1; ">Terakhir Diupdate</h5>
                </center>
            </td>
        </tr>
        @foreach ($data as $as)
        <tr bgcolor="#ffffff">
            <td>
                    <center><h5 style=" margin:1; ">{{ $as->id }}</h5></center>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->nama_kelas }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->SMP }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->name }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->TahunAjaran }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->status }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->jumlah }}</h5>
            </td>
            <td>
                    <h5 style=" margin:1; ">{{ $as->updated_at }}</h5>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>