<?php

class Welcome extends Controller {

    function Welcome() {
        parent::Controller();
        $this->load->library('Mydb');
    }

    function index() {
        $this->load->view('welcome');
    }

    function remove_handler() {
        exec('rm -rvf output/controllers/*');
        exec('rm -rvf output/models/*');
        exec('rm -rvf output/views/*');

        echo '<a href="'.site_url().'/welcome/">Back to main menu</a><br/><br/>';
    }

    function generate() {
        echo '<a href="'.site_url().'/welcome/">Back to main menu</a><br/><br/>';

        echo 'generating new <strong>Edit Views</strong><br/>';
        $this->generate_edit_views();

        echo 'generating new <strong>Add Views</strong><br/>';
        $this->generate_add_views();

        echo 'generating new <strong>Grid Views</strong><br/>';
        $this->generate_grid_views();

        echo 'generating new <strong>Controllers</strong><br/>';
        $this->generate_controllers();

        echo 'generating new <strong>Models</strong><br/>';
        $this->generate_models();

        echo 'generating new <strong>Dashboard Controllers</strong><br/>';
        $this->generate_dashboard_controller();

        echo 'generating new <strong>Dashboard View</strong><br/>';
        $this->generate_dashboard_view();

        exec('chmod 777 output/ -R');
    }

    function generate_dashboard_view() {
        $tables = $this->db->list_tables();
        $modules = array();

        foreach ($tables as $table) {
            $modules[] = array(
                    'module' => '<a href="<?php echo site_url();?>/'.$table.'/">'.humanize($table).'</a><br/>',
            );
        }

        $data = array(
                'modules' => $modules,
        );

        $string = $this->parser->parse('template/views/view_dashboard_template', $data, TRUE);
        $path = 'output/views/dashboard.php';
        write_file($path, $string);

        echo 'generating <strong>Dashboard</strong> view...<br/>';

    }

    function generate_dashboard_controller() {
        $data = array(
                'php_open' => '<?php',
                'php_close' => '?>',
        );

        $string = $this->parser->parse('template/controllers/dashboard_controller_template', $data, TRUE);
        $path = 'output/controllers/dashboard.php';
        write_file($path, $string);

        echo 'generating <strong>Dashboard</strong> controller...<br/>';
    }

    function generate_edit_views() {
        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $table_name = $table;

            $view_name = humanize($table_name);
            $primary_key = '';
            $fields_data = array();
            $foreign_num = 1;

            $fields = $this->mydb->field_data($table_name);
            foreach ($fields as $field) {
                if($field->auto_increment != 1 && $field->foreign_key != 1 && $field->type != 'date') {
                    $fields_data[] = array(
                            'field_name' => humanize($field->name),
                            'field_input' => '<input type="text" name="'.$field->name.'" value="<?php echo $result[0]->'.$field->name.';?>" />',
                    );
                }else if($field->foreign_key == 1) {
                    $fields_data[] = array(
                            'field_name' => humanize($field->name),
                            'field_input' => '<select name="'.$field->name.'">
                            <?php foreach($foreign'.$foreign_num.' as $item): ?>
                                <option value="<?php echo $item->'.$field->name.';?>" <?php if($result[0]->'.$field->name.' == $foreign'.$foreign_num++.'->'.$field->name.') echo \'selected\';?>><?php echo $item->'.$field->name.';?></option>
                            <?php endforeach; ?>
                            </select>',
                    );
                }else if($field->type == 'date') {
                    $fields_data[] = array(
                            'field_name' => humanize($field->name),
                            'field_input' => '<input type="text" name="'.$field->name.'" onclick="displayDatePicker(\''.$field->name.'\');" class="text" value="<?php echo date(\'d-m-Y\', strtotime($result[0]->'.$field->name.'));?>" readonly="readonly" />
                            <a href="javascript:void(0);" onclick="displayDatePicker(\''.$field->name.'\');">
                            <img src="<?php echo base_url();?>images/calendar.png" alt="calendar" border="0"></a>',
                    );
                }
                if($field->primary_key == 1) {
                    $primary_key = $field->name;
                }
            }

            $data = array(
                    'php_open' => '<?php',
                    'php_close' => '?>',
                    'table_name' => $table_name,
                    'view_name' => $view_name,
                    'fields_data' => $fields_data,
                    'primary_key' => $primary_key,
            );

            $string = $this->parser->parse('template/views/view_edit_template', $data, TRUE);
            $path = 'output/views/'.$table_name.'_edit.php';
            write_file($path, $string);

            echo 'generating <strong>'.$table_name.'</strong> add...<br/>';
        }
    }

    function generate_add_views() {
        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $table_name = $table;

            $view_name = humanize($table_name);
            $primary_key = '';
            $fields_data = array();
            $foreign_num = 1;

            $fields = $this->mydb->field_data($table_name);
            foreach ($fields as $field) {
                if($field->auto_increment != 1 && $field->foreign_key != 1 && $field->type != 'date') {
//                    if($field->max_length == 0){
                        $fields_data[] = array(
                                'field_name' => humanize($field->name),
                                'field_input' => '<input type="text" name="'.$field->name.'" value=""/>',
                        );
//                    }else if(max_length > 0){
//                        $fields_data[] = array(
//                                'field_name' => humanize($field->name),
//                                'field_input' => '<input type="text" name="'.$field->name.'" value="" size="'.$field->max_length.'"/>',
//                        );
//                    }else if(true){
//
//                    }
                }else if($field->foreign_key == 1) {
                    $fields_data[] = array(
                            'field_name' => humanize($field->name),
                            'field_input' => '<select name="'.$field->name.'">
                            <?php foreach($foreign'.$foreign_num++.' as $item): ?>
                                <option value="<?php echo $item->'.$field->name.';?>"><?php echo $item->'.$field->name.';?></option>
                            <?php endforeach; ?>
                            </select>',
                    );
                }else if($field->type == 'date') {
                    $fields_data[] = array(
                            'field_name' => humanize($field->name),
                            'field_input' => '<input type="text" name="'.$field->name.'" onclick="displayDatePicker(\''.$field->name.'\');" class="text" value="" readonly="readonly" />
                            <a href="javascript:void(0);" onclick="displayDatePicker(\''.$field->name.'\');">
                            <img src="<?php echo base_url();?>images/calendar.png" alt="calendar" border="0"></a>',
                    );
                }
            }

            $data = array(
                    'php_open' => '<?php',
                    'php_close' => '?>',
                    'table_name' => $table_name,
                    'view_name' => $view_name,
                    'fields_data' => $fields_data,
            );

            $string = $this->parser->parse('template/views/view_add_template', $data, TRUE);
            $path = 'output/views/'.$table_name.'_add.php';
            write_file($path, $string);

            echo 'generating <strong>'.$table_name.'</strong> add...<br/>';
        }
    }

    function generate_grid_views() {
        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $table_name = $table;

            $view_name = humanize($table_name);
            $primary_key = '';

            $fields = $this->mydb->field_data($table_name);
            foreach ($fields as $field) {
                if($field->primary_key == 1) {
                    $primary_key = $field->name;
                }
            }

            $data = array(
                    'php_open' => '<?php',
                    'php_close' => '?>',
                    'table_name' => $table_name,
                    'view_name' => $view_name,
                    'primary_key' => $primary_key,
            );

            $string = $this->parser->parse('template/views/view_grid_template', $data, TRUE);
            $path = 'output/views/'.$table_name.'_grid.php';
            write_file($path, $string);

            echo 'generating <strong>'.$table_name.'</strong> view...<br/>';
        }
    }

    function generate_controllers() {
        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $table_name = $table;

            $first_string = substr($table_name, 0, 1);
            $first_string_up = strtoupper($first_string);
            $controller_name = substr_replace($table_name, $first_string_up, 0, 1);
            $model_name = $controller_name.'_model';

            $fields_data_add = array();
            $fields_data_add_array = array();
            $foreigns_add = array();
            $foreigns_edit = array();
            $foreign_num = 1;

            $fields = $this->mydb->field_data($table_name);
            foreach ($fields as $field) {
                if($field->auto_increment != 1 && $field->type != 'date') {
                    $fields_data_add[] = array(
                            'field_data' => '$'.$field->name.' = $this->input->post(\''.$field->name.'\');',
                    );
                    $fields_data_add_array[] = array(
                            'field_data' => '\''.$field->name.'\' => $'.$field->name.',',
                    );
                }else if($field->type == 'date') {
                    $fields_data_add[] = array(
                            'field_data' => '$'.$field->name.' = date(\'Y-m-d\', strtotime($this->input->post(\''.$field->name.'\')));',
                    );
                    $fields_data_add_array[] = array(
                            'field_data' => '\''.$field->name.'\' => $'.$field->name.',',
                    );
                }
                if($field->foreign_key == 1) {
                    $references_table = $field->references_table;
                    $first_string = substr($references_table, 0, 1);
                    $first_string_up = strtoupper($first_string);
                    $foreign_controller_name = substr_replace($references_table, $first_string_up, 0, 1);
                    $foreign_model_name = $foreign_controller_name.'_model';

                    $foreigns_add[] = array(
                            'foreign_num' => $foreign_num,
                            'foreign_model_name'=> $foreign_model_name,
                    );
                    $foreigns_edit[] = array(
                            'foreign_num' => $foreign_num,
                            'foreign_model_name'=> $foreign_model_name,
                    );
                    $foreign_num++;
                }
            }

            $data = array(
                    'php_open' => '<?php',
                    'php_close' => '?>',
                    'table_name' => $table_name,
                    'controller_name' => $controller_name,
                    'model_name' => $model_name,
                    'fields_data_add' => $fields_data_add,
                    'fields_data_add_array' => $fields_data_add_array,
                    'foreigns_add' => $foreigns_add,
                    'foreigns_edit' => $foreigns_edit,

            );

            $string = $this->parser->parse('template/controllers/controller_template', $data, TRUE);
            $path = 'output/controllers/'.$table_name.'.php';
            write_file($path, $string);

            echo 'generating <strong>'.$table_name.'</strong> controller...<br/>';
        }
    }

    function generate_models() {
        $tables = $this->db->list_tables();

        foreach ($tables as $table) {

            $table_name = $table;

            $first_string = substr($table_name, 0, 1);
            $first_string_up = strtoupper($first_string);

            $model_name = substr_replace($table_name, $first_string_up, 0, 1);

            $primary_key = '';

            $fields = $this->mydb->field_data($table_name);
            foreach ($fields as $field) {
                if($field->primary_key == 1) {
                    $primary_key = $field->name;
                }
            }

            $data = array(
                    'php_open' => '<?php',
                    'php_close' => '?>',
                    'table_name' => $table_name,
                    'model_name' => $model_name,
                    'primary_key' => $primary_key,
            );

            $string = $this->parser->parse('template/models/model_template', $data, TRUE);

            $path = 'output/models/'.$table_name.'_model.php';

            write_file($path, $string);

            echo 'generating <strong>'.$table_name.'</strong> model...<br/>';
        }
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */