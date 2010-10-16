<?php

class Kontak_importer extends Controller {

    function Kontak_importer() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('Kontak_importer_model');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->Kontak_importer_model->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->Kontak_importer_model->select($limit, $offset);
            $total_rows = $this->Kontak_importer_model->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/kontak_importer/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->Kontak_importer_model->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('kontak_importer_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_importer';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        
        $content = $this->load->view('kontak_importer_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_importer';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {
        $instansi = $this->input->post('instansi');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $faks = $this->input->post('faks');
        $handphone = $this->input->post('handphone');
        $email = $this->input->post('email');
        $kategori_id = $this->input->post('kategori_id');

        $kontak_importer = array(
                'instansi' => $instansi,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'alamat' => $alamat,
                'telp' => $telp,
                'faks' => $faks,
                'handphone' => $handphone,
                'email' => $email,
                'kategori_id' => $kategori_id,
        );

        $this->Kontak_importer_model->insert($kontak_importer);
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->Kontak_importer_model->select_by_id($id);
        $data['result'] = $result;
        
        $content = $this->load->view('kontak_importer_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak_importer';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {
        $instansi = $this->input->post('instansi');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $faks = $this->input->post('faks');
        $handphone = $this->input->post('handphone');
        $email = $this->input->post('email');
        $kategori_id = $this->input->post('kategori_id');
        $id = $this->input->post('id');

        $kontak_importer = array(
                'instansi' => $instansi,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'alamat' => $alamat,
                'telp' => $telp,
                'faks' => $faks,
                'handphone' => $handphone,
                'email' => $email,
                'kategori_id' => $kategori_id,
        );

        $this->Kontak_importer_model->update($id, $kontak_importer);
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->Kontak_importer_model->delete($id);
        $this->grid_provider();
    }
}

?>