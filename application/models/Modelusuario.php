<?php 

class Modelusuario extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function getValidate($usuario){
            
        $this->db->select('u.id,u.nombre,u.usuario,u.password,u.estado,u.idrol,r.nombre as nomrol');
        $this->db->from('usuarios as u');
        $this->db->join('roles as r', 'u.idrol = r.id', 'left');
        $this->db->where('u.usuario',$usuario);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }    

    function search($args=array()){
            
        $this->db->select('u.*,r.nombre as namerol');
        $this->db->from('usuarios as u');
        $this->db->join('roles as r', 'u.idrol = r.id', 'left');

        if($this->session->userdata('nomrol') !='admin'){
            $this->db->where('u.usuc',$this->session->userdata('username'));
        }

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('usuarios',array(
            'nombre'=>$data['nombre'],
            'password'=>$data['password'],
            'usuario'=>$data['usuario'],
            'idrol'=>$data['idrol'],
            'estado'=>$data['estado'],
            'usuc'=>$this->session->userdata('username'),
            'fecc'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function saveRegistro($data){
        $this->db->insert('usuarios',array(
            'nombre'=>$data['nombre'],
            'password'=>$data['password'],
            'usuario'=>$data['usuario'],
            'idrol'=>$data['idrol'],
            'estado'=>$data['estado']
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('usuarios',array(
            'nombre'=>$data['nombre'],
            'idrol'=>$data['idrol'],
            'estado'=>$data['estado'],
            'usum'=>$this->session->userdata('username'),
            'fecm'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }
    function updatepass($data){
        $this->db->where('id',$data['id']);
        $this->db->update('usuarios',array(
            'password'=>$data['password'],
            'usum'=>$this->session->userdata('username'),
            'fecm'=>date('Y-m-d H:i:s')
        ));
 
        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function updatenombre($data){
        $this->db->where('id',$data['id']);
        $this->db->update('usuarios',array(
            'nombre'=>$data['nombre'],
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
        $this->db->from('usuarios');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}