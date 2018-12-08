<?php

class Posts extends CI_Controller
{

    // list all posts
    public function index($offset = 0)
    {
        // pagination config
        $config['base_url'] = base_url() . 'posts/index/';
        $config['total_rows'] = $this->db->count_all('pencil_db_posts');
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'index_pagination');

        // initialize pagination
        $this->pagination->initialize($config);

        $data['title'] = 'Latest Posts';

        // get posts with limits rules and limits passed (paginate)
        $data['posts'] = $this->Post_model->get_posts(false, $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');

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
