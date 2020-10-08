<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 
class Home
{
    private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        !$this->ci->load->library('session');
        !$this->ci->load->helper('url');
    } 
 
    public function check_login()
    {
        /*si apunta al controlador login no valido la autenticacion*/
        if($this->ci->uri->segment(1)=='login'){  

        } else{

            /*si estoy en otro controlador valido la autenticacion, si esta autenticado lo dejo
            seguir, de lo contrario lo redirecciono al logueo*/
            if(!($this->ci->session->authin==1)){
                redirect('login', 'refresh');

            /*si esta autenticado pero su ruta es error o principal o el dashboard,
            no valido los permisos que el tenga*/
            }else if($this->ci->uri->segment(1)=='errors' || $this->ci->uri->segment(1)==''
            || $this->ci->uri->segment(1)=='principal' || $this->ci->uri->segment(1)=='dashboard' 
            || $this->ci->uri->segment(1)=='clave'){

            }else{
            /*verifico si el rol tiene permiso para acceder a la pantalla solicitadad*/
                $this->ci->load->model('modelpermisosxrol');

                if(!($this->ci->modelpermisosxrol->findbyaccesourl($this->ci->uri->segment(1)))){
                    redirect('errors');
                }
            }
        } 
    }
}

?>