<?php

class Kategori extends Controller {

    function Kategori() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('Kategori_model');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->Kategori_model->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->Kategori_model->select($limit, $offset);
            $total_rows = $this->Kategori_model->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/kategori/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->Kategori_model->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('kategori_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        
        $content = $this->load->view('kategori_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {
        $nama = $this->input->post('nama');
        $parent_id = $this->input->post('parent_id');

        $kategori = array(
                'nama' => $nama,
                'parent_id' => $parent_id,
        );

        $this->Kategori_model->insert($kategori);
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->Kategori_model->select_by_id($id);
        $data['result'] = $result;
        
        $content = $this->load->view('kategori_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {
        $nama = $this->input->post('nama');
        $parent_id = $this->input->post('parent_id');
        $id = $this->input->post('id');

        $kategori = array(
                'nama' => $nama,
                'parent_id' => $parent_id,
        );

        $this->Kategori_model->update($id, $kategori);
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->Kategori_model->delete($id);
        $this->grid_provider();
    }
}

?>