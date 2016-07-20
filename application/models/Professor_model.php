<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Professor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*     * ****  
      Created :-- Mayur Panchal
      Message : -- For get question title

     * ** */

    function getquestion($table, $question = '', $field = 'question') {

        return $this->db->get_where($table, array('sq_id' => $question))->row()->$field;
    }

    /*  End code */

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        // echo $type_id;
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    /*     * ***
      Created : -- Brijesh
      Message :--  For subject section class name get
     * *** */

    function get_class_name_by_id($type, $type_id = '', $field = 'name_numeric') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    /* End Code */

    /* Start syllabus */

    function update_syllabus($data, $id) {
        $this->db->update("smart_syllabus", $data, array("syllabus_id" => $id));
    }

    function courseware_update($data, $id) {
        $this->db->update("courseware", $data, array("courseware_id" => $id));
    }

    function delete_syllabus($id) {
        $this->db->where("syllabus_id", $id);
        $this->db->delete("smart_syllabus");
    }

    function delete_courseware($id) {
        $this->db->where("courseware_id", $id);
        $this->db->delete("courseware");
    }

    function getsyllabus($id) {
        $this->db->where("syllabus_id", $id);
        return $this->db->get('smart_syllabus')->result();
    }

    function get_syllabus() {
        $dept = $this->session->userdata('department');
        $branch = $this->session->userdata('branch');
        $this->db->select('syllabus_id, syllabus_title, syllabus_degree, syllabus_course, syllabus_sem, syllabus_desc, syllabus_filename');
        $this->db->where("syllabus_degree", $dept);
        //$this->db->where("syllabus_course", $branch);
        return $this->db->get('smart_syllabus')->result();
    }

    function add_syllabus($data) {
        $this->db->insert("smart_syllabus", $data);
    }

    /* End Code */

    ////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

    //////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    //////////EXAMS/////////////
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    //////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';
        return $image_url;
    }

    /**
     * Get all student information
     * 
     * @return array
     */
    function get_all_students() {
        return $this->db->select()
                        ->from('student')
                        ->get()
                        ->result();
    }

    /**
     * List of all student which is belogs to particular course
     * @param int $course_id
     * @return array
     */
    function course_students($course_id) {
        return $this->db->select()
                        ->from('student')
                        ->where('course_id', $course_id)
                        ->get()
                        ->result();
    }

    /**
     * Student list by course and semester
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function student_list_by_course_semester($degree_id, $course_id, $batch_id, $semester_id) {
        return $this->db->get_where('student', array(
                    'std_degree' => $degree_id,
                    'course_id' => $course_id,
                    'std_batch' => $batch_id,
                    'semester_id' => $semester_id
                ))->result();
    }

    /// Admin ///
    function admin_detail() {
        return $this->db->select()
                        ->from('admin')
                        ->get()
                        ->row();
    }

    /// Email ///
    /**
     * Store the email data
     * 
     * @param array $name email data
     * @return int last insert id
     */
    function store_email($data) {
        $insert_id = $this->db->insert('email', $data);

        return $insert_id;
    }

    /**
     * My email inbox
     * @param string $email
     * @return array
     */
    function my_inbox($email) {
        return $this->db->select()
                        ->from('email')
                        ->where('email_to', $email)
                        ->get()
                        ->result();
    }

    /**
     * My sent email list
     * @param string $email
     * @return array
     */
    function my_sent_mail($email) {
        return $this->db->select()
                        ->from('email')
                        ->where('email_from', $email)
                        ->where('is_draft', 0)
                        ->get()
                        ->result();
    }

    /**
     * View my all drafts email
     * @param string $email
     * @return array
     */
    function my_drafts($email) {
        return $this->db->select()
                        ->from('email')
                        ->where('email_from', $email)
                        ->where('is_draft', 1)
                        ->get()
                        ->result();
    }

    /**
     * View email
     * @param int $id
     * @return array type
     */
    function view_mail($id) {
        return $this->db->select()
                        ->from('email')
                        ->where('email_id', $id)
                        ->get()
                        ->row();
    }

    /**
     * Delete email
     * @param int $id
     */
    function delete_email($id) {
        $this->db->where('email_id', $id);
        $this->db->delete('email');
    }

    /**
     * Get all exams
     * @return array
     */
    function get_all_exam() {
        return $this->db->select()
                        ->from('exam_manager')
                        ->get()
                        ->result();
    }

    /**
     * Get all exam types
     * @return array
     */
    function get_all_exam_type() {
        return $this->db->select()
                        ->from('exam_type')
                        ->where('status', 1)
                        ->get()
                        ->result();
    }

    /**
     * Get all course
     * @return array
     */
    function get_all_course() {

        return $this->db->select('course_id, c_name')
                        ->from('course')
                        ->get()
                        ->result();
    }

    /**
     * Get all semester
     * @return array
     */
    function get_all_semester() {
        return $this->db->select('s_id, s_name')
                        ->from('semester')
                        ->get()
                        ->result();
    }

    /**
     * Insert exam
     * @param array $data
     * @return int
     */
    function insert_exam($data) {
        $insert_id = $this->db->insert('exam_manager', $data);

        return $insert_id;
    }

    /**
     * Update exam detail
     * @param int $id
     * @param array $data
     * @return int
     */
    function update_exam($id, $data) {
        $this->db->where('em_id', $id);
        $insert_id = $this->db->update('exam_manager', $data);

        return $insert_id;
    }

    /**
     * All exam detail
     * @return array
     */
    function exam_details() {
        $this->db->select('department');

        $department = $this->db->select('department')
                        ->from('professor')
                        ->where([
                            'professor_id' => $this->session->userdata('login_user_id')
                        ])
                        ->get()->result();

        return $this->db->select('exam_manager.em_id, exam_manager.em_name, exam_manager.em_date, exam_type.exam_type_id, exam_type.exam_type_name,'
                                . ' course.course_id, course.c_name, semester.s_id, semester.s_name, '
                                . 'batch.b_id, batch.b_name, degree.d_id, degree.d_name')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->order_by('em_date', 'DESC')
                        ->where('degree.d_id', $department[0]->department)
                        ->get()
                        ->result();
    }

    function single_exam_detail($id) {
        return $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->where('exam_manager.em_id', $id)
                        ->get()
                        ->result();
    }

    /**
     * Update email read status
     * @param int $id
     * @param array $status
     * @return int
     */
    function update_email_read_status($id, $data) {
        $this->db->where('email_id', $id);
        $this->db->update('email', $data);
    }

    ///// Payment Gateway Configuration //////

    function authorize_net_config() {
        return $this->db->select()
                        ->from('authorize_net')
                        ->get()
                        ->result();
    }

    /**
     * Update authorize payment gateway info
     * @param int $id
     * @param array $data
     */
    function authorize_net_config_update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('authorize_net', $data);
    }

    /**
     * Authorized payment gateway insert
     * @param array $data
     * @return int
     */
    function authorize_net_config_insert($data) {
        $id = $this->db->insert('authorize_net', $data);
        return $id;
    }

    ///// Degree /////
    function get_all_degree() {
        $id = $this->session->userdata('login_user_id');
        $this->db->select('d.d_id, d_name');
        $this->db->join("degree as d", "p.department=d.d_id");
        return $this->db->get_where("professor as p", array("p.professor_id" => $id))->result();
    }

    //// Batch /////
    function get_all_bacth() {
        return $this->db->select()
                        ->from('batch')
                        ->get()
                        ->result();
    }

    //// Admission type /////
    function get_all_admission_type() {
        return $this->db->select()
                        ->from('admission_type')
                        ->get()
                        ->result();
    }

    ///// CMS Manager /////
    /**
     * CMS manager
     * @param array $data
     * @param int/NULL $id
     * @return int
     */
    function cms_manager_save($data, $id = NULL) {
        if ($id == NULL) {
            //insert
            $insert_id = $this->db->insert('cms_pages', $data);
        } else {
            //update
            $this->db->where('am_id', $id);
            $insert_id = $this->db->update('cms_pages', $data);
        }

        return $insert_id;
    }

    /**
     * Get all cms pages 
     * @return array
     */
    function get_all_cms_pages() {
        return $this->db->select()
                        ->from('cms_pages')
                        ->join('course', 'course.course_id = cms_pages.am_course')
                        ->join('semester', 'semester.s_id = cms_pages.am_semester')
                        ->join('batch', 'batch.b_id = cms_pages.am_batch')
                        ->join('degree', 'degree.d_id = cms_pages.degree_id')
                        ->get()
                        ->result();
    }

    //// Exam time table /////
    /**
     * Get time table list
     * @return array
     */
    function time_table() {
        return $this->db->select('degree.d_id, degree.d_name, course.course_id, course.c_name,'
                                . 'batch.b_id, batch.b_name, subject_manager.sm_id, subject_manager.subject_name,'
                                . 'semester.s_id, semester.s_name, exam_manager.em_name, exam_time_table.exam_date,'
                                . 'exam_time_table.exam_time_table_id, exam_time_table.exam_start_time, exam_time_table.exam_end_time')
                        ->from('exam_time_table')
                        ->join('exam_manager', 'exam_manager.em_id = exam_time_table.exam_id')
                        ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_time_table.batch_id')
                        ->join('degree', 'degree.d_id = exam_time_table.degree_id')
                        ->order_by('em_date', 'DESC')
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
     * All exam list
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function all_exam_list($course_id, $semester_id) {
        return $this->db->get_where('exam_manager', array(
                            'course_id' => $course_id,
                            'em_semester' => $semester_id,
                        ))
                        ->result();
    }

    /**
     * Get remedial exam list
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function get_remedial_exam_list($course_id, $semester_id) {
        $this->db->order_by('em_date', 'DESC');
        return $this->db->get_where('exam_manager', array(
                            'course_id' => $course_id,
                            'em_semester' => $semester_id,
                            'exam_ref_name' => 'remedial'
                        ))
                        ->result();
    }

    /**
     * Create or update time table
     * @param array $data
     * @param int $id
     * @return int
     */
    function exam_time_table_save($data, $id = NULL) {
        if ($id == NULL) {
            //create
            $insert_id = $this->db->insert('exam_time_table', $data);
        } else {
            //update
            $this->db->where('exam_time_table_id', $id);
            $insert_id = $this->db->update('exam_time_table', $data);
        }

        return $insert_id;
    }

    ///// Exam Manager //////
    function exam_detail($exam_id) {
        return $this->db->get_where('exam_manager', array(
                    'em_id' => $exam_id
                ))->result();
    }

    /**
     * Subject list by course and semester
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function subject_list($course_id, $semester_id) {
        return $this->db->get_where('subject_manager', array(
                    'sm_course_id' => $course_id,
                    'sm_sem_id' => $semester_id
                ))->result();
    }

    /**
     * Student exam mark
     * @param array $where
     * @return array
     */
    function student_exam_mark($where) {
        return $this->db->get_where('marks_manager', $where)->row();
    }

    /**
     * Insert marks of the exam 
     * @param array $data
     * @return int
     */
    function mark_insert($data) {
        $insert_id = $this->db->insert('marks_manager', $data);

        return $insert_id;
    }

    /**
     * Update marks of the exam
     * @param array $data
     * @param array $where
     * @return int
     */
    function mark_update($data, $where) {
        $this->db->where($where);
        $insert_id = $this->db->update('marks_manager', $data);

        return $insert_id;
    }

    ///// Fees Structure /////
    /**
     * Get all fees structure
     * @return array
     */
    function get_all_fees_structure() {
        $id = $this->session->userdata('department');
        return $this->db->select()
                        ->from('fees_structure')
                        ->join('course', 'course.course_id = fees_structure.course_id')
                        ->join('semester', 'semester.s_id = fees_structure.sem_id')
                        ->join('batch', 'batch.b_id = fees_structure.batch_id')
                        ->join('degree', 'degree.d_id = fees_structure.degree_id')
                        ->where('fees_structure.degree_id', $id)
                        ->get()
                        ->result();
    }

    /**
     * Insert or update fees structure
     * @param array $data
     * @param int $id
     * @return int
     */
    function fees_structure_save($data, $id = NULL) {
        if ($id == NULL) {
            //create
            $insert_id = $this->db->insert('fees_structure', $data);
        } else {
            //update
            $this->db->where('fees_structure_id', $id);
            $insert_id = $this->db->update('fees_structure', $data);
        }

        return $insert_id;
    }

    /**
     * Course and semester fees structure
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function course_semester_fees_structure($course_id, $semester_id) {
        return $this->db->select()
                        ->from('fees_structure')
                        ->where(array(
                            'course_id' => $course_id,
                            'sem_id' => $semester_id
                        ))
                        ->get()
                        ->result();
    }

    /**
     * Single fees structure details
     * @param int $id
     * @return object
     */
    function fees_structure_details($id) {
        return $this->db->select()
                        ->from('fees_structure')
                        ->where('fees_structure_id', $id)
                        ->get()
                        ->row();
    }

    /**
     * Exam subjects
     * @param int $exam_id
     * @return array
     */
    function exam_subjects($exam_id) {
        return $this->db->select('subject_manager.sm_id, subject_manager.subject_name')
                        ->from('subject_manager')
                        ->join('exam_time_table', 'exam_time_table.subject_id = subject_manager.sm_id')
                        ->where('exam_time_table.exam_id', $exam_id)
                        ->get()
                        ->result();
    }

    /**
     * All student fees details
     */
    function all_student_fees() {
        return $this->db->select()
                        ->from('student_fees')
                        ->join('fees_structure', 'fees_structure.fees_structure_id = student_fees.fees_structure_id')
                        ->join('student', 'student.std_id = student_fees.student_id')
                        ->join('course', 'course.course_id = student_fees.course_id')
                        ->join('semester', 'semester.s_id = student_fees.sem_id')
                        ->join('degree', 'degree.d_id = student.std_degree')
                        ->join('batch', 'batch.b_id = student.std_batch')
                        ->get()
                        ->result();
    }

    /**
     * Save the student fees data
     * @param array $data
     * @return int
     */
    function student_fees_save($data) {
        $this->db->insert('student_fees', $data);
        return $this->db->insert_id();
    }

    /**
     * Get all student by course and semester
     * @param int $course_id
     * @param int $semester_id
     * @return array
     */
    function course_semester_student($course_id, $semester_id) {
        return $this->db->select()
                        ->from('student')
                        ->where(array(
                            'course_id' => $course_id,
                            'semester_id' => $semester_id
                        ))
                        ->get()
                        ->result();
    }

    /**
     * Get all teachers
     * @return array
     */
    function get_all_teacher() {
        return $this->db->get('teacher')->result();
    }

    /**
     * Get all admin details
     */
    function get_all_admin() {
        return $this->db->get('admin')->result();
    }

    /**
     * Start or stop live streaming
     * @param string $stream_name
     * @param string $status
     */
    function start_stop_streaming($stream_name, $status) {
        if ($status == 'Start') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        $this->db->where('title', $stream_name);
        $this->db->update('broadcast_and_streaming', array(
            'is_active' => $is_active
        ));
    }

    /**
     * Get course details
     * @param int $course_id
     * @return object
     */
    function get_course_details($course_id) {
        return $this->db->get_where('course', array(
                    'course_id' => $course_id
                ))->row();
    }

    /**
     * Get semetser details
     * @param int $semester_id
     * @return object
     */
    function get_semetser_detail($semester_id) {
        return $this->db->get_where('semester', array(
                    's_id' => $semester_id
                ))->row();
    }

    /**
     * Course list by degree
     * @param int $degree_id
     * @return array
     */
    function course_list_from_degree($degree_id) {
        return $this->db->get_where('course', array(
                    'degree_id' => $degree_id
                ))->result();
    }

    /**
     * Batch list from degree and course
     * @param int $degree
     * @param int $course
     * @return array
     */
    function batch_list_from_degree_and_course($degree, $course) {
        $query = "SELECT * FROM batch ";
        $query .= "WHERE FIND_IN_SET($degree, degree_id) ";
        $query .= "AND FIND_IN_SET($course, course_id)";
        $result = $this->db->query($query);

        return $result->result();
    }

    /**
     * Exam list from degree, course, batch and course
     * @param int $degree
     * @param int $course
     * @param int $batch
     * @param int $semester
     * @return array
     */
    function exam_list_from_degree_and_course($degree, $course, $batch, $semester, $type) {
        return $this->db->get_where('exam_manager', array(
                    'degree_id' => $degree,
                    'course_id' => $course,
                    'batch_id' => $batch,
                    'em_semester' => $semester,
                    'exam_ref_name' => $type
                ))->result();
    }

    /**
     * Subject list from course and semester
     * @param int $course
     * @param int $semester
     * @return array
     */
    function subject_list_from_course_and_semester($course, $semester) {
        return $this->db->get_where('subject_manager', array(
                    'sm_course_id' => $course,
                    'sm_sem_id' => $semester
                ))->result();
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
     * Check for duplication of fees structure
     * @param int $degree
     * @param int $course
     * @param int $batch
     * @param int $sem
     * @param string $title
     * @return object
     */
    function fees_structure_duplication($degree, $course, $batch, $sem, $title) {
        return $this->db->get_where('fees_structure', array(
                    'degree_id' => $degree,
                    'course_id' => $course,
                    'batch_id' => $batch,
                    'sem_id' => $sem,
                    'title' => $title
                ))->row();
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

    /**
     * Time table duplication
     * @param int $exam
     * @param int $subject
     * @return object
     */
    function exam_time_table_duplication($exam, $subject) {
        return $this->db->get_where('exam_time_table', array(
                    'exam_id' => $exam,
                    'subject_id' => $subject
                ))->row();
    }

    /**
     * Check duplication for cms pages
     * @param int $degree
     * @param int $course
     * @param int $batch
     * @param int $sem
     * @param string $title
     * @return object
     */
    function cms_page_duplication($degree, $course, $batch, $sem, $title) {
        return $this->db->get_where('cms_pages', array(
                    'degree_id' => $degree,
                    'am_course' => $course,
                    'am_batch' => $batch,
                    'am_semester' => $sem,
                    'am_title' => $title
                ))->row();
    }

    /**
     * Get all grade
     * @return array
     */
    function grade() {
        return $this->db->get('grade')->result();
    }

    /**
     * Insert or update grade
     * @param int $id
     * @param array $data
     */
    function save_grade($data, $id = NULL) {
        if ($id == NULL) {
            //create
            $this->db->insert('grade', $data);
        } else {
            //update
            $this->db->where('grade_id', $id);
            $this->db->update('grade', $data);
        }
    }

    /**
     * Get semesters from branch
     * @param int $branch_id
     */
    function get_semesters_of_branch($branch_id) {
        $course = $this->get_course_details($branch_id);
        $sem_ids = explode(',', $course->semester_id);
        $semester = $this->db->select()
                ->from('semester')
                ->where_in('s_id', $sem_ids)
                ->get()
                ->result();

        return $semester;
    }

    /**
     * Get exam list by course, branch, batch, semester
     * @param string $course
     * @param string $branch
     * @param string $batch
     * @param string $semester
     * @return array
     */
    function get_exam_list_data($course, $branch, $batch, $semester, $type) {
        return $this->db->get_where('exam_manager', array(
                    'degree_id' => $course,
                    'course_id' => $branch,
                    'batch_id' => $batch,
                    'em_semester' => $semester,
                    'exam_ref_name' => $type
                ))->result();
    }

    /**
     * Exam types
     * @return array
     */
    function exam_types() {
        return $this->db->select()
                        ->from('exam_type')
                        ->get()
                        ->result();
    }

    /**
     * Save remedial exam 
     * @param array $data
     * @param string $id
     * @return int
     */
    function save_remedial_exam($data, $id = NULL) {
        $insert_id = 0;
        if ($id == NULL) {
            //insert
            $this->db->insert('exam_manager', $data);
            $insert_id = $this->db->insert_id();
        } else {
            //update
            $this->db->where('em_id', $id);
            $this->db->update('exam_manager', $data);
            $insert_id = $this->db->insert_id();
        }

        return $insert_id;
    }

    /**
     * Remedial exam lists
     * @return array
     */
    function remedial_exam_list() {
        return $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*, batch.*, degree.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->where('exam_manager.exam_ref_name', 'remedial')
                        ->get()
                        ->result();
    }

    /**
     * Remedial exam schedule
     * @return array
     */
    function remedial_exam_schedule() {
        return $this->db->select()
                        ->from('exam_time_table')
                        ->join('exam_manager', 'exam_manager.em_id = exam_time_table.exam_id')
                        ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_time_table.batch_id')
                        ->join('degree', 'degree.d_id = exam_time_table.degree_id')
                        ->where('exam_manager.exam_ref_name', 'remedial')
                        ->get()
                        ->result();
    }

    /**
     * Remedial exam student list
     * @param int $exam_id
     * @param int $passing Passing marks for an exam
     * @return array
     */
    function remedial_exam_student_list($exam_id, $passing_marks) {
        return $this->db->select()
                        ->from('marks_manager')
                        ->join('student', 'student.std_id = marks_manager.mm_std_id')
                        ->where(array(
                            'mm_exam_id' => $exam_id,
                            'mark_obtained < ' => $passing_marks
                        ))->group_by('marks_manager.mm_std_id')->get()->result();
    }

    /**
     * Failed student subject list
     * @param int $exam_id
     * @param int $student_id
     * @param int $passing_marks
     * @return array
     */
    function remedial_exam_student_subject($exam_id, $student_id, $passing_marks) {
        return $this->db->select()
                        ->from('marks_manager')
                        ->where(array(
                            'mm_std_id' => $student_id,
                            'mm_exam_id' => $exam_id,
                            'mark_obtained < ' => $passing_marks
                        ))->get()->result();
    }

    /**
     * Event manager
     * @return array
     */
    function event_manager() {
        return $this->db->select('event_name, event_location, event_desc, event_date')
                        ->from('event_manager')
                        ->order_by('event_date', 'DESC')
                        ->get()
                        ->result_array();
    }

    /**
     * Get all subscriber
     * @return array
     */
    function subscriber() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('subscriber')->result();
    }

    /**
     * Delete subscriber
     * @param string $id
     */
    function delete_subscriber($id) {
        $this->db->delete('subscriber', array(
            'id' => $id
        ));
    }

    /**
     * Save exam seat no 
     * @param mixed $data
     * @return int
     */
    function save_exam_seat_no($data) {
        $this->db->insert('exam_seat_no', $data);

        return $this->db->insert_id();
    }

    /**
     * Custom stduents details to generate seat no
     * @param mixed $where
     * @return object
     */
    function custom_student_details($where) {
        return $this->db->select('std_id, semester_id, std_degree, course_id')
                        ->from('student')
                        ->where($where)
                        ->get()
                        ->result();
    }

    /**
     * Student list from degree, course, batch, and semester
     * @param string $degree
     * @param string $course
     * @param string $batch
     * @param string $semester
     * @return mixed
     */
    function student_list_from_degree_course_batch_semester($degree, $course, $batch, $semester) {
        return $this->db->get_where('student', array(
                    'std_degree' => $degree,
                    'course_id' => $course,
                    'std_batch' => $batch,
                    'semester_id' => $semester
                ))->result();
    }

    /**
     * Insert or update graduates
     * @param mixed $data
     * @param string $id
     */
    function save_graduates($data, $id = NULL) {
        if ($id) {
            //update
            $this->db->update('graduates', $data, array(
                'graduates_id' => $id
            ));
        } else {
            //insert
            $this->db->insert('graduates', $data);
        }
    }

    /**
     * Get all graduates
     * @return mixed
     */
    function get_all_graduates() {
        return $this->db->select()
                        ->from('graduates')
                        ->join('student', 'student.std_id = graduates.student_id')
                        ->join('degree', 'degree.d_id = graduates.degree_id')
                        ->join('course', 'course.course_id = graduates.course_id')
                        ->join('semester', 'semester.s_id = graduates.semester_id')
                        ->order_by('graduates.created_at', 'DESC')
                        ->get()
                        ->result();
    }

    /**
     * Insert or update charity fund
     * @param mixed $data
     * @param string $id
     * @return int
     */
    function save_charity_fund($data, $id = NULL) {
        $insert_id = 0;
        if ($id) {
            //update
            $this->db->update('charity_fund', $data, array(
                'charity_fund_id' => $id
            ));
            $insert_id = $this->db->insert_id();
        } else {
            //insert            
            $this->db->insert('charity_fund', $data);
            $insert_id = $this->db->insert_id();
        }

        return $insert_id;
    }

    /**
     * Get graduates students
     * @param string $id
     */
    function get_graduate_student($id) {
        $this->db->get_where('graduates', array("graduates_id" => $id))->result();
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

    /**
     * Exam schedule filter
     * @param string $degree
     * @param string $course
     * @param string $batch
     * @param string $semester
     * @param string $exam
     * @return mixed
     */
    function exam_schedule_filter($degree, $course, $batch, $semester, $exam) {
        return $this->db->select()
                        ->from('exam_time_table')
                        ->join('exam_manager', 'exam_manager.em_id = exam_time_table.exam_id')
                        ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('batch', 'batch.b_id = exam_time_table.batch_id')
                        ->join('degree', 'degree.d_id = exam_time_table.degree_id')
                        ->where(array(
                            'exam_time_table.degree_id' => $degree,
                            'exam_time_table.course_id' => $course,
                            'exam_time_table.batch_id' => $batch,
                            'exam_time_table.semester_id' => $semester,
                            'exam_time_table.exam_id' => $exam
                        ))
                        ->order_by('em_date', 'DESC')
                        ->get()
                        ->result();
    }

    /**
     * Fee structure filter
     * @param string $degree
     * @param string $course
     * @param string $batch
     * @param string $semeter
     * @return mixed
     */
    function fee_structure_filter($degree, $course, $batch, $semeter) {
        return $this->db->select()
                        ->from('fees_structure')
                        ->join('course', 'course.course_id = fees_structure.course_id')
                        ->join('semester', 'semester.s_id = fees_structure.sem_id')
                        ->join('batch', 'batch.b_id = fees_structure.batch_id')
                        ->join('degree', 'degree.d_id = fees_structure.degree_id')
                        ->where(array(
                            'fees_structure.degree_id' => $degree,
                            'fees_structure.course_id' => $course,
                            'fees_structure.batch_id' => $batch,
                            'fees_structure.sem_id' => $semeter
                        ))->order_by('created_at', 'DESC')
                        ->get()
                        ->result();
    }

    /**
     * Professor list
     * @return mixed
     */
    function professor() {
        return $this->db->get('professor')->result();
    }

    /**
     * Insert or update professor information
     * @param mixed $data
     * @param int $id
     * @return int
     */
    function save_professor($data, $id = NULL) {
        $insert_id = 0;
        if ($id) {
            //update
            $this->db->where('professor_id', $id);
            $this->db->update('professor', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->insert('professor', $data);
            $insert_id = $this->db->insert_id();
        }

        return $insert_id;
    }

    /*
     * 
     * Created by mayur panchal
     * Message : -- for get assessments
     */

    public function assessment() {
        $dept = $this->session->userdata('department');
        $branch = $this->session->userdata('branch');
        $this->db->where("degree", $dept);
        $this->db->where("course", $branch);
        return $this->db->get('assessments')->result_array();
    }

    public function create_assessment($data) {
        $this->db->insert("assessments", $data);
    }

    public function update_assessment($data, $id) {
        $this->db->update("assessments", $data, array("assessment_id" => $id));
    }

    public function delete_assessment($id) {
        $this->db->delete("assessments", array("assessment_id" => $id));
    }

    /**
     * Professor class schedule
     * @return mixed
     */
    function professor_class_schedule() {
        return $this->db->get_where('class_routine', [
                    'ProfessorID' => $this->session->userdata('login_user_id')
                ])->result();
    }

    public function get_prof_student($dept, $branch) {
        return $this->db->select('std_id, std_first_name, std_last_name, email, std_mobile, std_gender, profile_photo')
                        ->from('student')
                        ->where([
                            'std_degree' => $dept,
                            'course_id' => $branch,
                            'std_degree !=' => 0,
                        ])
                        ->get()->result();

        //return $this->db->get_where("student", array('std_degree' => $dept, "course_id" => $branch))->result();
    }

    public function getstudentinfo($id) {
        return $this->db->get_where("student", array('std_id' => $id))->result();
    }

    public function getholiday() {
        $this->db->select('holiday_id, holiday_name, holiday_startdate, holiday_enddate, holiday_year');
        $this->db->order_by('holiday_startdate', 'DESC');
        return $this->db->get('holiday')->result_array();
    }

    public function addassignment($data) {
        $this->db->insert('assignment_manager', $data);
    }

    function add_courseware($data) {
        $this->db->insert('courseware', $data);
    }

    public function updateassignment($data, $param2) {
        $this->db->where('assign_id', $param2);
        $this->db->update('assignment_manager', $data);
    }

    public function deleteassignment($param2) {
        $this->db->where('assign_id', $param2);
        $this->db->delete('assignment_manager');
    }

    public function get_assignment() {
        $dept = $this->session->userdata("department");
        $branch = $this->session->userdata("branch");
        $this->db->where("assign_degree", $dept);
        // $this->db->where("course_id", $branch);
        $this->db->order_by("assign_id", "DESC");
        return $this->db->get('assignment_manager')->result();
    }

    public function submitttedassignment() {
        $dept = $this->session->userdata('department');
        $branch = $this->session->userdata('branch');
        $this->db->select("ass.*,am.*,s.std_id, s.name");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("s.std_degree", $dept);
        // $this->db->where("s.course_id", $branch);
        $this->db->order_by("ass.assignment_submit_id", "DESC");
        return $this->db->get();
    }

    /**
     * Find the class routine for attendance
     * @param mixed $where
     * @return mixed
     */
    function class_routine_attendance($where) {
        return $this->db->select()
                        ->from('class_routine')
                        ->join('subject_manager', 'subject_manager.sm_id = class_routine.SubjectID')
                        ->where(array(
                            'class_routine.DepartmentID' => $where['department_id'],
                            'DATE_FORMAT(class_routine.Start, "%Y-%m-%d") <= ' => date('Y-m-d', strtotime($where['class_date'])),
                            'class_routine.BranchID' => $where['branch_id'],
                            'class_routine.BatchID' => $where['batch_id'],
                            'class_routine.SemesterID' => $where['semester_id'],
                            'class_routine.ClassID' => $where['class_id'],
                            'class_routine.ProfessorID' => $where['professor_id']
                        ))->order_by('class_routine.ClassRoutineId', 'ASC')->get()->result();
    }

    function getcourseware() {
        $this->db->select('cw.courseware_id, cw.topic, cw.status, cw.chapter, cw.description, '
                . 'cw.attachment, c.course_id, c.c_name, sub.subject_name');
        $this->db->from('courseware cw');
        $this->db->join('course c', 'c.course_id=cw.branch_id');
        $this->db->join('subject_manager sub', 'sub.sm_id=cw.subject_id');
        return $this->db->get()->result_array();
    }

    public function get_studyresource() {
        $dept = $this->session->userdata("department");
        $this->db->select('study_id, study_title, study_degree, study_course, study_batch, study_sem, study_filename');
        $this->db->where("study_degree", $dept);
        $this->db->or_where('study_degree', "All");
        return $this->db->get('study_resources')->result();
    }

    public function get_libraries() {
        $dept = $this->session->userdata("department");
        $this->db->select('lm_id, lm_title, lm_degree, lm_course, lm_batch, lm_semester, lm_filename');
        $this->db->where("lm_degree", $dept);
        $this->db->or_where('lm_degree', "All");
        return $this->db->get('library_manager')->result();
    }

    public function get_projects() {
        $dept = $this->session->userdata("department");
        $this->db->select('pm_id,pm_title,pm_student_id,pm_degree,pm_course,pm_batch,pm_semester,class_id,pm_filename,pm_dos');
        $this->db->where("pm_degree", $dept);
        return $this->db->get('project_manager')->result();
    }

    public function submittedproject() {
        $dept = $this->session->userdata("department");
        $branch = $this->session->userdata("branch");
        $this->db->select("ps.*,pm.*,s.std_id, s.name, s.std_first_name, s.std_last_name");
        $this->db->from('project_document_submission ps');
        $this->db->join("project_manager pm", "pm.pm_id=ps.project_id");
        $this->db->join("student s", "s.std_id=ps.student_id");
        $this->db->where("s.std_degree", $dept);
        //$this->db->where("s.course_id", $branch);
        return $this->db->get();
    }

    function insert_todo($data) {
        $this->db->insert("todo_list", $data);
    }

    function get_todo() {
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime('-6 days', strtotime($date)));
        $login_type = $this->session->userdata("login_type");
        $login_id = $this->session->userdata("login_user_id");
        $this->db->select('todo_id, todo_title, todo_datetime, created_date, todo_status');
        $this->db->where("todo_role", $login_type);
        $this->db->where("todo_role_id", $login_id);
        $this->db->where('todo_datetime >= ', $date);
        $this->db->order_by("todo_datetime", "asc");
        return $this->db->get("todo_list")->result();
    }

    function change_status($data, $id) {
        $this->db->update("todo_list", $data, array("todo_id" => $id));
    }

    function removetodo($id) {
        $this->db->delete("todo_list", array("todo_id" => $id));
    }

    function gettododata($id) {
        return $this->db->get_where("todo_list", array("todo_id" => $id))->row();
    }

    function update_todo($data, $id) {
        $this->db->update("todo_list", $data, array("todo_id" => $id));
    }

    /**
     * 
     */
    function get_submitted_assessment() {
        $dept = $this->session->userdata('department');
        $branch = $this->session->userdata('branch');
        $this->db->select("ass.*,am.*,s.std_id, s.name, s.std_degree, s.std_batch, s.semester_id");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("s.std_degree", $dept);
        $this->db->where("s.course_id", $branch);
        $this->db->where("ass.assessment_status", '1');

        return $this->db->get();
    }

    /**
     * submitted assignment 
     * @param int $id
     */
    function get_submitted_assignment($id) {
        return $this->db->get_where("assignment_submission", array("assignment_submit_id" => $id))->result();
    }

    function update_submitted_assessment($data, $id) {
        $this->db->update("assignment_submission", $data, array("assignment_submit_id" => $id));
    }

    /**
     * Get all departments
     * @return mixed
     */
    function get_departments() {
        return $this->db->get_where('degree', [
                    'd_status' => 1
                ])->result();
    }

    /**
     * vocational course student list
     * return mixed data
     */
    function get_vocational_student($id) {
        return $this->db->select('vocational_course_fee.*, student.*, vocational_course.*,course_category.*')
                        ->from('vocational_course_fee')
                        ->where('vocational_course_fee.vocational_course_id', $id)
                        ->join('student', 'student.std_id = vocational_course_fee.student_id')
                        ->join('vocational_course', 'vocational_course.vocational_course_id = vocational_course_fee.vocational_course_id')
                        ->join('course_category', 'course_category.category_id = vocational_course.category_id')
                        ->get()
                        ->result();
    }

    /**
     * get subject data
     * @param int $id
     * @return mixed array
     */
    function getsubject($id) {
        return $this->db->get_where('subject_manager', array('sm_course_id' => $id))->result_array();
    }

    function get_recent_activity() {
        $this->db->select('activity,activity_datetime');
        $this->db->from("last_activity");
        $this->db->order_by("activity_id", "desc");
        $this->db->where("activity_user_role", $this->session->userdata('login_type'));
        $this->db->where("activity_user_role_id", $this->session->userdata('login_user_id'));
        $this->db->limit("10");
        return $this->db->get()->result();
    }

    function get_vocational_course($professor_id) {
        $this->db->where("professor_id", $professor_id);
        return $this->db->get('vocational_course')->result_array();
    }

    /**
     * Update password
     * @param array $data
     * @param int $id
     * @return int
     */
    function update_password($data, $id) {
        $this->db->where('professor_id', $id);
        $this->db->update('professor', $data);
        return $this->db->insert_id();
    }

    /**
     * Professor details
     * @param inde $id
     * @return object
     */
    function professor_details($id) {
        return $this->db->select()
                        ->from('professor')
                        ->where('professor_id', $id)
                        ->get()->row();
    }

    /**
     * Professor class routine department
     * @return mixed
     */
    function professor_class_department() {
        return $this->db->select()
                        ->from('degree')
                        ->join('class_routine', 'class_routine.DepartmentID = degree.d_id')
                        ->join('professor', 'professor.professor_id = class_routine.ProfessorID')
                        ->where([
                            'class_routine.ProfessorID' => $this->session->userdata('login_user_id')
                        ])
                        ->group_by('degree.d_id')
                        ->get()->result();
    }

    /**
     * 
     * @param mixed array $data
     * @param int $assign_id
     */
    function insert_update_assignment_reopen($data, $assign_id) {
        $res = $this->db->get_where('assignment_reopen', array("assign_id" => $assign_id))->num_rows();
        if ($res < 1) {
            $this->db->insert("assignment_reopen", $data);
        } else {
            $this->db->where("assign_id", $assign_id);
            $this->db->update("assignment_reopen", $data);
        }
    }

    /**
     * 
     * @param int $assign_id
     * @return type mixed array
     */
    function get_student_reopen($assign_id) {
        $this->db->select('student_id');
        return $this->db->get_where('assignment_reopen', array("assign_id" => $assign_id))->result();
    }

    /**
     * 
     * @param int $assign_id
     * @param int $student_id
     * @return type mixed array
     */
    function get_submitted_student($assign_id, $student_id) {
        $this->db->select('GROUP_CONCAT(student_id SEPARATOR ",") as student', FALSE);
        $this->db->where("assign_id", $assign_id);
        $this->db->where("student_id", $student_id);
        return $this->db->get("assignment_submission")->result();
    }

    /**
     * Find the class routine for attendance
     * @param string $where
     * @return mixed
     */
    function professor_class_routine_attendance($professor_id, $date) {
        return $this->db->select()
                        ->from('class_routine')
                        ->join('subject_manager', 'subject_manager.sm_id = class_routine.SubjectID')
                        ->join('degree', 'degree.d_id = class_routine.DepartmentID')
                        ->join('course', 'course.course_id = class_routine.BranchID')
                        ->join('semester', 'semester.s_id = class_routine.SemesterID')
                        ->join('class', 'class.class_id = class_routine.ClassID')
                        ->where(array(
                            //'class_routine.DepartmentID' => $where['department_id'],
                            'DATE_FORMAT(class_routine.Start, "%Y-%m-%d") <= ' => date('Y-m-d', strtotime($date)),
                            //'class_routine.BranchID' => $where['branch_id'],
                            // 'class_routine.BatchID' => $where['batch_id'],
                            //'class_routine.SemesterID' => $where['semester_id'],
                            //'class_routine.ClassID' => $where['class_id'],
                            'class_routine.ProfessorID' => $professor_id
                        ))->order_by('class_routine.ClassRoutineId', 'ASC')->get()->result();
    }

    function class_routine_details($class_routine_id) {
        return $this->db->select()
                        ->from('class_routine')
                        ->join('subject_manager', 'subject_manager.sm_id = class_routine.SubjectID')
                        ->join('degree', 'degree.d_id = class_routine.DepartmentID')
                        ->join('course', 'course.course_id = class_routine.BranchID')
                        ->join('semester', 'semester.s_id = class_routine.SemesterID')
                        ->join('class', 'class.class_id = class_routine.ClassID')
                        //->join('batch', 'batch.batch_id = class_routine.BatchID')
                        ->where([
                            'class_routine.ClassRoutineID' => $class_routine_id
                        ])->get()->row();
    }
    
    /**
     * Class routine status
     * @param string $class_routine_id
     * @param string $date
     * @return int
     */
    function class_routine_status($class_routine_id, $date) {
        return $this->db->select()
                ->from('attendance')
                ->where([
                    'class_routine_id'  => $class_routine_id,
                    'date_taken'    => $date
                ])->get()->num_rows();
    }

}
