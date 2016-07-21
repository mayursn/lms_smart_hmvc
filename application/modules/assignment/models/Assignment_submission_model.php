<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_submission_model extends MY_Model {
    
    protected $primary_key = 'assignment_submit_id';
    
    public $before_create = array('timestamps');
    public $before_get = array('department_filter');
    
   
    
    /**
     * Set timestamp field
     * @param array $degree
     * @return array
     */
    protected function timestamps($assignment) {
        $assignment['submited_date'] = date('Y-m-d H:i:s');        
        return $assignment;
    }
    
  
    
    public function get_submitted_assignment($course, $batch, $degree, $semester)
    {
         $this->db->select("ass.*,am.*,s.*,s.class_id");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("am.course_id", $course);
        $this->db->where("am.assign_batch", $batch);
        $this->db->where("am.assign_degree", $degree);
        $this->db->where("am.assign_sem", $semester);
        //$this->db->where("am.class_id", $class);
        return $this->db->get()->result();
    }
     public function get_submitted_subject_assignment($course, $subject, $degree, $semester, $start_year,$end_year)
    {
         $this->db->select("ass.*,am.*,s.*,s.class_id");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("am.course_id", $course);
        $this->db->where("am.sm_id", $subject);
        $this->db->where("am.assign_degree", $degree);
        $this->db->where("am.assign_sem", $semester);
        $this->db->where("am.end_year", $end_year);
        $this->db->where("am.start_year", $start_year);
        //$this->db->where("am.class_id", $class);
        return $this->db->get()->result();
    }
    function get_late_submitted_assignment()
    {
        $this->db->select("a.*,ass.*,d.d_name,c.c_name,s.s_name,cl.class_name,st.name,st.std_first_name,st.std_last_name,date_format(ass.submited_date, ('%Y-%m-%d')) as submitted_date, date_format(a.assign_dos, ('%Y-%m-%d')) as assign_submission_date,sm.sm_id,sm.subject_name");
        $this->db->join('assignment_manager a','a.assign_id=ass.assign_id');
        $this->db->join('degree d','d.d_id=a.assign_degree');
        $this->db->join('course c','c.course_id=a.course_id');      
        $this->db->join('subject_manager sm','sm.sm_id=a.sm_id');
        $this->db->join('semester s','s.s_id=a.assign_sem');
        $this->db->join('class cl','cl.class_id=a.class_id');
        $this->db->join('student st','st.std_id=ass.student_id');
          if($this->session->userdata('professor_id'))
        {
            $dept = $this->session->userdata('professor_department');
            $this->db->where("a.assign_degree",$dept);
        }
        $where = "a.assign_dos < ass.submited_date";
        $this->db->where($where);
        return $this->db->get('assignment_submission as ass')->result();
        
        //return $this->db->query("SELECT * FROM assignment_submission LEFT JOIN assignment_manager ON assignment_manager.assign_id=assignment_submission.assign_id WHERE assignment_submission.submited_date > assignment_manager.assign_dos")->result();    }
    }
    
     /**
     * 
     * @param int $course
     * @param int $batch
     * @param int $degree
     * @param int $semester
     * @param int $class
     * @param int $assign_id
     * @return mixed 
     */
    function not_submitted_assignment($course, $batch, $degree, $semester ,$class,$assign_id)
    {
        $res  = $this->db->get_where("assignment_manager",array("assign_id"=>$assign_id))->row();
         $degree = $res->assign_degree;
         $course_id = $res->course_id;
         $assign_batch = $res->assign_batch;
         $assign_sem = $res->assign_sem;
         $class_id = $res->class_id;
         $assign_dos = $res->assign_dos;
         // AND submited_date > '".$res->assign_dos."'
         return $this->db->query("SELECT * FROM student WHERE std_degree='".$res->assign_degree."' AND course_id='".$res->course_id."' AND std_batch='".$res->assign_batch."' AND semester_id='".$res->assign_sem."' AND class_id='".$res->class_id."' AND std_id NOT IN (SELECT student_id FROM assignment_submission WHERE assign_id='".$assign_id."' ) ")->result();
    }
    
      function not_submitted_subject_assignment($course, $subject, $degree, $semester ,$class,$assign_id)
    {
        $res  = $this->db->get_where("assignment_manager",array("assign_id"=>$assign_id))->row();
         $degree = $res->assign_degree;
         $course_id = $res->course_id;
         $sm_id = $res->sm_id;
         $assign_sem = $res->assign_sem;
         $class_id = $res->class_id;
         $assign_dos = $res->assign_dos;
         // AND submited_date > '".$res->assign_dos."'
         return $this->db->query("SELECT * FROM student WHERE std_degree='".$res->assign_degree."' AND course_id='".$res->course_id."' AND semester_id='".$res->assign_sem."' AND class_id='".$res->class_id."' AND std_id NOT IN (SELECT student_id FROM assignment_submission WHERE assign_id='".$assign_id."' ) ")->result();
    }
    
    
     /**
     * 
     * @param int $assign_id
     * @return type mixed array
     */
    function get_student_reopen($assign_id)
    {
        $this->db->select('student_id');
        return $this->db->get_where('assignment_reopen',array("assign_id"=>$assign_id))->result();
    }
    
    /**
     * 
     * @param mixed array $data
     * @param int $assign_id
     */
    function insert_update_assignment_reopen($data,$assign_id)
    {
        $res = $this->db->get_where('assignment_reopen',array("assign_id"=>$assign_id))->num_rows();
        if($res < 1)
        {
        $this->db->insert("assignment_reopen",$data);
        }
        else{
            $this->db->where("assign_id",$assign_id);
            $this->db->update("assignment_reopen",$data);
        }
    }
    
    function get_assessments($start_year,$end_year)
    {
        $this->db->select("ass.*,am.*,s.*,sm.*,u.profile_pic");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->join("user u", "u.user_id=s.user_id");
        $this->db->join("subject_manager sm", "sm.sm_id=am.sm_id");
        $this->db->where("ass.assessment_status", '1');
        $this->db->where('am.start_year',$start_year);
        $this->db->where('am.end_year',$end_year);        
        return $this->db->get();
    }
    
    /**
     * get all submitted assignment
     * @return mixed array
     */
    function get_submitted_assignments() {
        $this->db->select("ass.submited_date,ass.comment,ass.document_file,ass.assignment_submit_id,am.assign_id,am.assign_title,am.assign_degree,am.course_id,am.assign_batch,am.assign_sem,s.name,s.std_first_name,s.std_last_name,am.sm_id");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        if($this->session->userdata('professor_id'))
        {
            $dept = $this->session->userdata('professor_department');
            $this->db->where("am.assign_degree",$dept);
        }
        return $this->db->get();
    }
    
    function get_assessment_assignment()
    {
        $this->db->select("ass.*,am.*,s.* ");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        if($this->session->userdata('professor_id'))
        {
            $dept = $this->session->userdata('professor_department');
            $this->db->where("am.assign_degree",$dept);
        }
        return $this->db->get();
    }
    
     function filter_assessment($course, $subject, $degree, $semester,$start_year,$end_year) {
        $this->db->select("ass.*,am.*,s.*,s.class_id");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->join("subject_manager sm", "sm.sm_id=am.sm_id");
        $this->db->where("am.course_id", $course);
        $this->db->where("am.sm_id", $subject);
        $this->db->where("am.assign_degree", $degree);
        $this->db->where("am.assign_sem", $semester);
        $this->db->where("am.start_year",$start_year);
        $this->db->where("am.end_year",$end_year);        
        //$this->db->where("am.class_id", $class);
        return $this->db->get()->result();
    }
    
     /**
     * Student assessment
     * @param int $student_id
     * @return object
     */
    function student_assessment() {
        $student_id = $this->session->userdata('std_id');
        //return $this->db->get_where("assessments", array("student" => $student_id))->result();
        $this->db->select("ass.*,am.*,s.* ");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("ass.student_id",$student_id);
        $this->db->where("ass.assessment_status",'1');
        return $this->db->get();   
    }
    
     /**
     * 
     * @param type $assign_id
     * @param type $student_id
     * @return type int
     */
    function getchecksubmitted($assign_id,$student_id)
    {
        $this->db->where("assign_id",$assign_id);
        $this->db->where("student_id",$student_id);
        return $this->db->get("assignment_submission")->num_rows();
        
        
    }

     /**
      * reopen student list
      * @param int $assign_id
      * @param int $student_id
      * @return mixed
      */
    function get_student_reopen_assignment($assign_id,$student_id)
    {
        $this->db->where("FIND_IN_SET('$student_id',student_id) !=", 0);
        $this->db->where("assign_id",$assign_id);
        return $this->db->get('assignment_reopen')->num_rows();
    }
    
    function student_submitted_assignment_list()
    {
        $this->db->select('s.*,a.*');
        $this->db->from('assignment_submission s');
        $this->db->join('assignment_manager a', 'a.assign_id=s.assign_id');
        $this->db->where('s.student_id', $this->session->userdata('std_id'));
        return $this->db->get();
    }
    
    /**
     * late submitted assignment
     * @return mixed
     */
    function get_not_submitted_assignment()
    {        
        $this->db->select();            
        $this->db->from('student st');
        $this->db->join('assignment_submission ass','ass.assign_id=a.assign_id');        
        $date=  date('Y-m-d');        
        $this->db->where("a.assign_dos < ",$date);
        $this->db->join('degree d','d.d_id=a.assign_degree');
        $this->db->join('course c','c.course_id=a.course_id');
        $this->db->join('batch b','b.b_id=a.assign_batch');
        $this->db->join('semester s','s.s_id=a.assign_sem');
        $this->db->join('class cl','cl.class_id=a.class_id');
        $this->db->where_not_in('st.std_id','ass.student_id');
        $this->db->where('st.std_degree','a.assign_degree');
        $this->db->where('st.course_id','a.course_id');
        $this->db->where('st.std_batch','a.assign_batch');
        $this->db->where('st.semester_id','a.assign_sem');
        $this->db->where('st.class_id','a.class_id');
        return $this->db->get('assignment_manager a')->result();
    }
    
}