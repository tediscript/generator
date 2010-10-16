<?php

class Kontak_kategori extends Controller {

    function Kontak_kategori() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('Kontak_kategori_model');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->Kontak_kategori_model->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->Kontak_kategori_model->select($limit, $offset);
            $total_rows = $this->Kontak_kategori_model->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/kontak_kategori/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->Kontak_kategori_model->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('kontak_kategori_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        
        $content = $this->load->view('kontak_kategori_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {
        $kontak_id = $this->input->post('kontak_id');
        $kategori_id = $this->input->post('kategori_id');

        $kontak_kategori = array(
                'kontak_id' => $kontak_id,
                'kategori_id' => $kategori_id,
        );

        $this->Kontak_kategori_model->insert($kontak_kategori);
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->Kontak_kategori_model->select_by_id($id);
        $data['result'] = $result;
        
        $content = $this->load->view('kontak_kategori_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_kategori';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {
        $kontak_id = $this->input->post('kontak_id');
        $kategori_id = $this->input->post('kategori_id');
        $id = $this->input->post('id');

        $kontak_kategori = array(
                'kontak_id' => $kontak_id,
                'kategori_id' => $kategori_id,
        );

        $this->Kontak_kategori_model->update($id, $kontak_kategori);
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->Kontak_kategori_model->delete($id);
        $this->grid_provider();
    }
}

?>