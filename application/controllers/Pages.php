<?php

class Pages extends CI_Controller
{

    // view the page typed in url field by checking whether it exists in views folder
    public function view($page = 'home')
    {
        // if not show 404 error
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        // if its just the home page, render that
        elseif ($page == 'home') {

            $data['l_posts'] = $this->Post_model->home_posts(true, false);
            $data['p_posts'] = $this->Post_model->home_posts(true, false);
            $data['users'] = $this->User_model->get_all_users();
            

            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $data['title'] = ucfirst($page);

            // otherwise render the desired page
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');

        }
    }
}
