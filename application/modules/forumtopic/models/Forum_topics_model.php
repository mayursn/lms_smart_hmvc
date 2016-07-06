<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_topics_model extends MY_Model {
    
    protected $primary_key = 'forum_topic_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $forumtopic
     * @return array
     */
    protected function timestamps($forumtopic) {
        $forumtopic['created_date'] = date('Y-m-d H:i:s');
        
        return $forumtopic;
    }
}