<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Semester_model extends MY_Model {

    protected $primary_key = 's_id';
    public $before_create = array('timestamps');

    /**
     * Set the timestamp
     * @param array $semester
     * @return array
     */
    protected function timestamps($semester) {
        $semester['created_date'] = date('Y-m-d H:i:s');

        return $semester;
    }

    /**
     * Semester list from branch
     * @param string $branch_id
     * @return array
     */
    public function semester_branch($branch_id) {
        $branch = $this->db->select()
                        ->from('course')
                        ->where([
                            'course_id' => $branch_id
                        ])->get()->row();

        $semester = explode(',', $branch->semester_id);

        $all_semester = $this->get_all();

        foreach ($all_semester as $row) {
            if (in_array($row->s_id, $semester)) {
                $semdata[] = $row;
            }
        }

        return $semdata;
    }

}
