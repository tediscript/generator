<?php

class Kontak extends Controller {

    function Kontak() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('Kontak_model');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->Kontak_model->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->Kontak_model->select($limit, $offset);
            $total_rows = $this->Kontak_model->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/kontak/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->Kontak_model->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('kontak_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        
        $content = $this->load->view('kontak_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {
        $instansi = $this->input->post('instansi');
        $gelar_depan = $this->input->post('gelar_depan');
        $nama = $this->input->post('nama');
        $gelar_belakang = $this->input->post('gelar_belakang');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $faks = $this->input->post('faks');
        $handphone = $this->input->post('handphone');
        $email = $this->input->post('email');

        $kontak = array(
                'instansi' => $instansi,
                'gelar_depan' => $gelar_depan,
                'nama' => $nama,
                'gelar_belakang' => $gelar_belakang,
                'jabatan' => $jabatan,
                'alamat' => $alamat,
                'telp' => $telp,
                'faks' => $faks,
                'handphone' => $handphone,
                'email' => $email,
        );

        $this->Kontak_model->insert($kontak);
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->Kontak_model->select_by_id($id);
        $data['result'] = $result;
        
        $content = $this->load->view('kontak_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = 'Kontak';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {
        $instansi = $this->input->post('instansi');
        $gelar_depan = $this->input->post('gelar_depan');
        $nama = $this->input->post('nama');
        $gelar_belakang = $this->input->post('gelar_belakang');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $faks = $this->input->post('faks');
        $handphone = $this->input->post('handphone');
        $email = $this->input->post('email');
        $id = $this->input->post('id');

        $kontak = array(
                'instansi' => $instansi,
                'gelar_depan' => $gelar_depan,
                'nama' => $nama,
                'gelar_belakang' => $gelar_belakang,
                'jabatan' => $jabatan,
                'alamat' => $alamat,
                'telp' => $telp,
                'faks' => $faks,
                'handphone' => $handphone,
                'email' => $email,
        );

        $this->Kontak_model->update($id, $kontak);
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->Kontak_model->delete($id);
        $this->grid_provider();
    }
}

?>