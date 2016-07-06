<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library_manager_model extends MY_Model {
    
    protected $primary_key = 'lm_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $library
     * @return array
     */
    protected function timestamps($library) {
        $library['created_date'] = date('Y-m-d H:i:s');
        
        return $library;
    }
    
}