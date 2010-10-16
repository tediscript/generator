<?php

class Dashboard extends Controller{

    function Dashboard(){
        parent::Controller();
        $this->load->helper('url');
    }

    function index(){
        $content =  $this->load->view('dashboard', '', true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Dashboard';
        $this->load->library('template');
        $this->template->view($template_data);
    }
    
}

?>