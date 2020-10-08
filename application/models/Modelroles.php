<?php 

class Modelroles extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('*');
        $this->db->from('roles');
        if(isset($args['nombre']))$this->db->where('nombre',$args['nombre']);
        

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 

    function save($data){
        $this->db->insert('roles',array(
            'nombre'=>$data['nombre'],
            'alias'=>$data['alias'],
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
        $this->db->update('roles',array(
            'alias'=>$data['alias'],
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

        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function getNombre($nombre){

        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('nombre',$nombre);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}