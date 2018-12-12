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
class fasilitas extends REST_Controller{
function __construct($config ='rest'){
        parent::__construct($config);
    }

    function index_get(){
        $id_fasilitas = $this->get('id_fasilitas');
        $id_sekolah = $this->get('id_sekolah');
        
        if($id_sekolah != ''){
            //query count CI
            $this->db->where('id_sekolah',$id_sekolah);
            $query=$this->db->count_all_results('tbl_fasilitas');
        
            //where result
            $this->db->where('id_sekolah',$id_sekolah);
            $berita = array(
              'jumlah_data' => $query,                
              'spesifik_sekolah' => $this->db->get('tbl_fasilitas')->result(),
            );
        }
       else if($id_fasilitas == '') {
            $berita['results_fasilitas']=$this->db->get('tbl_fasilitas')->result();
        }else {    
            $this->db->where('id_fasilitas',$id_fasilitas);
            $berita=$this->db->get('tbl_fasilitas')->row();
        }
        $this->response($berita,REST_Controller::HTTP_OK);
    }
}
     
 
?>