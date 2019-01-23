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
        // create an array with data entered by the user
        $data = array(
            'pencil_db_categories_name' => ucfirst($cate_name),
            'pencil_db_categories_user_id' => $this->session->userdata('user_id'),
        );

        // insert the data
        return $this->db->insert('pencil_db_categories', $data);
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
        return true;
    }
}
