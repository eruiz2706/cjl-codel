<?php 

class Modelpuestovotacion extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('p.*,d.nombre as departa,m.nombre as municip');
        $this->db->from('puestovotacion as p');
        $this->db->join('municipios as m', 'p.idmunicipio = m.id','left');
        $this->db->join('departamentos as d', 'm.iddepartamento = d.id','left');
        //if(isset($args['iddepartamento'])) $this->db->where('iddepartamento',$args['iddepartamento']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('puestovotacion',array(
            'idmunicipio'=>$data['idmunicipio'],
            'puesto'=>$data['puesto'],
            'direccion'=>$data['direccion'],
            'estpersona'=>$data['estpersona']
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('puestovotacion',array(
            'idmunicipio'=>$data['idmunicipio'],
            'puesto'=>$data['puesto'],
            'direccion'=>$data['direccion'],
            'estpersona'=>$data['estpersona']
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function edit($id){

        $this->db->select('p.*,m.iddepartamento');
        $this->db->from('puestovotacion as p');
        $this->db->join('municipios as m', 'p.idmunicipio = m.id','left');
        $this->db->where('p.id',$id);

        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function findbyCodigo($codigo){

        $this->db->select('*');
        $this->db->from('puestovotacion');
        $this->db->where('puesto',$codigo);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}