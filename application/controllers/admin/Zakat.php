<?php
class Zakat extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelZakat');

        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda Belum Login!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('login');
        }
    }

    function index()
    {

        $data['zakat'] = $this->ModelZakat->tampilZakat('zakat');

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/zakat', $data);
        $this->load->view('template_admin/footer');
    }

    function tambah()
    {
        $jenis_zakat = $this->input->post('nama_zakat');
        $potongan = $this->input->post('jumlah_potongan');

        $data = array(
            'nama_zakat' => $jenis_zakat,
            'potongan' => $potongan
        );

        $this->ModelZakat->insert_data($data, 'zakat');
        redirect('admin/zakat');
    }

    function edit()
    {
        $jenis_zakat = $this->input->post('nama_zakat');
        $potongan = $this->input->post('jumlah_potongan');

        $data = array(
            'nama_zakat' => $jenis_zakat,
            'potongan' => $potongan
        );
        $where = array(
            'id' => $jenis_zakat = $this->input->post('id_zakat')
        );
        $this->ModelZakat->update_data('zakat', $data, $where);
        redirect('admin/zakat');
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->ModelZakat->delete_data($where, 'zakat');
        redirect('admin/zakat');
    }
}
