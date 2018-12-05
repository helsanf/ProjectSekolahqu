<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fasilitas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Fasilitas_Model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','fasilitas/tbl_fasilitas_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Fasilitas_Model->json();
    }

    public function read($id) 
    {
        $row = $this->Fasilitas_Model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fasilitas' => $row->id_fasilitas,
		'nama_fasilitas' => $row->nama_fasilitas,
		'image' => $row->image,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','fasilitas/tbl_fasilitas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('fasilitas/create_action'),
	    'id_fasilitas' => set_value('id_fasilitas'),
	    'nama_fasilitas' => set_value('nama_fasilitas'),
	    'image' => set_value('image'),
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','fasilitas/tbl_fasilitas_form', $data);
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
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'image' => $foto['file_name'],
		'id_sekolah' =>$session,
	    );

            $this->Fasilitas_Model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fasilitas_Model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fasilitas/update_action'),
		'id_fasilitas' => set_value('id_fasilitas', $row->id_fasilitas),
		'nama_fasilitas' => set_value('nama_fasilitas', $row->nama_fasilitas),
		'image' => set_value('image', $row->image),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','fasilitas/tbl_fasilitas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        $session = $this->session->userdata('id_sekolah');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fasilitas', TRUE));
        }  if(!empty($_FILES['image']['name'])){
            foreach ($this->Fasilitas_Model->get_gambar($this->input->post('id_fasilitas')) as $get){
                if(file_exists('uploads/fasilitas/'.$get->image)){
                unlink('uploads/fasilitas/'.$get->image);
                }
            }
            $data = array(
                'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
                'image' => $foto['file_name'],
                'id_sekolah' => $session,
                );
        
                    $this->Fasilitas_Model->update($this->input->post('id_fasilitas', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('fasilitas'));
        }
        
        
        else {
            $data = array(
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		
		'id_sekolah' => $session,
	    );

            $this->Fasilitas_Model->update($this->input->post('id_fasilitas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fasilitas_Model->get_by_id($id);

        if ($row) {
            unlink('uploads/fasilitas/'.$row->image);

            $this->Fasilitas_Model->delete($id);

            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fasilitas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_fasilitas', 'nama fasilitas', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function upload_foto(){
        $config['upload_path']          = 'uploads/fasilitas/';
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

