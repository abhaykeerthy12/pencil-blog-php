<?php
class Category_model extends CI_Model
{

    public function __construct()
    {

        // connect with database
        $this->load->database();
    }

    public function create_category()
    {
        $cate_name = $this->input->post('cate_name');
        $query = $this->db->get_where('pencil_db_categories', array('pencil_db_categories_name' => $cate_name));
        if (empty($query->row_array())) {
            // create an array with data entered by the user
            $data = array(
                'pencil_db_categories_name' => ucfirst($cate_name),
                'pencil_db_categories_user_id' => $this->session->userdata('user_id'),
            );
            // insert the data
            $this->db->insert('pencil_db_categories', $data);
            return true;
            
        } else {
            return false;
        }
        
    }

    public function get_category($id)
    {

        // get the category with the matching id
        $query = $this->db->get_where('pencil_db_categories', array('pencil_db_categories_id' => $id));
        return $query->row();
    }

    public function delete_category($id)
    {

        // delete the category with the matching id
        $this->db->where('pencil_db_categories_id', $id);
        $this->db->delete('pencil_db_categories');
        // get the post which had the category
        $this->db->select('pencil_db_posts_id');
        $this->db->where('pencil_db_posts_category_id', $id);
        $query = $this->db->get('pencil_db_posts');    
        $posts = $query->result_array();
        foreach ($posts as $post) {
            // delete the comments for that post
            $this->db->where('pencil_db_comments_post_id', $post['pencil_db_posts_id']);
            $this->db->delete('pencil_db_comments');  
        }
        // delete the post
        $this->db->where('pencil_db_posts_category_id', $id);
        $this->db->delete('pencil_db_posts');
        return true;
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

    public function get_posts_by_category($condition)
    {

        

    
             // get posts by category with the matching category id
            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');

            // get posts by category
            $this->db->where_in('pencil_db_categories.pencil_db_categories_id', $condition['category']);

            // join both tables to show datas
            // i.e, join the post with the category id in posts table and refer that to the category id in category table
            $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');

        

            // get the data
            $query = $this->db->get('pencil_db_posts');
            return $query->result_array();
    }
}
