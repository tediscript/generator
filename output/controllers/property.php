<?php

class Property extends Controller {

    function Property() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('Property_model');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->Property_model->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->Property_model->select($limit, $offset);
            $total_rows = $this->Property_model->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/property/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->Property_model->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('property_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Property';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        
        $content = $this->load->view('property_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Property';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {
        $property_id = $this->input->post('property_id');
        $value = $this->input->post('value');

        $property = array(
                'property_id' => $property_id,
                'value' => $value,
        );

        $this->Property_model->insert($property);
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->Property_model->select_by_id($id);
        $data['result'] = $result;
        
        $content = $this->load->view('property_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Property';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {
        $property_id = $this->input->post('property_id');
        $value = $this->input->post('value');
        $id = $this->input->post('id');

        $property = array(
                'property_id' => $property_id,
                'value' => $value,
        );

        $this->Property_model->update($id, $property);
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->Property_model->delete($id);
        $this->grid_provider();
    }
}

?>