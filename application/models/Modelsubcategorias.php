<?php 

class Modelsubcategorias extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('s.id as id,s.nombre as nombre,c.nombre as nomcatego');
        $this->db->from('subcategorias as s');
        $this->db->join('categorias as c', 's.idcategorias = c.id');

        if(isset($args['idcategorias'])) $this->db->where('s.idcategorias',$args['idcategorias']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('subcategorias',array(
            'nombre'=>$data['nombre'],
            'idcategorias'=>$data['idcategorias'],
            'usuc'=>$this->session->userdata('username'),
            'fecc'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('subcategorias',array(
            'nombre'=>$data['nombre'],
            'idcategorias'=>$data['idcategorias'],
            'usum'=>$this->session->userdata('username'),
            'fecm'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function edit($id){

        $this->db->select('s.id as id,s.nombre as nombre,s.idcategorias as idcatego');
        $this->db->from('subcategorias as s');
        $this->db->join('categorias as c', 's.idcategorias = c.id');
        $this->db->where('s.id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function findbyNombre($nombre){

        $this->db->select('*');
        $this->db->from('subcategorias');
        $this->db->where('nombre',$nombre);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}