<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fasilitas_Model extends CI_Model
{

    public $table = 'tbl_fasilitas';
    public $id = 'id_fasilitas';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $id_sekolah = $this->session->userdata('id_sekolah');
        if($id_sekolah != 0){
            $this->datatables->select('id_fasilitas,nama_fasilitas,id_sekolah');
            $this->datatables->where('id_sekolah',$id_sekolah);
            $this->datatables->from('tbl_fasilitas');
            //add this line for join
            //$this->datatables->join('table2', 'tbl_fasilitas.field = table2.field');
            $this->datatables->add_column('action', anchor(site_url('fasilitas/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('fasilitas/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                    ".anchor(site_url('fasilitas/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_fasilitas');
            return $this->datatables->generate();
        }else{
            $this->datatables->select('id_fasilitas,nama_fasilitas,id_sekolah');
        $this->datatables->from('tbl_fasilitas');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_fasilitas.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('fasilitas/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('fasilitas/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('fasilitas/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_fasilitas');
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
        $this->db->like('id_fasilitas', $q);
	$this->db->or_like('nama_fasilitas', $q);
	$this->db->or_like('id_sekolah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_fasilitas', $q);
	$this->db->or_like('nama_fasilitas', $q);
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

    public function insert_gambar($data = array()){
        $insert = $this->db->insert_batch('gambar_fasilitas',$data);
        return $insert?true:false;
    }
    function get_gambar_by_id($id){
        $this->db->where('id_fasilitas',$id);
        $query = $this->db->get('gambar_fasilitas')->result();
        return $query;
    }
    function delete_gambar($id){
        $this->db->where('id_fasilitas', $id);
        $this->db->delete('gambar_fasilitas');
    }

}
