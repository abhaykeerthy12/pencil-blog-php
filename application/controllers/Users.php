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
				// get email
				$email = $this->input->post('login_email');
				// get password
				$password = md5($this->input->post('login_password'));

				// login user
				$user_id = $this->User_model->login($email, $password);

				if($user_id){
					// create session
					$user_data = array(
						'user_id' => $user_id,
						'user_email' => $email,
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

		public function logout(){
			
			// unset user data
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_email');
			$this->session->unset_userdata('logged_in');

			// set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect('users/login');
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