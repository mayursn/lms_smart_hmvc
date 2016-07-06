<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
        $this->load->model('user/User_model');
        $this->load->model('todo/Todo_list_model');
        $this->load->model('professor/Professor_model');
    }

    /**
     * Index
     */
    function index() {
        if ($this->is_user_logged_in()) {
            redirect('user/dashboard');
        }
        $this->dashboard();
    }

    /**
     * Login
     */
    function login() {
        if ($this->is_user_logged_in()) {
            redirect('user/dashboard');
        }

        if ($_POST) {
            $email = trim($this->input->post('email'));
            $password = $this->__hash(trim($this->input->post('password')));
            $this->process_login($email, $password);
        }
        $this->data['title'] = 'User Login';
        $this->load->view('user/user/login', $this->data);
    }

    /**
     * Process login
     * @param string $email
     * @param string $passowrd
     */
    function process_login($email = '', $passowrd = '') {
        if ($email && $passowrd) {
            $user = $this->User_model->with('role')
                    ->get_by(array(
                'email' => $email,
                'password' => $passowrd,
                'is_active' => 1
                    )
            );

            if ($user) {
                if ($user->role->role_id == "3") {
                    $this->load->model('student/Student_model');
                    $user_id = $user->user_id;
                    $this->db->where("user_id", $user_id);
                    $std = $this->db->get("student")->row()->std_id;
                    
                    $this->session->set_userdata("std_id", $std);
                   
                }

                if ($user->role->role_id == "2") {
                    $this->load->model('professor/Professor_model');
                    $user_id = $user->user_id;
                    $this->db->where("user_id", $user_id);
                    $professor = $this->db->get("professor")->row();
                    $this->session->set_userdata("professor_id", $professor->professor_id);
                    $this->session->set_userdata("professor_department", $professor->department);
                }
                $session_data = array(
                    'user_id' => $user->user_id,
                    'email' => $user->email,
                    'is_logged_in' => TRUE,
                    'role_id' => $user->role->role_id,
                    'role_name' => $user->role->role_name
                );
                $this->session->set_userdata($session_data);

                redirect(base_url('user/dashboard'));
            } else {
                $this->session->set_flashdata('message', 'Invalid username or password');
                $this->session->set_flashdata('type', 'danger');
                redirect(base_url('user/login'));
            }
        } else {
            redirect(base_url('user/login'));
        }
    }

    /**
     * Generate hash of the data
     * @param string $str
     * @return string
     */
    function __hash($str) {
        return hash('md5', $str . config_item('encryption_key'));
    }

    /**
     * Dashboard
     */
    function dashboard() {
        $this->redirect_if_user_not_logged_in();
        $this->data['title'] = 'Dashboard';
        $this->data['page'] = 'dashboard';
        $this->data['todolist'] = $this->Todo_list_model->get_todo();

        if ($this->session->userdata('std_id')) {
            $this->data['timeline'] = $this->Crud_model->get_timline();
            redirect(base_url() . 'student/dashboard');
        } elseif ($this->session->userdata('professor_id')) {
            redirect(base_url() . 'professor/dashboard');
        } else {

            $this->load->helper('report_chart');

            $this->data['new_student_joining'] = new_student_registration();
            $this->data['male_vs_female_course_wise'] = male_vs_female_course_wise();
            $this->calendar_json();
            $this->data['todolist'] = $this->Todo_list_model->get_todo();
            $this->data['recent_professor'] = $this->Professor_model->get_recent_professor();
            $this->data['title'] = 'Dashboard';
            $this->data['page'] = 'dashboard';
            $this->__template('user/user/dashboard', $this->data);
        }
    }

    /**
     * Logout from the system
     */
    function logout() {
        $this->session->sess_destroy();

        redirect(base_url('user/login'));
    }

    function change_password() {
        
    }

    function forgot_password() {
        
    }

    /**
     * User list
     */
    function user_list() {
        $this->data['title'] = 'Users List';
        $this->data['page'] = 'user';
        $this->data['users'] = $this->User_model->get_users();
        $this->__template('user/user/user_list', $this->data);
    }

    /**
     * Create user
     */
    function create() {
        if ($_POST) {
            $this->User_model->insert(array(
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $this->__hash($_POST['password']),
                'gender' => $_POST['gender'],
                'mobile' => $_POST['mobile'],
                'phone' => $_POST['phone'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code'],
                'address' => $_POST['address'],
                'role_id' => $_POST['role'],
                'is_active' => 1
            ));
            $this->flash_notification('New user is successfully created.');
        }

        redirect(base_url('user/user_list'));
    }

    function delete() {
        
    }

    function update() {
        
    }

    /**
     * Calendate json
     */
    function calendar_json() {
        $this->load->helper('file');
        $this->db->select('event_date AS date, event_name AS title, event_location AS Location, event_desc AS description');
        $this->db->select('DATE_FORMAT(event_date, "%d %b %Y") AS event_start_date, TIME_FORMAT(event_date, "%h:%i %p") AS event_start_time');
        $this->db->from('event_manager');
        $query = $this->db->get();
        $file = FCPATH . 'event.humanDate.json.php';
        $result = json_encode($query->result());

        write_file($file, $result);
    }

}
