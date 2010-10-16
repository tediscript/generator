<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Generate_model extends Model {

    function __construct() {
        parent::Model();
        $this->path = $_SERVER['DOCUMENT_ROOT'].'/generator/output/';
    }

    function delete_directory($dirname) {
        $dirname = "".$this->path."".$dirname."";
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        return true;
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
}
?>
