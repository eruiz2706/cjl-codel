<?php 

class Modelpermisosxrol extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select('*');
        $this->db->from('permisosxrol');

        if(isset($args['idrol']))$this->db->where('idrol',$args['idrol']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 

    function permisos($args=array()){
            
        $this->db->select("p.id as idpermi,m.padre as padre,m.nombre as nombre,(case when p.acceso=true then 'checked' else '' end) as acceso");
        $this->db->from('permisosxrol as p');
        $this->db->join('modulos as m', 'p.idmodulo = m.id');
        $this->db->where('p.idrol',$args['idrol']);
        $this->db->order_by("orden", "desc");

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;


        $this->db->select('*');
        $this->db->from('permisosxrol');

        if(isset($args['idrol']))$this->db->where('idrol',$args['idrol']);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 
    
    function save($data){
        $this->db->insert('permisosxrol',array(
            'idrol'=>$data['idrol'],
            'idmodulo'=>$data['idmodulo'],
            'acceso'=>$data['acceso'],
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
        
        if(isset($data['id']))$this->db->where('id',$data['id']);
        if(isset($data['idrol']))$this->db->where('idrol',$data['idrol']);
        
        $this->db->update('permisosxrol',array(
            'acceso'=>$data['acceso'],
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
        $this->db->from('permisosxrol');
        $this->db->where('id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    function finbymolRol($data){

        $this->db->select("m.id,m.nombre,m.padre,(case when p.acceso=true then 'checked' else '' end) as acceso");
        $this->db->from('modulos as m');
        $this->db->join('permisosxrol as p',"m.id=p.idmodulo and p.idrol=".$data['idrol'], 'left');
        if(isset($data['padre']))$this->db->where('m.padre',0);
        if(isset($data['nopadre']))$this->db->where('m.padre<>0');

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    function findbyaccesourl($url=''){
        $this->db->select("m.url");
        $this->db->from('permisosxrol as p');
        $this->db->join('modulos as m',"p.idmodulo=m.id", 'left');
        $this->db->where('idrol',$this->session->userdata('idrol'));
        $this->db->where('m.url',$url);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    function deleteByidrol($idrol){
        $this->db->where('idrol', $idrol);
        $this->db->delete('permisosxrol'); 
    }
}