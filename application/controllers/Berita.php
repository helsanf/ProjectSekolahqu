<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_berita_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','berita/tbl_berita_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_berita_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_berita_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_berita' => $row->id_berita,
		'nama_berita' => $row->nama_berita,
		'tanggal_berita' => $row->tanggal_berita,
		'deskripsi' => $row->deskripsi,
		'image' => $row->image,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','berita/tbl_berita_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('berita'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('berita/create_action'),
	    'id_berita' => set_value('id_berita'),
	    'nama_berita' => set_value('nama_berita'),
	    'tanggal_berita' => set_value('tanggal_berita'),
	    'deskripsi' => set_value('deskripsi'),
	    'image' => set_value('image'),
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','berita/tbl_berita_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        $session = $this->session->userdata('id_sekolah');
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_berita' => $this->input->post('nama_berita',TRUE),
		'tanggal_berita' => $this->input->post('tanggal_berita',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'image' =>$foto['file_name'],
		'id_sekolah' => $session,
	    );

            $this->Tbl_berita_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('berita'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_berita_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('berita/update_action'),
		'id_berita' => set_value('id_berita', $row->id_berita),
		'nama_berita' => set_value('nama_berita', $row->nama_berita),
		'tanggal_berita' => set_value('tanggal_berita', $row->tanggal_berita),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'image' => set_value('image', $row->image),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','berita/tbl_berita_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('berita'));
        }
    }
    
    public function update_action() 
    {
        $session = $this->session->userdata('id_sekolah');        
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_berita', TRUE));
        } if(!empty($_FILES['image']['name'])){
            foreach ($this->Tbl_berita_model->get_gambar($this->input->post('id_berita')) as $get){
                if(file_exists('uploads/berita/'.$get->image)){
                unlink('uploads/berita/'.$get->image);
                }
            }
            $data = array(
                'nama_berita' => $this->input->post('nama_berita',TRUE),
                'tanggal_berita' => $this->input->post('tanggal_berita',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'image' => $foto['file_name'],
                'id_sekolah' => $session,
                );
        
                    $this->Tbl_berita_model->update($this->input->post('id_berita', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('berita'));
        }
        
        else {
            $data = array(
		'nama_berita' => $this->input->post('nama_berita',TRUE),
		'tanggal_berita' => $this->input->post('tanggal_berita',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'id_sekolah' => $session,
	    );

            $this->Tbl_berita_model->update($this->input->post('id_berita', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('berita'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_berita_model->get_by_id($id);

        if ($row) {
            $this->Tbl_berita_model->delete($id);
            unlink('uploads/berita/'.$row->image);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('berita'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('berita'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_berita', 'nama berita', 'trim|required');
	$this->form_validation->set_rules('tanggal_berita', 'tanggal berita', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	// $this->form_validation->set_rules('id_sekolah', 'id sekolah', 'trim|required');

	$this->form_validation->set_rules('id_berita', 'id_berita', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    function upload_foto(){
        $config['upload_path']          = 'uploads/berita/';
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