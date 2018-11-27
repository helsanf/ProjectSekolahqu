<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ekskul extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ekskul_Model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ekskul/tbl_ekskul_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ekskul_Model->json();
    }

    public function read($id) 
    {
        $row = $this->Ekskul_Model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ekskul' => $row->id_ekskul,
		'nama_ekskul' => $row->nama_ekskul,
		'deskripsi' => $row->deskripsi,
		'pembina' => $row->pembina,
		'image' => $row->image,
		'ketua' => $row->ketua,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','ekskul/tbl_ekskul_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ekskul'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ekskul/create_action'),
	    'id_ekskul' => set_value('id_ekskul'),
	    'nama_ekskul' => set_value('nama_ekskul'),
	    'deskripsi' => set_value('deskripsi'),
	    'pembina' => set_value('pembina'),
	    'image' => set_value('image'),
	    'ketua' => set_value('ketua'),
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','ekskul/tbl_ekskul_form', $data);
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
		'nama_ekskul' => $this->input->post('nama_ekskul',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'pembina' => $this->input->post('pembina',TRUE),
		'image' =>$foto['file_name'],
		'ketua' => $this->input->post('ketua',TRUE),
		'id_sekolah' => $session,
	    );

            $this->Ekskul_Model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('ekskul'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ekskul_Model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ekskul/update_action'),
		'id_ekskul' => set_value('id_ekskul', $row->id_ekskul),
		'nama_ekskul' => set_value('nama_ekskul', $row->nama_ekskul),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'pembina' => set_value('pembina', $row->pembina),
		'image' => set_value('image', $row->image),
		'ketua' => set_value('ketua', $row->ketua),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','ekskul/tbl_ekskul_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ekskul'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        $session = $this->session->userdata('id_sekolah');
        
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ekskul', TRUE));
        }  if(!empty($_FILES['image']['name'])){
            foreach ($this->Ekskul_Model->get_gambar($this->input->post('id_ekskul')) as $get){
                if(file_exists('uploads/ekskul/'.$get->image)){
                unlink('uploads/ekskul/'.$get->image);
                }
            }
            $data = array(
                'nama_ekskul' => $this->input->post('nama_ekskul',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'pembina' => $this->input->post('pembina',TRUE),
                'image' => $foto['file_name'],
                'ketua' => $this->input->post('ketua',TRUE),
                'id_sekolah' => $session,
                );
        
                    $this->Ekskul_Model->update($this->input->post('id_ekskul', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('ekskul'));
        } 
        
        else {
            $data = array(
		'nama_ekskul' => $this->input->post('nama_ekskul',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'pembina' => $this->input->post('pembina',TRUE),
		'ketua' => $this->input->post('ketua',TRUE),
		'id_sekolah' => $session,
	    );

            $this->Ekskul_Model->update($this->input->post('id_ekskul', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ekskul'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ekskul_Model->get_by_id($id);

        if ($row) {
            $this->Ekskul_Model->delete($id);
            unlink('uploads/ekskul/'.$row->image);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ekskul'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ekskul'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_ekskul', 'nama ekskul', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('pembina', 'pembina', 'trim|required');
	$this->form_validation->set_rules('ketua', 'ketua', 'trim|required');


	$this->form_validation->set_rules('id_ekskul', 'id_ekskul', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    function upload_foto(){
        $config['upload_path']          = 'uploads/ekskul/';
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
