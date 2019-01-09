<?php

class Posts extends CI_Controller
{

    // list all posts
    public function index($offset = 0)
    {
        // pagination config
        $config['base_url'] = base_url() . 'posts/index/';
        $config['total_rows'] = $this->db->count_all('pencil_db_posts');
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] 	= '</ul></nav></div>';
        $config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] 	= '</span></li>';
        $config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] 	= '</span></li>';
        $config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] 	= '</span></li>';


        // initialize pagination
        $this->pagination->initialize($config);

        $data['title'] = 'Latest Posts';

        // get posts with limits rules and limits passed (paginate)
        $data['posts'] = $this->Post_model->get_posts(false, $config['per_page'], $offset);

        $data['categories'] = $this->Post_model->get_categories();

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');

    }

    public function card(){

         // pagination config
         $config['base_url'] = base_url() . 'posts/index/';
         $config['total_rows'] = $this->db->count_all('pencil_db_posts');
         $config['per_page'] = 2;
         $config['uri_segment'] = 3;
         $config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
         $config['full_tag_close'] 	= '</ul></nav></div>';
         $config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
         $config['num_tag_close'] 	= '</span></li>';
         $config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
         $config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
         $config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
         $config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
         $config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
         $config['prev_tagl_close'] 	= '</span></li>';
         $config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
         $config['first_tagl_close'] = '</span></li>';
         $config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
         $config['last_tagl_close'] 	= '</span></li>';
 
 
         // initialize pagination
         $this->pagination->initialize($config);
 
         // initialize pagination
 
         // get posts with limits rules and limits passed (paginate)
         $data['posts'] = $this->Post_model->get_posts(false, $config['per_page']);
 
         $data['categories'] = $this->Post_model->get_categories();
 
         $this->load->view('posts/blog-card', $data);
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
        $data['categories'] = $this->Post_model->get_categories();

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
    public function delete($id)
    {

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        // delete the posts with matching id
        $this->Post_model->delete_post($id);
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
        $data['categories'] = $this->Post_model->get_categories();

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

}
