<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

class Generate extends Controller {

    function __construct () {
        parent::Controller();
        $this->load->library('Mydb');
        $this->load->model('generate_model');
    }

    function index() {
        $this->load->view('welcome');
    }

    function remove_handler() {
        $this->delete_directory('controller');
        $this->delete_directory('model');
        $this->delete_directory('view');
        echo '<a href="'.site_url().'/welcome/">Back to main menu</a><br/><br/>';
    }   

    function execute() {
        echo '<a href="'.site_url().'/welcome/">Back to main menu</a><br/><br/>';

        echo 'generating new <strong>Controllers</strong><br/>';
        $this->generate_controllers();
    }

    
}
?>
