<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Degree_model extends MY_Model {
    
    protected $primary_key = 'd_id';
    
    public $before_create = array('timestamps');
    public $before_get = array('department_filter');

    /**
     * Set timestamp field
     * @param array $degree
     * @return array
     */
    protected function timestamps($degree) {
        $degree['created_date'] = date('Y-m-d H:i:s');
        
        return $degree;
    }
    
   function department_filter()
   {
       
       if($this->session->userdata('professor_id'))
       {           
          $this->db->where('d_id',$this->session->userdata('professor_department'));
       }   
   }
    
}