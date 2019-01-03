<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Register extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
           
        $this->load->model('Profile_sekolah_model');
        $this->load->library('form_validation');        
       
      
        }
        function index(){
            $this->load->view('auth/register');
        }

        public function create_action() 
        {
            $this->_rules();
            $foto = $this->upload_foto();
            $this->email();
            if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
            } else {
                $data = array(
            'nama_sekolah' => $this->input->post('nama_sekolah',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'email' => $this->input->post('email',TRUE),
            'no_telp' => $this->input->post('no_telp',TRUE),
            'logo_sekolah' =>  $foto['logo_sekolah']['file_name'],
            'visi_misi' => $this->input->post('visi_misi',TRUE),
            'kalender_akademik' =>  $foto['kalender_akademik']['file_name'],
            );
    
           
                $this->Profile_sekolah_model->insert($data);
                 //send email
                 $this->email->from('sekolahqu@dscunikom.com');
                 $this->email->to($data['email']);
                 $this->email->subject('Terima Kasih Telah Mendaftar');
               
                 // $body = $this->load->view('USER/confirm',$data,TRUE);
                 $message = 'Dear '. $data['nama_sekolah'] .',<br><br> Terima Kasih Telah Mendaftar! Tunggu beberapa Saat Admin akan cek sekolah yang anda daftarkan valid atau tidak<br><br>';
                 $this->email->message($message);
                 $this->email->send();
                 echo '<script language="javascript">';
                 echo 'alert("SILAHKAN PERIKSA EMAIL ANDA UNTUK PROSES AKTIFASI");';
                 echo 'window.location="'.site_url('auth').'"';
                 echo '</script>';

                $this->session->set_flashdata('message', 'Create Record Success 2');
                redirect(site_url('auth'));
            }
        }

        public function email(){

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://mail.dscunikom.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'sekolahqu@dscunikom.com';
        $config['smtp_pass'] = 'helsan1997';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";

        $this->load->library('email', $config);
        $this->email->initialize($config);


//send email
//        $this->email->from('tubesatolif6@gmail.com');
//        $this->email->to($email);
//        $this->email->subject('halo helsan');
//        $this->email->message('halo');
//
//        $this->email->send();
    }

    function upload_foto(){
        $config['upload_path']          = 'uploads/profile_sekolah/';
        $config['allowed_types']        = '*';
        $config['encrypt_name'] = TRUE;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo_sekolah');
        $logo_sekolah =   $this->upload->data();
        // return $logo_sekolah;        
        // print_r($this->upload->display_errors());
        $this->upload->do_upload('kalender_akademik');    
        $kalender_akademik = $this->upload->data();
        // return $kalender_akademik;
        $file = array(
            'logo_sekolah' => $logo_sekolah,
            'kalender_akademik' => $kalender_akademik
        );
        return $file;
        // echo "<pre>";
        // print_r($file);
        // echo "</pre>";
        
        // echo "<pre>";
        // print_r($kalender_akademik);
        // echo "</pre>";
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_sekolah', 'nama sekolah', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	// $this->form_validation->set_rules('logo_sekolah', 'logo sekolah', 'trim|required');
	$this->form_validation->set_rules('visi_misi', 'visi misi', 'trim|required');
	// $this->form_validation->set_rules('kalender_akademik', 'kalender akademik', 'trim|required');

	$this->form_validation->set_rules('id_sekolah', 'id_sekolah', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    }

?>