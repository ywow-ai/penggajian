<style>
    body {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        font-family: Arial, Helvetica, sans-serif;
        vertical-align: baseline;
    }

    table td {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .tabel {
        border-collapse: collapse;
        width: 100%;
        margin-top: 13px;
    }

    .tabel td,
    .tabel th {
        border: 1px solid #ddd;
        padding: 15px;
    }

    .tabel tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tabel tr:hover {
        background-color: #ddd;
    }

    .tabel th {
        text-align: left;
        background-color: #000;
        color: white;
    }

    h1,
    h2 {
        font-weight: 400;
        line-height: 1.2;
        color: black;
    }
</style>

<body>
    <center>
        <h1>Sistem Informasi Penggajian Karyawan di Pondok Pesantren Tasywiqul Furqon Kudus Berbasis Web</h1>
        <h2>Daftar Gaji Pegawai</h2>
        <hr style="width: 50%; border: 2px solid black; border-radius: 5px">
        <table style="width: 100%">
            <tr>
                <td width="20%">Nama Pegawai</td>
                <td width="2%">:</td>
                <td>nama</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>nik</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>jabatan</td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td>:</td>
                <td>bulan</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td>tahun</td>
            </tr>
        </table>

        <!-- <table class="tabel"> -->
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th style="text-align: center;" width="5%">No</th>
                <th style="text-align: center;" colspan="3">Keterangan</th>
                <th style="text-align: center;">Jumlah</th>
            </tr>
            <tr>
                <td>1</td>
                <td colspan="3">Gaji Pokok</td>
                <td>Rp. gaji pokok</td>
            </tr>

            <tr>
                <td>2</td>
                <td colspan="3">Tunjangan Transportasi</td>
                <td>Rp. tunjangan trans</td>
            </tr>

            <tr>
                <td>3</td>
                <td colspan="3">Uang Makan</td>
                <td>Rp. uang makan</td>
            </tr>

            <tr>
                <td rowspan="2">4</td>
                <td rowspan="2">Potongan</td>
                <td>Sakit</td>
                <td>1</td>
                <td rowspan="2">Rp. potongan</td>
            </tr>

            <tr>
                <td>Alpha</td>
                <td>1</td>
            </tr>

            <tr>
                <th colspan="4" style="text-align: right;">Total Gaji : </th>
                <th>Rp. xxx</th>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td></td>
                <td>
                    <p>Pegawai</p>
                    <br>
                    <br>
                    <p class="font-weight-bold">nama pegawai</p>
                </td>

                <td width="200px">
                    <p>Kudus, tanggal <br> Finance,
                    </p>
                    <br>
                    <br>
                    <p>___________________</p>
                </td>
            </tr>
        </table>
    </center>


</body>