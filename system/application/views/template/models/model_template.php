{php_open}

class {model_name}_model extends Model{
   
    var $table_name = '{table_name}';

    function {model_name}_model(){
        parent::Model();
    }

    function insert(${table_name}){
        $this->db->insert($this->table_name, ${table_name});
    }

    function update($id, ${table_name}){
        $this->db->where('{primary_key}', $id);
        $this->db->update($this->table_name, ${table_name});
    }

    function delete($id){
        $this->db->where('{primary_key}', $id);
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
        $this->db->where('{primary_key}', $id);
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

{php_close}