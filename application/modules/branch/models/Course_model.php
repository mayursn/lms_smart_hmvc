<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends MY_Model {

    protected $primary_key = 'course_id';
    public $belongs_to = array('degree/degree');
    public $before_create = array('timestamps');
    public $before_get = array('course_filter');

    /**
     * Set the timestamp
     * @param array $branch
     */
    protected function timestamps($branch) {
        $branch['created_date'] = date('Y-m-d H:i:s');

        return $branch;
    }

    function course_filter()
    {
        if($this->session->userdata('professor_id'))
        {
            $dept = $this->session->userdata('professor_department');
            $this->db->where("degree_id",$dept);
        }
    }
    /**
     * Branch with degree
     * @return array
     */
    public function branch_with_degree() {
        return $this->db->select()
                        ->from($this->_table)
                        ->join("degree", "degree.d_id = $this->_table.degree_id")
                        ->get()->result();
    }
    
    /**
     * Branch of the specific department
     * @param string $id
     * @return array
     */
    public function department_branch($id) {
        $this->db->where('degree_id', $id);
        
        return $this->Course_model->order_by_column('c_name');
    }

}
