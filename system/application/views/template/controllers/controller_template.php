{php_open}

class {controller_name} extends Controller {

    function {controller_name}() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->model('{model_name}');
    }

    function index() {
        $this->grid_provider();
    }

    function grid_provider($offset=0) {
        $limit = 20;
        $criteria = $this->input->post('criteria');
        $key = $this->input->post('key');

        if($criteria!='' && $key!='') {
            $result = $this->{model_name}->select_like($criteria, $key);
            $pagination_config['total_rows'] = 0;
        }else {
            $result = $this->{model_name}->select($limit, $offset);
            $total_rows = $this->{model_name}->count_all();
            $pagination_config['total_rows'] = $total_rows;
        }
        $data['result'] = $result;

        $this->load->library('pagination');
        $pagination_config['base_url'] = site_url().'/{table_name}/grid_provider/';
        $pagination_config['per_page'] = $limit;
        $this->pagination->initialize($pagination_config);
        $pagination = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->helper('inflector');
        $field_data = $this->{model_name}->field_data();
        $data['field_data'] = $field_data;
        $content =  $this->load->view('{table_name}_grid', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = '{controller_name}';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_provider() {
        $data = array();
        {foreigns_add}
        $this->load->model('{foreign_model_name}');
        $foreign{foreign_num} = $this->{foreign_model_name}->select();
        $data['foreign{foreign_num}'] = $foreign{foreign_num};
        {/foreigns_add}
        $content = $this->load->view('{table_name}_add', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = '{controller_name}';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function add_handler() {{fields_data_add}
        {field_data}{/fields_data_add}

        ${table_name} = array({fields_data_add_array}
                {field_data}{/fields_data_add_array}
        );

        $this->{model_name}->insert(${table_name});
        $this->grid_provider();
    }

    function edit_provider($id) {
        $result = $this->{model_name}->select_by_id($id);
        $data['result'] = $result;
        {foreigns_edit}
        $this->load->model('{foreign_model_name}');
        $foreign{foreign_num} = $this->{foreign_model_name}->select();
        $data['foreign{foreign_num}'] = $foreign{foreign_num};
        {/foreigns_edit}
        $content = $this->load->view('{table_name}_edit', $data, true);

        $template_data['content'] = $content;
        $template_data['title'] = '{controller_name}';
        $this->load->library('template');
        $this->template->view($template_data);
    }

    function edit_handler() {{fields_data_add}
        {field_data}{/fields_data_add}
        $id = $this->input->post('id');

        ${table_name} = array({fields_data_add_array}
                {field_data}{/fields_data_add_array}
        );

        $this->{model_name}->update($id, ${table_name});
        $this->grid_provider();
    }

    function delete_handler($id) {
        $this->{model_name}->delete($id);
        $this->grid_provider();
    }
}

{php_close}