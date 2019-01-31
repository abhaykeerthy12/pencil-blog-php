<?php

class Posts extends CI_Controller
{

    // list all posts
    public function index()
    {
        $data['title'] = 'Latest Posts';

        // get posts with limits rules and limits passed (paginate)
        $data['posts'] = $this->Post_model->get_posts(false);
        $data['categories'] = $this->Category_model->get_categories();

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');

    }

    // get posts by category
    public function card(){

        
      
        

            $data['posts'] = $this->Post_model->get_posts(false);
            $data['num_posts'] = $this->Post_model->num_posts();
            $data['users'] = $this->User_model->get_all_users();

        

 
        //  $this->load->view('posts/blog-card', $data);
         echo json_encode($data);
    }

    // search box
    public function search(){

        if($this->input->post("search_term")){

         $search_term = stripcslashes($this->input->post("search_term"));

         if($search_term){

            $data['users'] = $this->User_model->get_all_users();
            $data['posts'] = $this->Post_model->get_posts_by_search($search_term);

         }
        //  echo $search_term;


        }

        echo json_encode($data);
     




    }

    // get posts by dates
    public function cardbydate(){


        if(isset($_POST['dates'])){

        $dates = json_decode(stripcslashes($_POST['dates']));


        $condition = [];

        if($dates){

             $condition['dates'] = $dates;

             $data['posts'] = $this->Post_model->get_posts_by_date($condition);
     
             $data['categories'] = $this->Category_model->get_categories();
            $data['users'] = $this->User_model->get_all_users();


        }else{

             $data['posts'] = $this->Post_model->get_posts(false);
            $data['users'] = $this->User_model->get_all_users();

     

        }
        }else{

            $data['posts'] = $this->Post_model->get_posts(false);
            $data['users'] = $this->User_model->get_all_users();

        

        }
        
 
        echo json_encode($data);
    }

    // view a single post
    public function view($slug = null)
    {

        // view the page selected in the list of posts in index page
        $data['post'] = $this->Post_model->get_posts($slug);
        $post_id = $data['post']['pencil_db_posts_id'];
        $u_id = $data['post']['pencil_db_posts_user_id'];

        // also get comments for the same post
        $data['comments'] = $this->Comment_model->get_comments($post_id);

        // also get author of the post
        $data['user'] = $this->Post_model->get_author($u_id);

        // if there is no post like that, show 404 error
        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['pencil_db_posts_title'];

        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');

    }

    // create a post
    public function create()
    {
        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Create Post';

        // get the category list from the category table
        $data['categories'] = $this->Category_model->get_categories();

        $this->form_validation->set_rules('post_title', 'Title', 'required');
        $this->form_validation->set_rules('post_body', 'Body', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {

            // upload image (don't touch anything, its working fine with the current config :-P )
            $config['upload_path'] = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'no_image.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->Post_model->create_post($post_image);

            // set message
            $this->session->set_flashdata('post_created', 'Your post has been created');
            redirect('posts');
        }

    }

    // delete a post
    public function delete()
    {
        echo "hai";
        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $p_id = $this->input->post('id');

        // delete the posts with matching id
        $this->Post_model->delete_post($p_id);
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted');
        redirect('posts');
    }

    public function edit($slug)
    {

        // note that this function is only for rendering the editing page
        // this function doesn't really edit post, there is a difference :-P

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['post'] = $this->Post_model->get_posts($slug);

        // check user
        if ($this->session->userdata('user_id') != $this->Post_model->get_posts($slug)['pencil_db_posts_user_id']) {
            if ($this->session->userdata('is_admin') != 'yes') {
                redirect('posts');
            }
        }

        // get the list of categories
        $data['categories'] = $this->Category_model->get_categories();

        // if the post doesn't exists, show 404 error
        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = 'Edit post';

        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
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
        $config['upload_path'] = './assets/images/posts';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $errors = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $post_image = $_FILES['userfile']['name'];
        }

        $this->Post_model->update_post($post_image);
        $this->session->set_flashdata('post_updated', 'Your post has been updated');
        redirect('posts');
    }

    // count views for posts / hit website counter
    public function hit_counter(){

        $visiter_ip_address = $this->get_client_ip();

        $post_id = intval($this->input->post('post_id'));

        $result = $this->Post_model->visit_counter($visiter_ip_address, $post_id);

        if($result){
            return "changed something :-P";
        }else{
            return "he is refreshing";
        }
        
    }

    // Function to get the client IP address
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

}
