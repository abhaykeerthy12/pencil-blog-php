<?php
class Users extends CI_Controller
{
    // profile of a user
    public function profile()
    {

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = "Profile";

        $id = $this->session->userdata('user_id');

        // get the list of categories
        $data['categories'] = $this->Post_model->get_categories();

        // get number of posts by the user
        $data['posts'] = $this->Post_model->get_posts_by_user($id, false);

        $this->load->view('templates/header');
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }

    // get all users controller
    public function profile_user_list(){
        if ($this->session->userdata('is_admin') == 'yes') {
        $all_user_data = $this->User_model->get_all_users();
        echo json_encode($all_user_data);
        }
    }

    // get all users controller
    public function profile_category_list(){

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $id = $this->session->userdata('user_id');

        if ($this->session->userdata('is_admin') == 'yes') {

            // get all posts
            $user_cat = $this->Post_model->get_categories();

        }else{

            // get all posts created by this user
            $user_cat = $this->Post_model->get_categories($id);
            
        }               
        echo json_encode($user_cat);
    }


    // show posts by the user who is logged in
    public function posts()
    {

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $id = $this->session->userdata('user_id');

        if ($this->session->userdata('is_admin') == 'yes') {

            // get all posts
            $user_posts = $this->Post_model->get_posts(false);

        }elseif($this->session->userdata('is_admin') == 'no'){

            // get all posts created by this user
            $user_posts = $this->Post_model->get_posts_by_user($id, true);
            
        }               
        echo json_encode($user_posts);

    }

    // show other posts by an author
    public function authorposts($id)
    {

        $name = $this->input->post('author_name');

        // get all posts created by the selected author
        $data['posts'] = $this->Post_model->get_posts_by_user($id, true);
        $data['title'] = "Author's Posts";

        // render the posts index page to display the result
        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    // signup
    public function register()
    {
        $data['title'] = "Sign up!";

        // some normal form validation rules
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
            $config['upload_path'] = './assets/images/profile';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $errors = array('error' => $this->upload->display_errors());
                $user_image = 'no_image.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
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

        // if there is any typing mistakes by user, show him errors
        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');

        } else {

            // check the datas entered by the user is right or wrong
            // create an array with the user entered credentials
            $login_data = array(
                'l_email' => $this->input->post('login_email'),
                'l_password' => $this->input->post('login_password'),
            );

            // pass the array to check in database
            $result = $this->User_model->login($login_data);

            // if the user exists with the entered details
            if ($result == true) {

                // get all other details of the user with the email we got
                $l_email = $this->input->post('login_email');
                $result = $this->User_model->get_user_datas($l_email);

                // create a session with the datas acquired from database
                if ($result != false) {

                    if($result[0]->pencil_db_users_is_active == 'yes'){

                    $user_data = array(
                        'user_id' => $result[0]->pencil_db_users_id,
                        'user_image' => $result[0]->pencil_db_users_image,
                        'user_username' => $result[0]->pencil_db_users_username,
                        'user_bio' => $result[0]->pencil_db_users_bio,
                        'user_email' => $result[0]->pencil_db_users_email,
                        'user_password' => $result[0]->pencil_db_users_password,
                        'is_admin' => $result[0]->pencil_db_users_is_admin,
                        'is_active' => $result[0]->pencil_db_users_is_active,
                        'logged_in' => true,

                    );

                    // created 'userdata' session
                    $this->session->set_userdata($user_data);
                    // set message
                    $this->session->set_flashdata('user_logged_in', 'You are now logged in');
                    redirect('posts');
                 }else{
                     // set message
                    $this->session->set_flashdata('login_ban', 'Login is Bannned');
                    redirect('users/login');
                 }

                }
            } else {
                // set message
                $this->session->set_flashdata('login_failed', 'Login is Invalid');
                redirect('users/login');

            }
        }
    }


    public function update()
    {

        // the actual edit function, this calls the update user function in the model

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // upload image (don't touch anything, its working fine with the current config :-P )
        $config['upload_path'] = './assets/images/profile';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $errors = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $user_image = $_FILES['userfile']['name'];
        }

        // update the user image
        $this->User_model->update_user($user_image);
        $this->session->set_flashdata('user_updated', 'Your data has been updated');
        redirect('users/logout');
    }

    // change password
    public function change_password()
    {

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('old_password', 'Password', 'required');
        $this->form_validation->set_rules('new_password', 'Password', 'required');
        $this->form_validation->set_rules('new_password_confirm', 'Confirm password', 'matches[new_password]');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/change_password', $data);
            $this->load->view('templates/footer');

        } else {

            // check if the current password entered by user is right or wrong
            $old_pwd_check = $this->User_model->check_old_pwd($this->input->post('old_password'));

            // if its right, call update password function in model
            if ($old_pwd_check) {

                // encrypt the password before passing
                $password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
                $result = $this->User_model->change_password($password);
                redirect('users/logout');

            } else {

                // if its wrong, inform user about that
                $this->session->set_flashdata('old_password_error', 'Current password is wrong');
                $this->load->view('templates/header');
                $this->load->view('users/change_password', $data);
                $this->load->view('templates/footer');
            }

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
        $this->session->unset_userdata('user_username');
        $this->session->unset_userdata('user_bio');
        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('is_active');
        $this->session->unset_userdata('logged_in');

        // set message
        $this->session->set_flashdata('user_logged_out', 'the user is loggedout');
        redirect('users/login');
    }

    public function delete()
    {
        $u_id = $this->input->post('id');
        // delete the user with matching id
        $this->db->where('pencil_db_users_id', $u_id);
        $this->db->delete('pencil_db_users');
        $this->db->where('pencil_db_posts_user_id', $u_id);
        $this->db->delete('pencil_db_posts');
        $this->session->set_flashdata('user_deleted', 'the user is deleted');
        redirect('users/profile');
    }

    public function self_distruct()
    {   
        $data['title'] = "Confirm";

        // form->> rules
        $this->form_validation->set_rules('confirm_password', 'Password', 'required');

        // if there is any typing mistakes by user, show him errors
        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/self_distruct', $data);
            $this->load->view('templates/footer');

        } else {

           if(password_verify($this->input->post('confirm_password'), $this->session->userdata('user_password'))) {
                
                // delete the user with matching id
                $this->db->where('pencil_db_users_id', $this->session->userdata('user_id'));
                $this->db->delete('pencil_db_users');
                $this->db->where('pencil_db_posts_user_id', $this->session->userdata('user_id'));
                $this->db->delete('pencil_db_posts');
                $this->session->set_flashdata('account_deleted', 'your pencil account is deleted');
                redirect('users/logout');
                         
           }else{
               // set message
               $this->session->set_flashdata('pwd_error', 'Login is Invalid');
               redirect('users/self_distruct');
               return false;
           }

        }

       
    }

    // block user
    public function block(){

        // block the user with matching id
        $u_id = $this->input->post('id');


        // data array
        $data = array(
            'pencil_db_users_is_active' => 'no',
        );

        $this->db->where('pencil_db_users_id', $u_id);
        $this->db->update('pencil_db_users', $data);
        $this->session->set_flashdata('user_blocked', 'the user is blocked');
        redirect('users/profile');
    }

    // unblock user
    public function unblock(){

        // unblock the user with matching id
        $u_id = $this->input->post('id');


        // data array
        $data = array(
            'pencil_db_users_is_active' => 'yes',
        );

        $this->db->where('pencil_db_users_id', $u_id);
        $this->db->update('pencil_db_users', $data);
        $this->session->set_flashdata('user_unblocked', 'the user is unblocked');
        redirect('users/profile');
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
