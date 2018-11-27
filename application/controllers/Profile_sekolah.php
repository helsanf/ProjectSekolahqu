<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_sekolah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Profile_sekolah_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','profile_sekolah/tbl_profile_sekolah_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Profile_sekolah_model->json();
    }

    public function read($id) 
    {
        $row = $this->Profile_sekolah_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_sekolah' => $row->id_sekolah,
		'nama_sekolah' => $row->nama_sekolah,
		'alamat' => $row->alamat,
		'email' => $row->email,
		'no_telp' => $row->no_telp,
		'logo_sekolah' => $row->logo_sekolah,
		'visi_misi' => $row->visi_misi,
		'kalender_akademik' => $row->kalender_akademik,
	    );
            $this->template->load('template','profile_sekolah/tbl_profile_sekolah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile_sekolah'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('profile_sekolah/create_action'),
	    'id_sekolah' => set_value('id_sekolah'),
	    'nama_sekolah' => set_value('nama_sekolah'),
	    'alamat' => set_value('alamat'),
	    'email' => set_value('email'),
	    'no_telp' => set_value('no_telp'),
	    'logo_sekolah' => set_value('logo_sekolah'),
	    'visi_misi' => set_value('visi_misi'),
	    'kalender_akademik' => set_value('kalender_akademik'),
	);
        $this->template->load('template','profile_sekolah/tbl_profile_sekolah_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        // $kalender = $this->upload_kalender();
        // die();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
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

        // print_r($data);
        //     die();
            $this->Profile_sekolah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('profile_sekolah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Profile_sekolah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profile_sekolah/update_action'),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
		'nama_sekolah' => set_value('nama_sekolah', $row->nama_sekolah),
		'alamat' => set_value('alamat', $row->alamat),
		'email' => set_value('email', $row->email),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'logo_sekolah' => set_value('logo_sekolah', $row->logo_sekolah),
		'visi_misi' => set_value('visi_misi', $row->visi_misi),
		'kalender_akademik' => set_value('kalender_akademik', $row->kalender_akademik),
	    );
            $this->template->load('template','profile_sekolah/tbl_profile_sekolah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile_sekolah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sekolah', TRUE));
        } else {
            $data = array(
		'nama_sekolah' => $this->input->post('nama_sekolah',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'email' => $this->input->post('email',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'logo_sekolah' => $this->input->post('logo_sekolah',TRUE),
		'visi_misi' => $this->input->post('visi_misi',TRUE),
		'kalender_akademik' => $this->input->post('kalender_akademik',TRUE),
	    );

            $this->Profile_sekolah_model->update($this->input->post('id_sekolah', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profile_sekolah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Profile_sekolah_model->get_by_id($id);

        if ($row) {
            $this->Profile_sekolah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profile_sekolah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile_sekolah'));
        }
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

   
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_profile_sekolah.xls";
        $judul = "tbl_profile_sekolah";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Sekolah");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Logo Sekolah");
	xlsWriteLabel($tablehead, $kolomhead++, "Visi Misi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kalender Akademik");

	foreach ($this->Profile_sekolah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_sekolah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->logo_sekolah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->visi_misi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kalender_akademik);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_profile_sekolah.doc");

        $data = array(
            'tbl_profile_sekolah_data' => $this->Profile_sekolah_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('profile_sekolah/tbl_profile_sekolah_doc',$data);
    }

}

/* End of file Profile_sekolah.php */
/* Location: ./application/controllers/Profile_sekolah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-05 18:57:12 */
/* http://harviacode.com */