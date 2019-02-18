<?php
class Categories extends CI_Controller
{

    // the main page where all categories are listed
    public function index()
    {     
        // fetch category names and other data from database
        $cate_names = $this->Category_model->get_categories(false);
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
        $status  = $this->Category_model->create_category();

        echo json_encode($status);
    }

    // get posts based on selected category
    public function posts()
    {
              
        if(isset($_POST['category'])){
                  
            $cate = json_decode(stripcslashes($_POST['category']));
            $condition = [];

            if($cate){
                 $condition['category'] = $cate;
                 $data['posts'] = $this->Category_model->get_posts_by_category($condition);
                 $data['categories'] = $this->Category_model->get_categories();
                 $data['num_posts'] = $this->Post_model->num_posts();
            $data['comments'] = $this->Comment_model->get_comments(false);
            $data['users'] = $this->User_model->get_all_users();

            }else{
                 $data['posts'] = $this->Post_model->get_posts(false);
                 $data['num_posts'] = $this->Post_model->num_posts();
            $data['comments'] = $this->Comment_model->get_comments(false);
                 
            $data['users'] = $this->User_model->get_all_users();

            }
        }
        echo json_encode($data);

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
