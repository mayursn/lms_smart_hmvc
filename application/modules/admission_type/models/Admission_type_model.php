<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_type_model extends MY_Model {

    protected $primary_key = 'at_id';
    public $before_create = array('timestamps');

    /**
     * Set timestamp fields
     * @param array $admission_type
     * @return type
     */
    protected function timestamps($admission_type) {
        $admission_type['created_date'] = date('Y-m-d H:i:s');

        return $admission_type;
    }

}
