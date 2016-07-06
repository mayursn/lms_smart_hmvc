<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_slider_model extends MY_Model {

    protected $primary_key = 'banner_id';
    public $before_create = array('timestamps');

    /**
     * Set the timestamp
     * @param array $banner
     * @return array
     */
    protected function timestamps($banner) {
        $banner['created_date'] = date('Y-m-d H:i:s');
        return $banner;
    }
    
}
