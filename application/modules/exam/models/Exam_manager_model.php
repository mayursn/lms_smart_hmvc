<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_manager_model extends MY_Model {
    
    protected $primary_key = 'em_id';
    
    public $before_create = array('timestamps');
    
    /**
     * Set timestamp field
     * @param array $exam
     * @return array
     */
    protected function timestamps($exam) {
        $exam['created_date'] = date('Y-m-d H:i:s');        
        return $exam;
    }
    
     /**
     * All exam detail
     * @return array
     */
    function exam_details() {
        return $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*, batch.*, degree.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->order_by('em_date', 'DESC')
                        ->get()
                        ->result();
    }
    
      /**
     * Get all exam types
     * @return array
     */
    function get_all_exam_type() {
        return $this->db->select('exam_type_id, exam_type_name, status')
                        ->from('exam_type')
                        ->where('status', 1)
                        ->get()
                        ->result();
    }
    
     /**
     * Check exam duplication
     * @param int $degree
     * @param int $course
     * @param int $batch
     * @param int $sem
     * @param string $title
     * @return object
     */
    function exam_duplication_check($degree, $course, $batch, $sem, $title) {
        return $this->db->get_where('exam_manager', array(
                    'degree_id' => $degree,
                    'course_id' => $course,
                    'batch_id' => $batch,
                    'em_semester' => $sem,
                    'em_name' => $title
                ))->row();
    }
    
    function get_exam_details($param2)
    {
    
return $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*')
        ->from('exam_manager')
        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
        ->join('course', 'course.course_id = exam_manager.course_id')
        ->join('semester', 'semester.s_id = exam_manager.em_semester')
        ->where('exam_manager.em_id', $param2)
        ->get()
        ->row();
    }
    
    /**
     * Get filter exam
     * @param type $degree
     * @param type $course
     * @param type $batch
     * @param type $semester
     * @return type
     */
    function get_exam_filter($degree, $course, $batch, $semester) {
        return $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*, batch.*, degree.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->where(array(
                            'exam_manager.degree_id' => $degree,
                            'exam_manager.course_id' => $course,
                            'exam_manager.batch_id' => $batch,
                            'exam_manager.em_semester' => $semester
                        ))
                        ->order_by('em_date', 'DESC')
                        ->get()
                        ->result();
    }
    
    
    
    ///// Exam Manager //////
    function exam_detail($exam_id) {
        return $this->db->get_where('exam_manager', array(
                    'em_id' => $exam_id
                ))->result();
    }
    
    
    /**
     * Exam details
     * @param int $exam_id
     * @return object
     */
    function student_exam_detail($exam_id) {
        return $this->db->select()
                        ->from('exam_manager')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('exam_seat_no', 'exam_seat_no.exam_id = exam_manager.em_id')
                        ->where('em_id', $exam_id)
                        ->where('exam_seat_no.student_id', $this->session->userdata('std_id'))
                        ->get()
                        ->row();
    }
    /**
     * Exam time table subject list
     * @param int $exam_id
     * @return array
     */
    function exam_time_table_subject_list($exam_id) {
        return $this->db->select()
                        ->from('exam_time_table')
                        ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                        ->where('exam_time_table.exam_id', $exam_id)
                        ->get()
                        ->result();
    }

    /**
     * Get exam list
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function get_exam_list($degree_id, $course_id, $batch_id, $semester_id) {
        return $this->db->get_where('exam_manager', array(
                            'course_id' => $course_id,
                            'em_semester' => $semester_id,
                            'degree_id' => $degree_id,
                            'batch_id' => $batch_id,
                            'exam_ref_name' => 'reguler'
                        ))
                        ->result();
    }
    
     /**
     * Student exam list
     * @param string $course
     * @param string $semeseter
     * @return array
     */
    function student_exam_list($course, $semeseter) {
        return $this->db->select()
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->where(array(
                            'exam_manager.course_id' => $course,
                            'exam_manager.em_semester' => $semeseter,
                            'exam_manager.exam_ref_name' => 'reguler'
                        ))
                        ->order_by('exam_manager.em_start_time', 'DESC')
                        ->get()
                        ->result();
    }
    
      /**
     * Exam schedule
     * @param int $exam_id
     * @return array
     */
    function exam_schedule($exam_id) {
        return $this->db->select()
                        ->from('exam_time_table')
                        ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                        ->where('exam_time_table.exam_id', $exam_id)
                        ->get()
                        ->result();
    }
    
    /**
     * Students exam marks
     * @param int $student_id
     * @param int $exam_id
     * @return array
     */
    function student_marks($student_id, $exam_id) {
        return $this->db->select()
                        ->from('marks_manager')
                        ->join('subject_manager', 'subject_manager.sm_id = marks_manager.mm_subject_id')
                        ->where(array(
                            'mm_std_id' => $student_id,
                            'mm_exam_id' => $exam_id
                        ))
                        ->get()
                        ->result();
    }
     
}