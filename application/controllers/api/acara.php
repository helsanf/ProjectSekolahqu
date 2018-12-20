<?php
require APPPATH . 'libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class acara extends REST_Controller{
function __construct($config ='rest'){
        parent::__construct($config);
    }

    function index_get(){
        $id_acara = $this->get('id_acara');
        $id_sekolah = $this->get('id_sekolah');
        
        if($id_sekolah != ''){
            //query count CI
            $this->db->where('id_sekolah',$id_sekolah);
            $query=$this->db->count_all_results('tbl_acara');
        
            $sql = "select * from tbl_acara where id_sekolah = ? order by id_acara desc limit 1";      
            $querylimit = $this->db->query($sql,array($id_sekolah))->result();
            //where result
            $this->db->where('id_sekolah',$id_sekolah);
            $this->db->order_by('id_acara', 'DESC');
            $berita = array(
              'jumlah_data' => $query,    
              'first_data' => $querylimit,            
              'spesifik_sekolah' => $this->db->get('tbl_acara')->result(),
            );
        }
       else if($id_acara == '') {
            $berita['results_acara']=$this->db->get('tbl_acara')->result();
        }else {    
            $this->db->where('id_acara',$id_acara);
            $berita=$this->db->get('tbl_acara')->row();
        }
        $this->response($berita,REST_Controller::HTTP_OK);
    }
}
     
 
?>