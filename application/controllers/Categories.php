<?php
class Categories extends CI_Controller
{

    // the main page where all categories are listed
    public function index()
    {
       

        // fetch category names and other data from database
        $cate_names = $this->Post_model->get_categories(false);
        echo json_encode($cate_names);


    }

    // the category creation page
    public function create()
    {
        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }       

        // render the index page if everything is ok, also show a created message
        $this->Category_model->create_category();
        $this->session->set_flashdata('category_created', 'Your category has been created');

    }

    // get posts based on selected category
    public function posts($id)
    {
        // get category name from the category table using the passed category id
        $data['title'] = $this->Category_model->get_category($id)->pencil_db_categories_name;

        // call get posts by category function to get data by passing category id
        $data['posts'] = $this->Post_model->get_posts_by_category($id);

        // render the posts index page to display the result
        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');

    }

    public function delete()
    {

        // check if logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $id = $this->input->post('id');


        // delete the category with the passed id
        $this->Category_model->delete_category($id);

        // set message
        $this->session->set_flashdata('category_deleted', 'The category has been deleted');

        // render the category list page again
        redirect('categories');
    }

}
