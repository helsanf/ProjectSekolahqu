<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acara extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Acara_Model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','acara/tbl_acara_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Acara_Model->json();
    }

    public function read($id) 
    {
        $row = $this->Acara_Model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_acara' => $row->id_acara,
		'nama_acara' => $row->nama_acara,
		'tanggal_acara' => $row->tanggal_acara,
		'deskripsi' => $row->deskripsi,
		'image' => $row->image,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','acara/tbl_acara_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acara'));
        }
    }

    public function create() 
    {
        $session = $this->session->userdata('id_sekolah');
        $data = array(
            'button' => 'Create',
            'action' => site_url('acara/create_action'),
	    'id_acara' => set_value('id_acara'),
	    'nama_acara' => set_value('nama_acara'),
	    'tanggal_acara' => set_value('tanggal_acara'),
	    'deskripsi' => set_value('deskripsi'),
	    'image' => set_value('image'),
	    'id_sekolah' => set_value($session),
	);
        $this->template->load('template','acara/tbl_acara_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $session = $this->session->userdata('id_sekolah');
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_acara' => $this->input->post('nama_acara',TRUE),
		'tanggal_acara' => $this->input->post('tanggal_acara',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'image' =>$foto['file_name'],
		'id_sekolah' => $session,
        );
        // print_r($data);
        // die();

            $this->Acara_Model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('acara'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Acara_Model->get_by_id($id);
        // $session = $this->session->userdata('id_sekolah');

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('acara/update_action'),
		'id_acara' => set_value('id_acara', $row->id_acara),
		'nama_acara' => set_value('nama_acara', $row->nama_acara),
		'tanggal_acara' => set_value('tanggal_acara', $row->tanggal_acara),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'image' => set_value('image', $row->image),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','acara/tbl_acara_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acara'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $session = $this->session->userdata('id_sekolah');
        $foto = $this->upload_foto();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_acara', TRUE));
        }   if(!empty($_FILES['image']['name'])){
            foreach ($this->Acara_Model->get_gambar($this->input->post('id_acara')) as $get){
                if(file_exists('uploads/acara/'.$get->image)){
                unlink('uploads/acara/'.$get->image);
                }
            }
            $data = array(
                'nama_acara' => $this->input->post('nama_acara',TRUE),
                'tanggal_acara' => $this->input->post('tanggal_acara',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'id_sekolah' => $session,
                'image' =>  $foto['file_name'],
            );
        
            $this->Acara_Model->update($this->input->post('id_acara', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('acara'));
        } else {
            $data = array(
		'nama_acara' => $this->input->post('nama_acara',TRUE),
		'tanggal_acara' => $this->input->post('tanggal_acara',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'id_sekolah' => $session,
	    );

            $this->Acara_Model->update($this->input->post('id_acara', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('acara'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Acara_Model->get_by_id($id);

        if ($row) {
            unlink('uploads/acara/'.$row->image);
            $this->Acara_Model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('acara'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acara'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_acara', 'nama acara', 'trim|required');
	$this->form_validation->set_rules('tanggal_acara', 'tanggal acara', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	// $this->form_validation->set_rules('image', 'image', 'trim|required');
	// $this->form_validation->set_rules('id_sekolah', 'id sekolah', 'trim|required');

	$this->form_validation->set_rules('id_acara', 'id_acara', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function upload_foto(){
        $config['upload_path']          = 'uploads/acara/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        return $this->upload->data();
    }

}

