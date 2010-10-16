<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mydb {

    function Mydb() {
        
    }

    function field_data($table_name) {
        $CI =& get_instance();
        $CI->load->database();

        $sql2 = 'SHOW INDEX FROM '.$table_name;
        $query2 = $CI->db->query($sql2);
        $result2 = $query2->result();

        $sql = 'DESCRIBE '.$table_name;
        $query = $CI->db->query($sql);
        $result = $query->result();

        $fields = array();

        $i = 1;
        foreach ($result as $item) {
            $field = '';

            $field->name = $item->Field;

            $type = explode('(', $item->Type);
            $field->type = $type[0];

            $field->max_length = 0;
            if(count($type) > 1) {
                $value = explode(')', $type[1]);
                $field->max_length = $value[0];
            }

            $field->primary_key = 0;
            if($item->Key == 'PRI') {
                $field->primary_key = 1;
            }

            $field->auto_increment = 0;
            if($item->Extra == 'auto_increment') {
                $field->auto_increment = 1;
            }

            $field->foreign_key = 0;
            if($item->Key == 'MUL') {
                $field->foreign_key = 1;
            }

            $field->null = $item->Null;

            $field->default_value = $item->Default;

            $field->references_table = '';

            $field->references_field = '';

            foreach($result2 as $item2) {
                if(($item2->Column_name == $field->name) && ($field->foreign_key == 1)) {
                    $back_len = strlen($table_name) + 4;

                    $fk = $item2->Key_name;
                    $fk_len = strlen($fk);

                    $rest = substr($fk, 0, - $back_len);
                    $field->references_table = $rest;
                    $field->references_field = $item2->Column_name;
                }
            }

            $fields[] = $field;
        }

        return $fields;
    }
}

?>