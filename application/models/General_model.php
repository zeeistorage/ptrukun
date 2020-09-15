<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model
{
    public function custom($query)
    {
        $query =$this->db->query($query);
        // echo var_dump($query);
        $result = $query->row_array();
        
        return $result;
    }
    public function custom_resarray($query)
    {
        $query =$this->db->query($query);
        // echo var_dump($query);
        $result = $query->result_array();
        
        return $result;
    }
    
    public function customcount($query)
    {
        $query =$this->db->query($query);
        // echo var_dump($query);
        $result = count($query->result_array());
        
        return $result;
    }
    
    

}