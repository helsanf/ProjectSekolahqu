<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prestasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Prestasi_Model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','prestasi/tbl_prestasi_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Prestasi_Model->json();
    }

    public function read($id) 
    {
        $row = $this->Prestasi_Model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_prestasi' => $row->id_prestasi,
		'nama_prestasi' => $row->nama_prestasi,
		'tanggal_didapat' => $row->tanggal_didapat,
		'deskripsi' => $row->deskripsi,
		'image' => $row->image,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','prestasi/tbl_prestasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prestasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('prestasi/create_action'),
	    'id_prestasi' => set_value('id_prestasi'),
	    'nama_prestasi' => set_value('nama_prestasi'),
	    'tanggal_didapat' => set_value('tanggal_didapat'),
	    'deskripsi' => set_value('deskripsi'),
	    'image' => set_value('image'),
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','prestasi/tbl_prestasi_form', $data);
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
		'nama_prestasi' => $this->input->post('nama_prestasi',TRUE),
		'tanggal_didapat' => $this->input->post('tanggal_didapat',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'image' => $foto['file_name'],
		'id_sekolah' => $session,
	    );

            $this->Prestasi_Model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('prestasi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Prestasi_Model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('prestasi/update_action'),
		'id_prestasi' => set_value('id_prestasi', $row->id_prestasi),
		'nama_prestasi' => set_value('nama_prestasi', $row->nama_prestasi),
		'tanggal_didapat' => set_value('tanggal_didapat', $row->tanggal_didapat),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'image' => set_value('image', $row->image),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','prestasi/tbl_prestasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prestasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $session = $this->session->userdata('id_sekolah');
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_prestasi', TRUE));
        } if(!empty($_FILES['image']['name'])){
            foreach ($this->Prestasi_Model->get_gambar($this->input->post('id_prestasi')) as $get){
                if(file_exists('uploads/prestasi/'.$get->image)){
                unlink('uploads/prestasi/'.$get->image);
                }
            }
            $data = array(
                'nama_prestasi' => $this->input->post('nama_prestasi',TRUE),
                'tanggal_didapat' => $this->input->post('tanggal_didapat',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'image' => $foto['file_name'],
                'id_sekolah' => $session,
                );
        
                    $this->Prestasi_Model->update($this->input->post('id_prestasi', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('prestasi'));
        }
        
        
        else {
            $data = array(
		'nama_prestasi' => $this->input->post('nama_prestasi',TRUE),
		'tanggal_didapat' => $this->input->post('tanggal_didapat',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		
		'id_sekolah' => $session,
	    );

            $this->Prestasi_Model->update($this->input->post('id_prestasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('prestasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Prestasi_Model->get_by_id($id);

        if ($row) {
            unlink('uploads/prestasi/'.$row->image);
            
            $this->Prestasi_Model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('prestasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prestasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_prestasi', 'nama prestasi', 'trim|required');
	$this->form_validation->set_rules('tanggal_didapat', 'tanggal didapat', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	// $this->form_validation->set_rules('image', 'image', 'trim|required');
	// $this->form_validation->set_rules('id_sekolah', 'id sekolah', 'trim|required');

	$this->form_validation->set_rules('id_prestasi', 'id_prestasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    function upload_foto(){
        $config['upload_path']          = 'uploads/prestasi/';
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
