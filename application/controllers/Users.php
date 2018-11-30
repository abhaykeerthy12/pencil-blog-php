<?php 
	class Users extends CI_Controller{
		// signup
		public function register(){
			$data['title'] = "Sign up!";

			// some normal form validation rules
			$this->form_validation->set_rules('signup_name', 'Name', 'required');
			$this->form_validation->set_rules('signup_username', 'Userame', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('signup_email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('signup_password', 'Password', 'required');
			$this->form_validation->set_rules('signup_confirm_password', 'Confirm password', 'matches[signup_password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register' ,$data);
				$this->load->view('templates/footer');

			}else{

				// encrypt password (using too old md5, need to change this, remind me :-P)
				// note:-->> the md5 version is working with ease, thats why i used it...
				$hashed_password = md5($this->input->post('signup_password'));

				// pass the encrypted version of the password, other datas are easily available on the other side...
				$this->User_model->register($hashed_password);

				// set message
				$this->session->set_flashdata('user_registered', 'You are now registered, you can log in');
				redirect('users/login');

			}
		}

		// login
		public function login(){
			$data['title'] = "Login!";

			// form->> rules
			$this->form_validation->set_rules('login_email', 'Email', 'required');
			$this->form_validation->set_rules('login_password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login' ,$data);
				$this->load->view('templates/footer');

			}else{
				$login_data = array(
					'l_email' => $this->input->post('login_email'),
					'l_password' => md5($this->input->post('login_password'))
					);
					$result = $this->User_model->login($login_data);
		
					if ($result == TRUE) {
					
					$l_email = $this->input->post('login_email');
					$result = $this->User_model->get_user_datas($l_email);
					if ($result != false) {
					$user_data = array(
					'user_id' => $result[0]->pencil_db_users_id,
					'user_name' => $result[0]->pencil_db_users_name,
					'user_email' => $result[0]->pencil_db_users_email,
					'is_admin' => $result[0]->pencil_db_users_is_admin,
					'logged_in' => true
		
					);
		
					// created 'userdata' session
					$this->session->set_userdata($user_data);
					// set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					redirect('posts');
		
					}else{
						// set message
						$this->session->set_flashdata('login_failed', 'Login is Invalid');
						redirect('users/login');
		
						}
					}
				}
		}


		public function admin(){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			
			if($this->session->userdata('is_admin') == 'yes'){

				$data['title'] = 'Administration';

				$data['users'] = $this->User_model->get_all_users();

				$this->load->view('templates/header');
				$this->load->view('users/admin' ,$data);
				$this->load->view('templates/footer');
			}

		}

		public function logout(){
			
			// unset user data
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_email');
			$this->session->unset_userdata('user_name');
			$this->session->unset_userdata('is_active');
			$this->session->unset_userdata('logged_in');

			// set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect('users/login');
		}

		public function delete($u_id){
			// delete the post with matching id
			$this->db->where('pencil_db_users_id', $u_id);
			$this->db->delete('pencil_db_users');
			$this->db->where('pencil_db_posts_user_id', $u_id);
			$this->db->delete('pencil_db_posts');
			$this->session->set_flashdata('user_deleted', 'the user is deleted');
			redirect('users/admin');
		}


		// check if username already exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken, try another');
			if($this->User_model->check_username_exists($username)){
				return true;
			}else{
				return false;
			}
		}

		// check if email already exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken, try another');
			if($this->User_model->check_email_exists($email)){
				return true;
			}else{
				return false;
			}
		}
	}