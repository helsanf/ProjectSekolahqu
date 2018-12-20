<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kalenderakademik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Kalender_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','kalenderakademik/tbl_kalender_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kalender_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kalender_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kalender' => $row->id_kalender,
		'nama_kalender' => $row->nama_kalender,
		'tanggal' => $row->tanggal,
		'id_bulan' => $row->id_bulan,
		'id_sekolah' => $row->id_sekolah,
	    );
            $this->template->load('template','kalenderakademik/tbl_kalender_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kalenderakademik'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kalenderakademik/create_action'),
            'bulan' => $this->Kalender_model->get_bulan()->result(),
	    'id_kalender' => set_value('id_kalender'),
        'nama_kalender' => set_value('nama_kalender'),
	    'id_bulan' => set_value('id_bulan'),        
	    'tanggal' => set_value('tanggal'),
	    'id_sekolah' => set_value('id_sekolah'),
	);
        $this->template->load('template','kalenderakademik/tbl_kalender_form', $data);
    }
    
    public function create_action() 
    {
        $id_sekolah = $this->session->userdata('id_sekolah');
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kalender' => $this->input->post('nama_kalender',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_bulan' => $this->input->post('bulan',TRUE),
		'id_sekolah' => $id_sekolah,
	    );

            $this->Kalender_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('kalenderakademik'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kalender_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kalenderakademik/update_action'),
                'bulan' => $this->Kalender_model->get_bulan()->result(),         
		'id_kalender' => set_value('id_kalender', $row->id_kalender),
		'nama_kalender' => set_value('nama_kalender', $row->nama_kalender),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'id_bulan' => set_value('bulan', $row->id_bulan),
		'id_sekolah' => set_value('id_sekolah', $row->id_sekolah),
	    );
            $this->template->load('template','kalenderakademik/tbl_kalender_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kalenderakademik'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $id_sekolah = $this->session->userdata('id_sekolah');
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kalender', TRUE));
        } else {
            $data = array(
		'nama_kalender' => $this->input->post('nama_kalender',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_bulan' => $this->input->post('bulan',TRUE),
		'id_sekolah' =>  $id_sekolah,
	    );

            $this->Kalender_model->update($this->input->post('id_kalender', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kalenderakademik'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kalender_model->get_by_id($id);

        if ($row) {
            $this->Kalender_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kalenderakademik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kalenderakademik'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kalender', 'nama kalender', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	// $this->form_validation->set_rules('id_bulan', 'id bulan', 'trim|required');
	// $this->form_validation->set_rules('id_sekolah', 'id sekolah', 'trim|required');

	$this->form_validation->set_rules('id_kalender', 'id_kalender', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
