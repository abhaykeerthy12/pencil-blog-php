<?php
class User_model extends CI_Model
{

    public function __construct()
    {

        // connect the database
        $this->load->database();
    }

    // create a user with passed datas
    public function register($hashed_password, $user_image)
    {

        // user data array
        $data = array(
            'pencil_db_users_username' => '@' . $this->input->post('signup_username'),
            'pencil_db_users_bio' => $this->input->post('signup_bio'),
            'pencil_db_users_email' => $this->input->post('signup_email'),
            'pencil_db_users_password' => $hashed_password,
            'pencil_db_users_image' => $user_image,
        );

        // insert the data
        return $this->db->insert('pencil_db_users', $data);
    }

    // Log user in
    public function login($login_data)
    {
        // get the user with passed email
        $this->db->select('*');
        $this->db->from('pencil_db_users');
        $this->db->where('pencil_db_users_email', $login_data['l_email']);
        $query = $this->db->get();

        // if a user exists with that email, check his password in database with the passed password entered by user
        if ($query->num_rows() == 1) {

            $row = $query->row_array();
            if (password_verify($login_data['l_password'], $row['pencil_db_users_password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // update the details of the user, similar to the register function
    public function update_user($user_image)
    {
        if (!$user_image) {
            $user_image = $this->input->post('userfile1');
        }

        // user data array
        $data = array(
            
            'pencil_db_users_bio' => $this->input->post('user_bio'),
            'pencil_db_users_email' => $this->input->post('user_email'),
            'pencil_db_users_image' => $user_image,
        );

        $this->db->where('pencil_db_users_id', $this->input->post('user_id'));
        return $this->db->update('pencil_db_users', $data);
    }

    // change thw password of the user
    public function change_password($password)
    {

        // password array
        $data = array(
            'pencil_db_users_password' => $password,
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

    public function author_posts($id){
         $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');
         $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
         $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_user_id' => $id));
         return $query->result_array();
    }

    // get all users in database
    public function get_all_users()
    {
        $query = $this->db->get('pencil_db_users');
        return $query->result_array();
    }

    // check whether the username is already taken
    public function check_username_exists($username)
    {
        $uname = '@'.$username;
        $query = $this->db->get_where('pencil_db_users', array('pencil_db_users_username' => $uname));
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

    // check the old password entered by user is valid or not, similar to login function
    public function check_old_pwd($old_password)
    {

        $this->db->select('*');
        $this->db->from('pencil_db_users');
        $this->db->where('pencil_db_users_email', $this->session->userdata('user_email'));
        $query = $this->db->get();

        if ($query->num_rows() == 1) {

            $row = $query->row_array();
            if (password_verify($old_password, $row['pencil_db_users_password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function get_views($id){

        if($id){
          $this->db->select_sum('pencil_db_posts_views');
            $this->db->where('pencil_db_posts_user_id', $id);
            $query = $this->db->get('pencil_db_posts');
            return $query;

        }

    }   
}
