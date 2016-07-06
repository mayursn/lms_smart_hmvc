<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_comment_model extends MY_Model {
    
    protected $primary_key = 'forum_comment_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $forumcomment
     * @return array
     */
    protected function timestamps($forumcomment) {
        $forumcomment['created_date'] = date('Y-m-d H:i:s');
        
        return $forumcomment;
    }
}