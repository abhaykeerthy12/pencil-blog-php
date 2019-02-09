<?php
class Comments extends CI_Controller
{

    // create comment function
    public function create()
    {
        $post_id = $this->input->post('comment_post_id');
        // get the slug of post to work on
        $slug = $this->input->post('comment_post_slug');
        // get the post with the passed slug
        $data['post'] = $this->Post_model->get_posts($slug);
        // if everything is ok, call create comment function
        $this->Comment_model->create_comment($post_id);    
          
        $response = true;
        echo json_encode($response);
    }

    public function view(){
         $post_id = $this->input->post('post_id');
         if($this->session->userdata('logged_in')){
           $user_email = $this->session->userdata['user_email'];
           $data['user'] = $this->User_model->get_user_datas($user_email);

         }else{$data['user'] = false;}
         
         $data['comments'] = $this->Comment_model->get_comments($post_id);
         echo json_encode($data);
    }

    // delete comments
    public function delete()
    {
        // get the slug of post to work on
        $id = $this->input->post('comment_id');
        // delete the post with matching id
        $this->db->where('pencil_db_comments_id', $id);
        $this->db->delete('pencil_db_comments');  
        $response = true;
        echo json_encode($response);

    }
}
