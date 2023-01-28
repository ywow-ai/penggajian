<?php

class Mail extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();

    //     if ($this->session->userdata('hak_akses') != '1') {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     		<strong>Anda Belum Login!</strong>
    //     		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     		<span aria-hidden="true">&times;</span>
    //     		</button>
    //     		</div>');
    //         redirect('login');
    //     }
    //     $this->_sendEmail();
    // }

    public function index()
    {

        // $this->load->view('template_admin/header');
        // $this->load->view('template_admin/sidebar');
        $this->_sendEmail();
        // $this->load->view('admin/about');
        // $this->load->view('template_admin/footer');
    }

    private function _sendEmail()
    {
        try {
            //code...
            $conf = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'yaqincoreid@gmail.com',
                'smtp_pass' => 'eyjkdqvbzbvfdkyj',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];

            $this->load->library('email', $conf);

            $this->email->from('yaqincoreid@gmail.com', 'Cah Nom');
            $this->email->to('masyaqin37@gmail.com');
            $this->email->subject('coba');
            $this->email->message('ini adalah pesan');

            $this->email->send();
        } catch (Exception $e) {
            //throw $th;
            echo $e;
        }
    }
}
