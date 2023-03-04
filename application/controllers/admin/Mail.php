<?php

class Mail extends CI_Controller
{
    public function index()
    {
        $potongan = $this->ModelPenggajian->get_data('potongan_gaji')->result();
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;

        $zakat = $this->db->query("SELECT * FROM zakat")->result();

        $slip_gaji = $this->db->query("SELECT data_pegawai.nik,data_pegawai.nama_pegawai,data_jabatan.nama_jabatan,data_pegawai.email,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.sakit,data_kehadiran.bulan FROM data_pegawai INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
		INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
		WHERE data_kehadiran.bulan='$bulantahun'")->result();

        foreach ($potongan as $p) {
            $potongan = $p->jml_potongan;
        }

        $p_alpha = $this->db->where('potongan', 'Alpha')->get('potongan_gaji')->result();
        $p_sakit = $this->db->where('potongan', 'Sakit')->get('potongan_gaji')->result();
        foreach ($p_alpha as $a) {
            $alpha = $a->jml_potongan;
            break;
        }
        foreach ($p_sakit as $s) {
            $sakit = $s->jml_potongan;
            break;
        }

        echo "========= Pondok Pesantren Tasywiqul Furqon Kudus ========== \n";

        echo "------------------ Send Email -> START!!! ------------------ \n";

        foreach ($slip_gaji as $k => $v) {
            echo "------------------ Send Progres " . ($k + 1) . " of " . count($slip_gaji) . "... ------------------ \n";
            $get_alpha = number_format(($v->alpha * $alpha), 0, ',', '.');
            $get_sakit = number_format(($v->sakit * $sakit), 0, ',', '.');
            $potongan_gaji = ($v->alpha * $alpha) + ($v->sakit * $sakit);
            $bl = substr($v->bulan, 0, 2);
            $th = substr($v->bulan, 2, 4);
            $gaji_pokok = number_format($v->gaji_pokok, 0, ',', '.');
            $tunj_trans = number_format($v->tj_transport, 0, ',', '.');
            $uang_makan = number_format($v->uang_makan, 0, ',', '.');
            $pt = number_format($potongan_gaji, 0, ',', '.');
            $t_gaji = number_format($v->gaji_pokok + $v->tj_transport + $v->uang_makan - $potongan_gaji, 0, ',', '.');
            $tg = date("d M Y");
            $persen_zakat = 0;
            foreach ($zakat as $z) {
                $persen_zakat = $persen_zakat + $z->potongan;
            }
            $t_zakat = number_format((($v->gaji_pokok + $v->tj_transport + $v->uang_makan - $potongan_gaji) / 100) * $persen_zakat, 0, ',', '.');
            $t_gaji_s_zakat = number_format(($v->gaji_pokok + $v->tj_transport + $v->uang_makan - $potongan_gaji) - ((($v->gaji_pokok + $v->tj_transport + $v->uang_makan - $potongan_gaji) / 100) * $persen_zakat), 0, ',', '.');
            // -------------------
            // -------------------
            $w = '
                <body>
                    <center>
                        <h1 style="color: black">Sistem Informasi Penggajian Karyawan di Pondok Pesantren Tasywiqul Furqon Kudus Berbasis Web</h1>
                        <h2 style="color: black">Daftar Gaji Pegawai</h2>
                        <hr style="width: 50%; border: 2px solid black; border-radius: 5px">
                        <table style="width: 100%; margin-top: 10px">
                            <tr>
                                <td width="20%" style="color: black">Nama Pegawai</td>
                                <td width="2%" style="color: black">:</td>
                                <td style="color: black">' . $v->nama_pegawai . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">NIK</td>
                                <td style="color: black">:</td>
                                <td style="color: black">' . $v->nik . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">Jabatan</td>
                                <td style="color: black">:</td>
                                <td style="color: black">' . $v->nama_jabatan . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">Bulan</td>
                                <td style="color: black">:</td>
                                <td style="color: black">' . $bl . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">Tahun</td>
                                <td style="color: black">:</td>
                                <td style="color: black">' . $th . '</td>
                            </tr>
                        </table>
                    
                        <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px">
                            <tr>
                                <th style="text-align: center; color: black" width="5%">No</th>
                                <th style="text-align: center; color: black">Keterangan</th>
                                <th style="text-align: center; color: black">Jumlah</th>
                            </tr>
                            <tr>
                                <td style="color: black">1</td>
                                <td style="color: black">Gaji Pokok</td>
                                <td style="color: black">Rp. ' . $gaji_pokok . '</td>
                            </tr>
                    
                            <tr>
                                <td style="color: black">2</td>
                                <td style="color: black">Tunjangan Transportasi</td>
                                <td style="color: black">Rp. ' . $tunj_trans . '</td>
                            </tr>
                    
                            <tr>
                                <td style="color: black">3</td>
                                <td style="color: black">Uang Makan</td>
                                <td style="color: black">Rp. ' . $uang_makan . '</td>
                            </tr>
                    
                            <tr>
                                <td rowspan="3" style="color: black">4</td>
                                <td rowspan="3" style="color: black">Potongan</td>
                                <td style="color: black">Alpha(' . $v->alpha . ') : Rp. ' . $get_alpha . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">Sakit(' . $v->sakit . ') : Rp. ' . $get_sakit . '</td>
                            </tr>
                            <tr>
                                <td style="color: black">Total Potongan : Rp. ' . $pt . '</td>
                            </tr>
                    
                            <tr>
                                <th colspan="2" style="text-align: right; color: black">Total Gaji : </th>
                                <th style="color: black">Rp. ' . $t_gaji . '</th>
                            </tr>
                            <tr>
                                <td style="color: black">5</td>
                                <td style="color: black">Zakat</td>
                                <td style="color: black">Total Zakat : Rp. ' . $t_zakat . ' (' . $persen_zakat . '%)</td>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align: right; color: black">Total Gaji Setelah Zakat : </th>
                                <th style="color: black">Rp. ' . $t_gaji_s_zakat . '</th>
                            </tr>
                        </table>
                    
                        <table width="100%" style="margin-top: 10px">
                            <tr>
                                <td style="color: black"></td>
                                <td style="color: black">
                                    <p>Pegawai</p>
                                    <br>
                                    <br>
                                    <p style="color: black">' . $v->nama_pegawai . '</p>
                                </td>
                    
                                <td style="color: black" width="200px">
                                    <p>Kudus, ' . $tg . ' <br> Finance,
                                    </p>
                                    <br>
                                    <br>
                                    <p>___________________</p>
                                </td>
                            </tr>
                        </table>
                    </center>
                </body>';
            $this->_sendEmail($v->email, 'Laporan Gaji', $w);
        }
        echo "------------------ FINISH!!! ------------------";
    }

    private function _sendEmail($email, $subjek, $pesan)
    {
        try {
            //code...
            $conf = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => '',
                'smtp_pass' => '',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];

            $this->load->library('email', $conf);

            $this->email->from('tasywiqul.furqon@gmail.com', 'Pengurus Pondok Pesantren Tasywiqul Furqon Kudus');
            // $this->email->to('masyaqin37@gmail.com');
            $this->email->to($email);
            // $this->email->subject('coba');
            $this->email->subject($subjek);
            // $this->email->message('<h1 style="color:blue;text-align:center;">ini adalah pesan</h1>');
            $this->email->message($pesan);

            $this->email->send();
        } catch (Exception $e) {
            //throw $th;
            echo $e;
        }
    }
}
