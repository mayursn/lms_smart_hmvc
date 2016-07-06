<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Study_resources_model extends MY_Model {
    
    protected $primary_key = 'study_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $studyresource
     * @return array
     */
    protected function timestamps($studyresource) {
        $studyresource['created_date'] = date('Y-m-d H:i:s');        
        return $studyresource;
    }
}