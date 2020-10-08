<?php 

class Modeldepartamentos extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('*');
        $this->db->from('departamentos');

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('departamentos',array(
            'nombre'=>$data['nombre'],
            'codigo'=>$data['codigo']
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('departamentos',array(
            'nombre'=>$data['nombre']
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function edit($id){

        $this->db->select('*');
        $this->db->from('departamentos');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function findbyCodigo($codigo){

        $this->db->select('*');
        $this->db->from('departamentos');
        $this->db->where('codigo',$codigo);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}