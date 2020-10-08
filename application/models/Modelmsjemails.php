<?php 

class Modelmsjemails extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('*');
        $this->db->from('msjemails');

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('msjemails',array(
            'para'=>$data['para'],
            'asunto'=>$data['asunto'],
            'mensaje'=>$data['mensaje'],
            'idcatego'=>$data['idcatego'],
            'idsubcatego'=>$data['idsubcatego'],
            'usuc'=>$this->session->userdata('username'),
            'fecc'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function edit($id){

        $this->db->select('*');
        $this->db->from('msjemails');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}