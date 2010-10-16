<?php

class Kategori_model extends Model{
   
    var $table_name = 'kategori';

    function Kategori_model(){
        parent::Model();
    }

    function insert($kategori){
        $this->db->insert($this->table_name, $kategori);
    }

    function update($id, $kategori){
        $this->db->where('kategori_id', $id);
        $this->db->update($this->table_name, $kategori);
    }

    function delete($id){
        $this->db->where('kategori_id', $id);
        $this->db->delete($this->table_name);
    }

    function select($limit=0, $offset=0){
        if(($limit == 0) && ($offset == 0)){
            $query = $this->db->get($this->table_name);
            return $query->result();
        }else{
            $query = $this->db->get($this->table_name, $limit, $offset);
            return $query->result();
        }
    }

    function select_by_id($id){
        $this->db->where('kategori_id', $id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function select_by($criteria='', $key='') {
        if($criteria!='' && $key!='') {
            $this->db->where($criteria, $key);
        }
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function select_like($criteria='', $key='', $limit=0, $offset=0) {
        if($criteria!='' && $key!='') {
            $this->db->like($criteria, $key);
        }
        if($limit == 0 || $criteria == '' || $key == '') {
            $query = $this->db->get($this->table_name);
        }else {
            $query = $this->db->get($this->table_name, $limit, $offset);
        }
        return $query->result();
    }

    function count_all() {
        $result = $this->db->count_all($this->table_name);
        return $result;
    }

    function count_all_results($criteria, $key) {
        $this->db->like($criteria, $key);
        $this->db->from($this->table_name);
        $result = $this->db->count_all_results();
        return $result;
    }

    function field_data(){
        $result = $this->db->field_data($this->table_name);
        return $result;
    }
}

?>