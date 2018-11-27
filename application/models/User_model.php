<?php 
	class User_model extends CI_Model{

		public function __construct(){

			// connect the database
			$this->load->database();
		}

		public function register($hashed_password){

			// user data array
			$data  = array(
				'pencil_db_users_name' => $this->input->post('signup_name'),
				'pencil_db_users_username' => $this->input->post('signup_username'),
				'pencil_db_users_email' => $this->input->post('signup_email'),
				'pencil_db_users_password' => $hashed_password
			);

			// insert the data
			return $this->db->insert('pencil_db_users', $data);
		}

		// Log user in
		public function login($email, $password){

			// validate
			// read the code, its easy to understand than comments, i think so :-P
			$this->db->where('pencil_db_users_password', $password);
			$this->db->where('pencil_db_users_email', $email);

			$result = $this->db->get('pencil_db_users');

			if($result->num_rows() == 1){
				return $result->row(0)->pencil_db_users_id;
			}else{
				return false;
			}
		}



		// check whether the username is already taken
		public function check_username_exists($username){
			$query = $this->db->get_where('pencil_db_users', array('pencil_db_users_username' => $username));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// check whether the email is already taken
		public function check_email_exists($email){
			$query = $this->db->get_where('pencil_db_users', array('pencil_db_users_email' => $email));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}
	}