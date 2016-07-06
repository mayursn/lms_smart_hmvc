<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_manager_model extends MY_Model {
    
    protected $primary_key = 'event_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $degree
     * @return array
     */
    protected function timestamps($event) {
        $event['created_date'] = date('Y-m-d H:i:s');
        
        return $event;
    }
}