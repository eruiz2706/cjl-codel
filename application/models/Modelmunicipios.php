<?php 

class Modelmunicipios extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('m.*,d.nombre as departa');
        $this->db->from('municipios as m');
        $this->db->join('departamentos as d', 'm.iddepartamento = d.id','left');
        if(isset($args['iddepartamento'])) $this->db->where('iddepartamento',$args['iddepartamento']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('municipios',array(
            'nombre'=>$data['nombre'],
            'codigo'=>$data['codigo'],
            'iddepartamento'=>$data['iddepartamento']
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('municipios',array(
            'nombre'=>$data['nombre'],
            'iddepartamento'=>$data['iddepartamento']
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function edit($id){

        $this->db->select('*');
        $this->db->from('municipios');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function findbyCodigo($codigo){

        $this->db->select('*');
        $this->db->from('municipios');
        $this->db->where('codigo',$codigo);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}