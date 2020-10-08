<?php 

class Modelpersonas extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function search($args=array()){
            
        $this->db->select("p.id,p.documento,p.nombre,p.apellido,p.celular,p.fijo,p.cuotaper,
                        p.correo,(case when p.genero='M' then 'Hombre' else 'Mujer' end ) as genero,
                        d.nombre as nomdep,m.nombre as nommunic,p.dirdomicilio,p.departamen,p.municipio,
                        p.puesto,p.dirpuesto,p.mesa,sb.nombre as nomsubcat,ca.nombre as nomcat,p.usuc,
                        (case when p.testigo=true then 'SI' else 'NO' end ) as testigo,p.idpuestovot");
        $this->db->from('personas p');
        $this->db->join('municipios as m', 'p.idmunicipio = m.id','left');
        $this->db->join('departamentos as d', 'm.iddepartamento = d.id','left');
        $this->db->join('subcategorias as sb', 'p.idsubcatego=sb.id','left');
        $this->db->join('categorias as ca', 'sb.idcategorias=ca.id','left');

        if($this->session->userdata('nomrol') !='admin'){
            $this->db->where('p.usuc',$this->session->userdata('username'));
        }
        $this->db->order_by("p.puesto", "asc");

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    } 

    function edit($id){

        $this->db->select("p.id,p.documento,p.nombre,p.apellido,p.celular,p.fijo,p.cuotaper,
                        p.correo,p.genero,p.barriodomicilio,p.testigo,
                        d.id as iddepart,p.idmunicipio as idmunic,d.nombre as nomdep,m.nombre as nommunic,p.dirdomicilio,
                        p.departamen,p.municipio,p.puesto,p.dirpuesto,p.mesa,sb.id as idsubcat,sb.nombre as nomsubcat,
                        ca.id as idcatego,ca.nombre as nomcat,p.usuc,p.idpuestovot");
        $this->db->from('personas p');
        $this->db->join('municipios as m', 'p.idmunicipio = m.id','left');
        $this->db->join('departamentos as d', 'm.iddepartamento = d.id','left');
        $this->db->join('subcategorias as sb', 'p.idsubcatego=sb.id','left');
        $this->db->join('categorias as ca', 'sb.idcategorias=ca.id','left');
        $this->db->where('p.id',$id);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }
    
    function save($data){
        $this->db->insert('personas',array(
            'documento'=>$data['documento'],
            'nombre'=>$data['nombre'],
            'apellido'=>$data['apellido'],
            'celular'=>$data['celular'],
            'fijo'=>$data['fijo'],
            'correo'=>$data['correo'],
            'barriodomicilio'=>$data['barriodomicilio'],
            'idmunicipio'=>$data['idmunicipio'],
            'dirdomicilio'=>$data['dirdomicilio'],
            'idsubcatego'=>$data['idsubcatego'],
            'genero'=>$data['genero'],
            'cuotaper'=>$data['cuotaper'],
            'departamen'=>$data['departamen'],
            'municipio'=>$data['municipio'],
            'puesto'=>$data['puesto'],
            'dirpuesto'=>$data['dirpuesto'],
            'mesa'=>$data['mesa'],
            'testigo'=>$data['testigo'],
            'idpuestovot'=>$data['idpuestovot'],
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
        $this->db->insert('personas',array(
            'documento'=>$data['documento'],
            'nombre'=>$data['nombre'],
            'apellido'=>$data['apellido'],
            'celular'=>$data['celular'],
            'fijo'=>$data['fijo'],
            'correo'=>$data['correo'],
            'barriodomicilio'=>$data['barriodomicilio'],
            'idmunicipio'=>$data['idmunicipio'],
            'dirdomicilio'=>$data['dirdomicilio'],
            'genero'=>$data['genero']
        ));

        if($this->db->affected_rows()>0){
            return  $this->db->insert_id();
        }else{
            return  null;
        }
    }

    function update($data){
        $this->db->where('id',$data['id']);
        $this->db->update('personas',array(
            'nombre'=>$data['nombre'],
            'apellido'=>$data['apellido'],
            'celular'=>$data['celular'],
            'fijo'=>$data['fijo'],
            'correo'=>$data['correo'],
            'idmunicipio'=>$data['idmunicipio'],
            'dirdomicilio'=>$data['dirdomicilio'],
            'barriodomicilio'=>$data['barriodomicilio'],
            'genero'=>$data['genero'],
            'departamen'=>$data['departamen'],
            'municipio'=>$data['municipio'],
            'puesto'=>$data['puesto'],
            'dirpuesto'=>$data['dirpuesto'],
            'mesa'=>$data['mesa'],
            'testigo'=>$data['testigo'],
            'idpuestovot'=>$data['idpuestovot'],
            'idsubcatego'=>$data['idsubcatego'],
            'cuotaper'=>$data['cuotaper'],
            'usum'=>$this->session->userdata('username'),
            'fecm'=>date('Y-m-d H:i:s')
        ));

        if($this->db->affected_rows()>0){
            return  $data['id'];
        }else{
            return  null;
        }
    }

    function findbyDocumento($documento){

        $this->db->select('*');
        $this->db->from('personas');
        $this->db->where('documento',$documento);
        
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}