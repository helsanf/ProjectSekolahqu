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
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','fasilitas/tbl_fasilitas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $id_sekolah = $this->session->userdata('id_sekolah');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'id_sekolah' =>  $id_sekolah,
	    );

        $insert_id = $this->Fasilitas_Model->insert($data);
        $this->upload_gambar($insert_id);
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
        $id_fasilitas = $this->input->post('id_fasilitas');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fasilitas', TRUE));
        } else {
            $data = array(
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'id_sekolah' => $this->input->post('id_sekolah',TRUE),
        );
        
        $this->Fasilitas_Model->update($this->input->post('id_fasilitas', TRUE), $data);
            
        // $this->Fasilitas_model->update($id_fasilitas);
        if(!empty($_FILES['userFiles']['name'][0])){
            foreach ($this->Fasilitas_Model->get_gambar_by_id($id_fasilitas) as $get){
                if(file_exists('uploads/fasilitas/'.$get->image)){
                unlink('uploads/fasilitas/'.$get->image);
                $this->Fasilitas_Model->delete_gambar('id_fasilitas');
                }
            }
            $this->Fasilitas_Model->delete_gambar($id_fasilitas);
        }
        $this->upload_gambar($id_fasilitas);


            // $this->Fasilitas_Model->update($this->input->post('id_fasilitas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fasilitas_Model->get_by_id($id);

        if ($row) {

            foreach ($this->Fasilitas_Model->get_gambar_by_id($id) as $get){
                if(file_exists('uploads/fasilitas/'.$get->image)){
                unlink('uploads/fasilitas/'.$get->image);
                $this->Fasilitas_Model->delete_gambar($id);
                }
            }

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
	// $this->form_validation->set_rules('id_sekolah', 'id sekolah', 'trim|required');

	$this->form_validation->set_rules('id_fasilitas', 'id_fasilitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function upload_gambar($id){
        $data = array();
        if(!empty($_FILES['userFiles']['name'])){

            $filesCount = count($_FILES['userFiles']['name']);
            $uploadData = [];
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $uploadPath = 'uploads/fasilitas/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['image'] = $fileData['file_name'];
                    $uploadData[$i]['id_fasilitas'] = $id;

                }
            }

            if(!empty($uploadData)){
                //Insert file information into the database
                $insert = $this->Fasilitas_Model->insert_gambar($uploadData);
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
            }
        }

        $this->template->load('template','fasilitas/tbl_fasilitas_form',$data);

    }

}
