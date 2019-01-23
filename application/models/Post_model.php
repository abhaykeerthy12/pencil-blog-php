<?php
class Post_model extends CI_Model
{

    public function __construct()
    {

        // connect the database
        $this->load->database();
    }

    public function num_posts(){

        $total_posts= $this->db->get('pencil_db_posts');

        return $total_posts->num_rows();

    }

    public function get_posts($slug = false)
    {


       
        $post_number = $this->input->post('nextpostnumber');
    
        // if the slug is false i.e, if not requesting any special post, just get all to display in index page
        if ($slug === false) {

            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');
            $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
            $this->db->limit($post_number);
            $query = $this->db->get('pencil_db_posts');
            return $query->result_array();

        }

        // if the slug is true i.e, requesting any special post, get it, to show it in view page
        $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
        $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_slug' => $slug));
        return $query->row_array();

    }

    // seacrh box
    public function get_posts_by_search($search_term){

        $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');
        $this->db->like('pencil_db_posts_title', $search_term);
        $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
        $query = $this->db->get('pencil_db_posts');
        return $query->result_array();


    }

    // get posts by a particular user
    public function get_posts_by_user($id, $view = false)
    {

        // if the view parameter is true,i.e if we need to show the whole post, just get all data
        if ($view) {
            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');
            $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
            $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_user_id' => $id));
            return $query->result_array();
        } else {

            // if the view parameter is false,i.e if we just need the no.of.posts by the user, get it
            $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_user_id' => $id));
            return $query->num_rows();
        }

    }

    public function create_post($post_image)
    {

        // create post with the specified data

        // create a slug for the post from the title by url_title function(its inbuild, i don't know what it does :-P)
        $slug = url_title($this->input->post('post_title'));

        // create the data array
        $data = array(
            'pencil_db_posts_title' => $this->input->post('post_title'),
            'pencil_db_posts_slug' => $slug,
            'pencil_db_posts_body' => $this->input->post('post_body'),
            'pencil_db_posts_category_id' => $this->input->post('post_category'),
            'pencil_db_posts_post_image' => $post_image,
            'pencil_db_posts_user_id' => $this->session->userdata('user_id'),
        );

        // insert the data
        return $this->db->insert('pencil_db_posts', $data);
    }

    public function delete_post($id)
    {

        // delete the post with matching id
        $this->db->where('pencil_db_posts_id', $id);
        $this->db->delete('pencil_db_posts');
        return true;
    }

    public function update_post($post_image)
    {
        if (!$post_image) {
            $post_image = $this->input->post('userfile1');
        }
        // similar to the create function, refer that function to understand
        // i'm just lazy to type again :-D

        $slug = url_title($this->input->post('post_title'));

        $data = array(
            'pencil_db_posts_title' => $this->input->post('post_title'),
            'pencil_db_posts_slug' => $slug,
            'pencil_db_posts_body' => $this->input->post('post_body'),
            'pencil_db_posts_category_id' => $this->input->post('post_category'),
            'pencil_db_posts_post_image' => $post_image,
        );

        $this->db->where('pencil_db_posts_id', $this->input->post('post_id'));
        return $this->db->update('pencil_db_posts', $data);
    }

    public function get_categories($id = false)
    {
        if($id){
            
            // get the whole categories
            $this->db->order_by('pencil_db_categories_name');
            $this->db->where('pencil_db_categories_user_id', $id);
            $query = $this->db->get('pencil_db_categories');

        }else{

            // get the whole categories
            $this->db->order_by('pencil_db_categories_name');
            $query = $this->db->get('pencil_db_categories');
        }
        
        return $query->result_array();

    }

    // get the data of the post author by using his id
    public function get_author($u_id)
    {

        $query = $this->db->get_where('pencil_db_users', array('pencil_db_users_id' => $u_id));
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get_posts_by_category($condition)
    {

        $post_number = $this->input->post('nextpostnumber');
        $post_number = 20;

    
             // get posts by category with the matching category id
            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');

            // get posts by category
            $this->db->where_in('pencil_db_categories.pencil_db_categories_id', $condition['category']);

            // join both tables to show datas
            // i.e, join the post with the category id in posts table and refer that to the category id in category table
            $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');

        
            $this->db->limit($post_number);

            // get the data
            $query = $this->db->get_where('pencil_db_posts');
            return $query->result_array();
    }

    // get posts by date
    public function get_posts_by_date($condition)
    {

        $from_date = $condition['dates'][0];
        $to_date = $condition['dates'][1];

        $post_number = $this->input->post('nextpostnumber');
        $post_number = 20;

    
             // get posts by category with the matching category id
            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');

            $this->db->where('pencil_db_posts_created_date >=', $from_date);
            $this->db->where('pencil_db_posts_created_date <=', $to_date);
            $this->db->limit($post_number);

            // get the data
            $query = $this->db->get('pencil_db_posts');
            return $query->result_array();
    }
}
