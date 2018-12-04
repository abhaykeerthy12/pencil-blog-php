<?php
class Users extends CI_Controller
{
    // profile
    public function profile(){

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        
        $data['title'] = "Profile";

        $id = $this->session->userdata('user_id');

        $data['posts'] = $this->Post_model->get_posts_by_user($id);

        $this->load->view('templates/header');
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }

    // signup
    public function register()
    {
        $data['title'] = "Sign up!";

        // some normal form validation rules
        $this->form_validation->set_rules('signup_name', 'Name', 'required');
        $this->form_validation->set_rules('signup_username', 'Userame', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('signup_email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('signup_password', 'Password', 'required');
        $this->form_validation->set_rules('signup_confirm_password', 'Confirm password', 'matches[signup_password]');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');

        } else {

            // upload image (don't touch anything, its working fine with the current config :-P )
            $config['upload_path']   = './assets/images/profile';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '0';
            $config['max_width']     = '0'; 
            $config['max_height']    = '0';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $errors     = array('error' => $this->upload->display_errors());
                $user_image = 'no_image.png';
            } else {
                $data       = array('upload_data' => $this->upload->data());
                $user_image = $_FILES['userfile']['name'];
            }

            // encrypt password 
            $hashed_password = password_hash($this->input->post('signup_password'), PASSWORD_DEFAULT);

            // pass the encrypted version of the password, other datas are easily available on the other side...
            $this->User_model->register($hashed_password, $user_image);

            // set message
            $this->session->set_flashdata('user_registered', 'You are now registered, you can log in');
            redirect('users/login');

        }
    }

    // login
    public function login()
    {
        $data['title'] = "Login!";

        // form->> rules
        $this->form_validation->set_rules('login_email', 'Email', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');

        } else {
            
            $login_data = array(
                'l_email'    => $this->input->post('login_email'),
                'l_password' => $this->input->post('login_password')
            );
            $result = $this->User_model->login($login_data);

            if ($result == true) {

                $l_email = $this->input->post('login_email');
                $result  = $this->User_model->get_user_datas($l_email);
                if ($result != false) {
                    $user_data = array(
                        'user_id'    => $result[0]->pencil_db_users_id,
                        'user_image' => $result[0]->pencil_db_users_image,
                        'user_name'  => $result[0]->pencil_db_users_name,
                        'user_username'  => $result[0]->pencil_db_users_username,
                        'user_email' => $result[0]->pencil_db_users_email,
                        'user_password' => $result[0]->pencil_db_users_password,
                        'is_admin'   => $result[0]->pencil_db_users_is_admin,
                        'logged_in'  => true,

                    );

                    // created 'userdata' session
                    $this->session->set_userdata($user_data);
                    // set message
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                    redirect('posts');

                }
            } else {
                    // set message
                    $this->session->set_flashdata('login_failed', 'Login is Invalid');
                    redirect('users/login');

                }
        }
    }

     // profile
     public function edit(){

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        
        $data['title'] = "Edit";

        $this->load->view('templates/header');
        $this->load->view('users/edit', $data);
        $this->load->view('templates/footer');
    }


    public function update()
    {

        // the actual edit function, this calls the update post function in the model

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // upload image (don't touch anything, its working fine with the current config :-P )
        $config['upload_path']   = './assets/images/profile';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['max_width']     = '0';
        $config['max_height']    = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $errors     = array('error' => $this->upload->display_errors());
        } else {
            $data       = array('upload_data' => $this->upload->data());
            $user_image = $_FILES['userfile']['name'];
        }


        $this->User_model->update_user($user_image);
        $this->session->set_flashdata('user_updated', 'Your data has been updated');
        redirect('users/logout');
    }

    // admin
    public function admin()
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        if ($this->session->userdata('is_admin') == 'yes') {

            $data['title'] = 'Administration';

            $data['users'] = $this->User_model->get_all_users();

            $this->load->view('templates/header');
            $this->load->view('users/admin', $data);
            $this->load->view('templates/footer');
        }

    }

    // change password
    public function change_password(){

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('new_password', 'Password', 'required');
        $this->form_validation->set_rules('new_password_confirm', 'Confirm password', 'matches[new_password]');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/change_password', $data);
            $this->load->view('templates/footer');

        } else {


            $password = md5($this->input->post('new_password'));
        

            $result = $this->User_model->change_password($password);


            $this->load->view('templates/header');
            $this->load->view('users/change_password', $data);
            $this->load->view('templates/footer');
            redirect('users/logout');
        }
    }

    // logout
    public function logout()
    {

        // unset user data
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_password');
        $this->session->unset_userdata('user_image');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_username');
        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();

        // set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('users/login');
    }

    public function delete($u_id)
    {
        // delete the post with matching id
        $this->db->where('pencil_db_users_id', $u_id);
        $this->db->delete('pencil_db_users');
        $this->db->where('pencil_db_posts_user_id', $u_id);
        $this->db->delete('pencil_db_posts');
        $this->session->set_flashdata('user_deleted', 'the user is deleted');
        redirect('users/admin');
    }

    // check if username already exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken, try another');
        if ($this->User_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // check if email already exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken, try another');
        if ($this->User_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
}
