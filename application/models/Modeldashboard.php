<?php 

class Modeldashboard extends CI_Model {
    
    function __construct() {
        parent::__Construct();
        
    }
    
    function getalluser(){
        $resulmod = $this->db->query("SELECT * FROM usuarios")->result();

        return $resulmod;
    }

    function sindatosvot(){
        $where="";
        if($this->session->userdata('nomrol') !='admin'){
            $where  .=" and p.usuc='".$this->session->userdata('username')."'";
        }

        $query = $this->db->query("select sum(sindatos) as sindatos,sum(total) as total
                                    from(
                                        select count(id) as sindatos,0 as total
                                        from personas p
                                        where 1=1 and (p.mesa is null or p.mesa='') $where
                                        union
                                        select 0 as sindatos,count(id) as total
                                        from personas p
                                        where 1=1 $where
                                    ) as p
                                ");
        $resultados =$query->row();

        return $resultados;
    }

    function ingvsref(){
        $where="1=1";
        if($this->session->userdata('nomrol') !='admin'){
            $where  .=" and p.usuc='".$this->session->userdata('username')."'";
        }

        $query = $this->db->query("select count(id) as person,sum(cuotaper) as refer
                                    from personas p
                                    where $where");
        $resultados =$query->row();

        return $resultados;
    }

    function ingvsrefcat(){

        $where="1=1";
        if($this->session->userdata('nomrol') !='admin'){
            $where  .=" and p.usuc='".$this->session->userdata('username')."'";
        }

        $query = $this->db->query("select 
                                        nombre,sum(canpers) as canpers,sum(canref) as canref
                                    from(
                                        select 
                                            c.nombre,count(p.id) as canpers,sum(p.cuotaper) as canref
                                        from personas p
                                        left join subcategorias s on(p.idsubcatego=s.id)
                                        left join categorias c on(c.id=s.idcategorias)
                                        where $where
                                        group by c.nombre
                                        union
                                        select 
                                            c.nombre,0 as canpers,0 as canref
                                        from categorias c
                                    ) as c
                                    group by nombre
                                    ");
        $resultados =$query->result();

        return $resultados;
    }

    function personasxdia(){
        
        $where="1=1";
        if($this->session->userdata('nomrol') !='admin'){
            $where  .=" and p.usuc='".$this->session->userdata('username')."'";
        }

        $query = $this->db->query("select
                                        dia,sum(cant) as cant
                                    from(
                                        select
                                            extract(DAY FROM p.fecc) as dia,count(p.id) as cant
                                        from personas p
                                        where $where and extract(MONTH FROM p.fecc)=".date('m')."
                                        group by extract(DAY FROM p.fecc)
                                    ) as p
                                    group by dia
                                    order by dia asc
                                ");
        $resultados =$query->result();

        return $resultados;
        
    }

}