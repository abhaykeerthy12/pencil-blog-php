<?php
class Comments extends CI_Controller
{

    // create comment function
    public function create($post_id)
    {

        // get the slug of post to work on
        $slug = $this->input->post('comment_post_slug');

        // get the post with the passed slug
        $data['post'] = $this->Post_model->get_posts($slug);

        // set form validation rules
        $this->form_validation->set_rules('comment_name', 'Name', 'required');
        $this->form_validation->set_rules('comment_email', 'Email', 'required');
        $this->form_validation->set_rules('comment_body', 'Comment', 'required');

        if ($this->form_validation->run() === false) {

            // if any error occured, re-render the post view page
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        } else {

            // if everything is ok, call create comment function
            $this->Comment_model->create_comment($post_id);

            // render the post view page with the matching slug
            redirect('posts/' . $slug);
        }
    }
}
