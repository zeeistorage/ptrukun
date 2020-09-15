<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller {

    public function index_get(){
        
        $page = $this->input->get('page');
        if($page==NULL){
            $page=1;
        }
        $data = $this->curlku($page);
        
        // echo $page;
    }

    private function curlku($page){
    // $now = new DateTime();
    $now = new DateTime(null, new DateTimeZone('UTC'));
    // echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
    // echo "<br>";
    // echo $now->getTimestamp();  
    // $timestam = $now->getTimestamp();

    // die();
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

}

?>