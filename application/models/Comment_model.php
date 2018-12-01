<?php
class Comment_model extends CI_Model
{
    public function __construct()
    {

        // connect with the database
        $this->load->database();
    }

    public function create_comment($post_id)
    {

        // create the data array
        $data = array(
            'pencil_db_comments_post_id' => $post_id,
            'pencil_db_comments_name'    => $this->input->post('comment_name'),
            'pencil_db_comments_email'   => $this->input->post('comment_email'),
            'pencil_db_comments_body'    => $this->input->post('comment_body'),

        );

        // insert the data
        return $this->db->insert('pencil_db_comments', $data);
    }

    public function get_comments($post_id)
    {

        // get comments for the post with matching id
        $query = $this->db->get_where('pencil_db_comments', array('pencil_db_comments_post_id' => $post_id));
        return $query->result_array();
    }
}
