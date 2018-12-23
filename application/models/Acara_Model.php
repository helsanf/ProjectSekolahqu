<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acara_Model extends CI_Model
{

    public $table = 'tbl_acara';
    public $id = 'id_acara';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $id_sekolah = $this->session->userdata('id_sekolah');
        if($id_sekolah != 0){
            $this->datatables->select('id_acara,nama_acara,tanggal_acara,deskripsi,image,id_sekolah');
            $this->datatables->where('id_sekolah',$id_sekolah);
            $this->datatables->from('tbl_acara');
            //add this line for join
            //$this->datatables->join('table2', 'tbl_acara.field = table2.field');
            $this->datatables->add_column('action', anchor(site_url('acara/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('acara/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                    ".anchor(site_url('acara/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_acara');
            return $this->datatables->generate();
        }else{
            $this->datatables->select('id_acara,nama_acara,tanggal_acara,deskripsi,image,id_sekolah');
            // $this->datatables->where('id_sekolah',$id_sekolah);
            $this->datatables->from('tbl_acara');
            //add this line for join
            //$this->datatables->join('table2', 'tbl_acara.field = table2.field');
            $this->datatables->add_column('action', anchor(site_url('acara/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('acara/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                    ".anchor(site_url('acara/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_acara');
            return $this->datatables->generate();
        }
       
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_acara', $q);
	$this->db->or_like('nama_acara', $q);
	$this->db->or_like('tanggal_acara', $q);
	$this->db->or_like('deskripsi', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('id_sekolah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_acara', $q);
	$this->db->or_like('nama_acara', $q);
	$this->db->or_like('tanggal_acara', $q);
	$this->db->or_like('deskripsi', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('id_sekolah', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {

        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function get_gambar($id){
        $this->db->where('id_acara',$id);
        return $this->db->get('tbl_acara')->result();
    }

 

}

