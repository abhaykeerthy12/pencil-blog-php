<?php
class Post_model extends CI_Model
{

    public function __construct()
    {

        // connect the database
        $this->load->database();
    }

    public function get_posts($slug = false, $limit = false, $offset = false)
    {

        // the parameters that's passed are needed for pagination
        // don't worry, its not complicated, its just tough to understand

        // set the limit of posts to get
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        // if the slug is false i.e, if not requesting any special post, just get all to display in index page
        if ($slug === false) {

            $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');
            $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');
            $query = $this->db->get('pencil_db_posts');
            return $query->result_array();

        }

        // if the slug is true i.e, requesting any special post, get it, to show it in view page
        $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_slug' => $slug));
        return $query->row_array();

    }

    public function create_post($post_image)
    {

        // create post with the specified data

        // create a slug for the post from the title by url_title function(its inbuild, i don't know what it does :-P)
        $slug = url_title($this->input->post('post_title'));

        // create the data array
        $data = array(
            'pencil_db_posts_title'       => $this->input->post('post_title'),
            'pencil_db_posts_slug'        => $slug,
            'pencil_db_posts_body'        => $this->input->post('post_body'),
            'pencil_db_posts_category_id' => $this->input->post('post_category'),
            'pencil_db_posts_post_image'  => $post_image,
            'pencil_db_posts_user_id'     => $this->session->userdata('user_id'),
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

    public function update_post()
    {

        // similar to the create function, refer that function to understand
        // i'm just lazy to type again :-D

        $slug = url_title($this->input->post('post_title'));

        $data = array(
            'pencil_db_posts_title'       => $this->input->post('post_title'),
            'pencil_db_posts_slug'        => $slug,
            'pencil_db_posts_body'        => $this->input->post('post_body'),
            'pencil_db_posts_category_id' => $this->input->post('post_category'),
        );

        $this->db->where('pencil_db_posts_id', $this->input->post('post_id'));
        return $this->db->update('pencil_db_posts', $data);
    }

    public function get_categories()
    {

        // get the whole categories
        $this->db->order_by('pencil_db_categories_name');
        $query = $this->db->get('pencil_db_categories');
        return $query->result_array();

    }

    public function get_posts_by_category($category_id)
    {

        // get posts by category with the matching category id
        $this->db->order_by('pencil_db_posts.pencil_db_posts_id', 'DESC');

        // join both tables to show datas
        // i.e, join the post with the category id in posts table and refer that to the category id in category table
        $this->db->join('pencil_db_categories', 'pencil_db_categories.pencil_db_categories_id = pencil_db_posts.pencil_db_posts_category_id');

        // get the data
        $query = $this->db->get_where('pencil_db_posts', array('pencil_db_posts_category_id' => $category_id));
        return $query->result_array();
    }
}
