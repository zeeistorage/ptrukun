<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model("General_model");
        // $this->load->helper('globals');
        $this->load->library("form_validation");
        // $this->load->helper("url");
    }

    public function index_get(){
        $this->set_response([
            'status' => FALSE,
            'message' => 'Metode Not Allowed For Login!'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }

    public function index_post(){
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->set_response([
                'status' => FALSE,
                'message' => 'Missing Email or Password!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }else{
            // echo "OKE";
            $data = $this->login($email,$password);
            $this->set_response(json_decode($data), REST_Controller::HTTP_OK);
        }
    }

    private function login($email,$password){

        // set post fields
        $post = [
            'email' => $email,
            'password' => $password
        ];

        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/login");
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //             'X-rs-id: 3372165',
        //             'X-Timestamp: '.$timestam.'',
        //             'X-pass: S!rs2020!!',
        //             ));
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "email=$email&password=$password");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);      

        // menampilkan hasil curl
        return $output;
    }

}
