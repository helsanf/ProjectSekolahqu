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
class profile_sekolah extends REST_Controller{
function __construct($config ='rest'){
        parent::__construct($config);
    }

    function index_get(){
        $id_sekolah = $this->get('id_sekolah');

        if ($id_sekolah == '') {
           
            $profile_sekolah['result']=$this->db->get('tbl_profile_sekolah')->result();
        }else {
            
            $this->db->where('id_sekolah',$id_sekolah);
            $profile_sekolah=$this->db->get('tbl_profile_sekolah')->row();
        }
        $this->response($profile_sekolah,REST_Controller::HTTP_OK);
    }

   
}
     
 
?>