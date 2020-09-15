<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller {

    public function index_get($id=''){
        

        if($id==NULL||$id==''){
            $page = $this->input->get();
            if($page==NULL){
                $page=1;
                $data = $this->curlku($page);
    
                if($data){
                    $this->set_response(json_decode($data), REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                        'status' => False,
                        'data' => [],
                        'message' => 'Gagal Request'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
                
            }elseif ($this->input->get('id')) {
                 // Panggil Single User
                $data = $this->single_user($this->input->get('id'));
                if($data){
                    $this->set_response(json_decode($data), REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                        'status' => False,
                        'data' => [],
                        'message' => 'Gagal Request'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
                    
            }else{
                $page=$this->input->get('page');
                
                $data = $this->curlku($page);
    
                if($data){
                    $this->set_response(json_decode($data), REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                        'status' => False,
                        'data' => [],
                        'message' => 'Gagal Request'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            
            
        }else{
            $data = $this->single_user($id);
            if($data){
                $this->set_response(json_decode($data), REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                    'status' => False,
                    'data' => [],
                    'message' => 'Gagal Request'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        
    }

    private function curlku($page){

        // persiapkan curl
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users?page=$page");
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //             'X-rs-id: 3372165',
        //             'X-Timestamp: '.$timestam.'',
        //             'X-pass: S!rs2020!!',
        //             ));
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);      

        // menampilkan hasil curl
        return $output;
    }

    private function single_user($id){
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users/$id");
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //             'X-rs-id: 3372165',
        //             'X-Timestamp: '.$timestam.'',
        //             'X-pass: S!rs2020!!',
        //             ));
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

?>