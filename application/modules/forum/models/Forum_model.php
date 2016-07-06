<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends MY_Model {
    
    protected $primary_key = 'forum_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $degree
     * @return array
     */
    protected function timestamps($forum) {
        $forum['created_date'] = date('Y-m-d H:i:s');
        
        return $forum;
    }
}