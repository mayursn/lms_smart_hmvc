<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends MY_Controller {

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
        $this->load->model('professor/Professor_model');
        $this->load->model('todo/Todo_list_model');
        $this->load->model('professor/Last_activity_model');
        
        
    }

    /**
     * Index action
     */
    function index() {
        $this->data['title'] = 'Staff';
        $this->data['page'] = 'professor';
        $this->data['professor'] = $this->Professor_model->get_all();
        $this->__template('professor/index', $this->data);
    }
    
    function dashboard()
    {
         $this->data['page'] = 'dashboard';
        $this->data['title'] = 'Dashboard';
        $this->data['todolist'] = $this->Todo_list_model->get_todo();
        $this->data['recent_activity'] = $this->Last_activity_model->get_recent_activity();
        $this->__template('professor/dashboard', $this->data);
    }

    /**
     * Create professor
     */
    function create() {
        if ($_POST) {
            $this->Professor_model->insert(array(
                'name' => $this->input->post('professor_name'),
                'email' => $this->input->post('email'),
                'password' => hash('md5', $this->input->post('password')),
                'real_pass' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'zip' => $this->input->post('zip_code'),
                'mobile' => $this->input->post('mobile'),
                'dob' => $this->input->post('dob'),
                'occupation' => $this->input->post('occupation'),
                'designation' => $this->input->post('designation'),
                'department' => $this->input->post('degree'),
                'branch' => $this->input->post('branch'),
                'about' => $this->input->post('about'),
                'subjects' => implode(',', $_POST['subjects'])
            ));
        }

        redirect(base_url('professor'));
    }

    function create_professor_user($professor, $files) {
        $this->load->model('user/User_model');
        $this->load->model('user/Role_model');
        $role = $this->Role_model->get_by(array(
            'role_name' => 'Professor'
        ));

        $user_id = $this->User_model->insert(array(
            'first_name' => $professor['professor_name'],
            'last_name' => '',
            'email' => $student['email'],
            'password' => Modules::run('user/__hash', $student['password']),
            'gender' => ucfirst($student['gen']),
            'zip_code' => $student['zip_code'],
            'role_id' => $role->role_id,
            'is_active' => 1,
            //'profile_pic' => $this->upload_student_profile_pic($files)
        ));
    }

    function delete($id) {
        
    }

    function update($id) {
        if($_POST) {
            echo '<pre>';
            var_dump($_POST);
            exit;
        }
    }
    
     /**
     * Professor class routine
     */
    
    function professor_by_department_and_branch($department,$branch)
    {
       $professor =  $this->Professor_model->get_many_by(array(
                    'department' => $department,
                    'branch' => $branch
                ));
        
        echo json_encode($professor);
    }
    
    function professor_class_routine() {
        $this->load->view('professor/professor_class_routine');
    }
    
     /**
     * Class routine data
     */
    function class_routine_data() {
        $class_routine = $this->Professor_model->professor_class_schedule();
        //$class_routine = $this->db->get('class_routine')->result();
        echo json_encode($class_routine);
    }
     /**
     * Check class routine
     */
    function check_class_routine() {
        date_default_timezone_set('Etc/UTC');
        if ($_POST) {
            require 'vendor/autoload.php';
            $this->load->library('Class_routine_attendance');
            $this->load->model('Crud_model');
            if ($_POST) {
                $class_routine = $this->Professor_model->class_routine_attendance($_POST);
                $attendance_routine = array();
                $selected_date = date('Y-m-d', strtotime($_POST['class_date']));
                foreach ($class_routine as $row) {
                    if ($row->RecurrenceRule) {
                        //parse reccurrence rule
                        $rule = $this->class_routine_attendance->parse_reccurrence_rule($row->RecurrenceRule);
                        $rule_array = array();
                        $reccur_rule = '';
                        foreach ($rule as $key => $value) {
                            $separate_rule = explode('=>', $value);
                            $reccur_rule .= "'$separate_rule[0]' => '$separate_rule[1]'" . ';';
                        }
                        $conditional_rules = $this->class_routine_attendance->conditional_reccurrence_rule($reccur_rule);
                        $conditional_rules['DTSTART'] = $row->Start;
                        $rrule = new RRule\RRule($conditional_rules);
                        foreach ($rrule as $occurrence) {
                            if ($occurrence->format('Y-m-d') == $selected_date) {
                                array_push($attendance_routine, $row);
                                //echo $occurrence->format('Y-m-d');
                                break;
                            }
                            //break;
                        }
                    } else {
                        //single schedule event
                        array_push($attendance_routine, $row);
                    }
                }
            }
            echo '<option value="">Select</option>';
            foreach ($attendance_routine as $row) {
                ?>
                <option value="<?php echo $row->ClassRoutineId; ?>"><?php echo $row->subject_name . '--' . date('h:i A', strtotime($row->Start)) . '-' . date('h:i A', strtotime($row->End)); ?></option>
                <?php
            }
        }
    }

}
