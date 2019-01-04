<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Password extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
      
        $this->load->model('User_model');

  
    }
    function index(){
        $this->load->view('auth/change-form');
    }

    function forgot(){
        // $this->load->view('auth/change-form');
        $email = $this->input->post('email');
        $date = md5(date("Y-m-d H:i:s"));
        if(isset($_POST['submit'])){
            $data = array(
                'email' =>$email
            );
            $cek = $this->User_model->cek_email("tbl_user",$data)->row();
            if(isset($cek)){
                $this->email();
                //send email
                $this->email->from('sekolahqu@dscunikom.com');
                $this->email->to($email);
                $this->email->subject('LUPA PASSWORD');
                $data = array(
                    'email'=> $email
                );
               $this->User_model->update_token($date.'-'.$cek->id_users,$email);
               $get = $this->User_model->cek_email("tbl_user",$data)->row();
                // $body = $this->load->view('USER/confirm',$data,TRUE);
                $message = 'Dear , '. $cek->full_name .',<br><br>Silahkan Klik Link dibawah ini untuk mengganti Password anda! Terima kasih!<br><br>
                 <a href=\'http://localhost/sekolahqu/index.php/change-password/'.$get->forgot_token.'\'>GANTI PASSWORD</a><br><br>Thanks';
                $this->email->message($message);
                $this->email->send();
                // die();
                echo '<script language="javascript">';
                echo 'alert("SILAHKAN PERIKSA EMAIL ANDA UNTUK PROSES GANTI PASSWORD");';
                echo 'window.location="'.site_url('auth').'"';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Data Tidak Ditemukan! atau Alamat Email salah!");';
                echo 'window.location="'.site_url('register/forgot').'"';
                echo '</script>';
            }
        }
       
    }

    function form_pw($id){
        $url = $this->uri->segment('2');
        $pisah = explode("-",$url);
        $row = $this->User_model->get_by_token($url);        
        // print_r($row);
        // die();
        if($row){
            $data = array(
                'id_users' => set_value('id_users',$row->id_users),
                'forgot_token' => set_value('forgot_token',$row->forgot_token),
            );
            // print_r($data);
            // die();
        $this->load->view('auth/action-change',$data);
            
        }else{
        $this->load->view('auth/null-data');
        
        }
        // print_r($data);
        // die();
    }
    function action_forgot(){
        $newPassword = $this->input->post('password');
        $id = $this->input->post('id_users');
        $forgot = $this->input->post('forgot_token');
        $options        = array("cost"=>4);
        $hashPassword   = password_hash($newPassword,PASSWORD_BCRYPT,$options);

        $go =  array(
            'password'=>$hashPassword
          );
         $dicek =  $this->User_model->update_forgot($go,$id,$forgot);
         $this->User_model->update_token_null("",$id);
         if($dicek){
            echo '<script language="javascript">';
            echo 'alert("GANTI PASSWORD BERHASIL");';
            echo 'window.location="'.site_url('auth').'"';
            echo '</script>';
         }else{
             echo "Gagal";
         }
    }

    public function email(){

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://mail.dscunikom.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'sekolahqu@dscunikom.com';
        $config['smtp_pass'] = 'helsan1997';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";

        $this->load->library('email', $config);
        $this->email->initialize($config);


//send email
//        $this->email->from('tubesatolif6@gmail.com');
//        $this->email->to($email);
//        $this->email->subject('halo helsan');
//        $this->email->message('halo');
//
//        $this->email->send();
    }
}

?>