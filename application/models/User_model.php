<?php
class User_model extends CI_Model
{

    public function __construct()
    {

        // connect the database
        $this->load->database();
    }

    public function register($hashed_password, $user_image)
    {

        // user data array
        $data = array(
            'pencil_db_users_name'     => $this->input->post('signup_name'),
            'pencil_db_users_username' => '@'.$this->input->post('signup_username'),
            'pencil_db_users_email'    => $this->input->post('signup_email'),
            'pencil_db_users_password' => $hashed_password,
            'pencil_db_users_image'    => $user_image
        );

        // insert the data
        return $this->db->insert('pencil_db_users', $data);
    }

    // Log user in
    public function login($login_data)
    {
        $this->db->select('*');
        $this->db->from('pencil_db_users');
        $this->db->where('pencil_db_users_email', $login_data['l_email']);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            
            $row = $query->row_array();
            if(password_verify($login_data['l_password'], $row['pencil_db_users_password'])){
                return true;
            }        
            else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function update_user($user_image)
    {
        if(!$user_image){
            $user_image = $this->input->post('userfile1');
        }

        // user data array
        $data = array(
            'pencil_db_users_name'     => $this->input->post('user_name'),
            'pencil_db_users_username' => '@'.$this->input->post('user_username'),
            'pencil_db_users_email'    => $this->input->post('user_email'),
            'pencil_db_users_image'    => $user_image
        );

        
        $this->db->where('pencil_db_users_id', $this->input->post('user_id'));
        return $this->db->update('pencil_db_users', $data);
    }
 

    public function change_password($password){

        // password array
        $data = array(
            'pencil_db_users_password'     => $password
        );

        $this->db->where('pencil_db_users_id', $this->session->userdata('user_id'));
        return $this->db->update('pencil_db_users', $data);
    }

    // Read whole user data
    public function get_user_datas($l_email)
    {

        $condition = "pencil_db_users_email =" . "'" . $l_email . "'";
        $this->db->select('*');
        $this->db->from('pencil_db_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_users()
    {
        $query = $this->db->get('pencil_db_users');
        return $query->result_array();
    }

    // check whether the username is already taken
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('pencil_db_users', array('pencil_db_users_username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // check whether the email is already taken
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('pencil_db_users', array('pencil_db_users_email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}
