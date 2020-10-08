<?php 

class Modelmodulos extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('*');
        $this->db->from('modulos');

        if(isset($args['url']))$this->db->where('url',$args['url']);
        if(isset($args['urldif']))$this->db->where("url <>",$args['urldif']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function edit($id){

        $this->db->select('*');
        $this->db->from('modulos');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }


}