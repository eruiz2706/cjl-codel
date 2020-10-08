<?php 

class Modelmenu extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function getPermit(){
        $idrol  =trim($this->session->userdata('idrol'));
        if($idrol=='')$idrol="-1";
      
      
        $this->db->select("m.id,m.nombre,m.url,m.descripcion,m.icono,m.padre,(case when p.acceso=1 then 'checked' else '' end) as acceso");
        $this->db->from('modulos as m');
        $this->db->join('permisosxrol as p',"m.id=p.idmodulo and p.idrol=".$idrol, 'left');
        $this->db->where('m.padre',0);
        $this->db->where('p.acceso',1);
        $consulta = $this->db->get();
        $resulmod = $consulta->result();

        $this->db->select("m.id,m.nombre,m.url,m.descripcion,m.icono,m.padre,(case when p.acceso=1 then 'checked' else '' end) as acceso");
        $this->db->from('modulos as m');
        $this->db->join('permisosxrol as p',"m.id=p.idmodulo and p.idrol=".$idrol, 'left');
        $this->db->where('m.padre <>0');
        $this->db->where('p.acceso',1);
        $consulta = $this->db->get();
        $resulsub = $consulta->result();

        
        return array($resulmod,$resulsub);
    }    

}