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

    // add ip of new visiter and also increment the counter
    public function visit_counter($ipaddress, $post_id){

        $format = "h:i A";
        date_default_timezone_set('Asia/Kolkata');

        $this->db->select('*');
        $this->db->from('pencil_db_visiters');
        $this->db->where('pencil_db_visiters_ip_address', $ipaddress);
        $query = $this->db->get();

        // if the ip exists in db just increase the views in post and update the last time also check time
        if ($query->num_rows() == 1) {

            $row = $query->row_array();
            
            // get last time from db
            $last_time_db = $row['pencil_db_visiters_last_time'];
            $last_time = date($format, strtotime($last_time_db));
            
            // get current time
            $current_time = date($format);
            // get current time - 5 mins
            $current_time_minus_five_min = date($format, strtotime("-5 minute"));
            
        if($row['pencil_db_visiters_last_post'] == $post_id){

                // check if last time is between the time limit
                if(!($last_time > $current_time_minus_five_min && $last_time < $current_time)){

                    // the visiter visited this post after 5 mins of last visit
                    // update last time
                    $data = array(
                        'pencil_db_visiters_last_time' => date("Y-m-d h:i:s"),
                        'pencil_db_visiters_last_post' => $post_id
                    );

                    $this->db->where('pencil_db_visiters_ip_address', $ipaddress);
                    $this->db->update('pencil_db_visiters', $data);

                    // increase the view of post in posts table
                    $this->db->where('pencil_db_posts_id', $post_id);
                    $this->db->set('pencil_db_posts_views', 'pencil_db_posts_views+1', FALSE);
                    return $this->db->update('pencil_db_posts');

                }

        }else{

                 // update last time
                 $data = array(
                    'pencil_db_visiters_last_time' => date("Y-m-d h:i:s"),
                    'pencil_db_visiters_last_post' => $post_id
                );

                $this->db->where('pencil_db_visiters_ip_address', $ipaddress);
                $this->db->update('pencil_db_visiters', $data);

                // increase the view of post in posts table
                $this->db->where('pencil_db_posts_id', $post_id);
                $this->db->set('pencil_db_posts_views', 'pencil_db_posts_views+1', FALSE);
                return $this->db->update('pencil_db_posts');
                

            }

            
            
        } else {

            // if not, add the ip to db and increase the view of post and add last time

            // add new ip and last time to visiters table
            $data = array(
                'pencil_db_visiters_ip_address' => $ipaddress,
                'pencil_db_visiters_last_time' => date("Y-m-d h:i:s"),
                'pencil_db_visiters_last_post' => $post_id
            );
            
            $this->db->insert('pencil_db_visiters', $data);

            // increase the view of post in posts table
            $this->db->where('pencil_db_posts_id', $post_id);
            $this->db->set('pencil_db_posts_views', 'pencil_db_posts_views+1', FALSE);
            return $this->db->update('pencil_db_posts');

            
        }

    }
}
