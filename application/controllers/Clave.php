<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Clave extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
        parent::__Construct();
	   
        $this->load->library('session');
        $this->load->library('encryption');
        $this->load->model('modelusuario');
    }

	public function index()
	{
        $data=array();

        $resultado	=$this->modelusuario->edit($this->session->userdata('idusu'));
        $data['username']   =$resultado->usuario;
        $data['nombre']   =$resultado->nombre;

        $this->load->view('clave/index',$data);
    }

    public function update(){
        $data=array();
       
        if($this->input->post()){
            $this->form_validation->set_rules('nombre', 'nombre', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $nombre     =trim($this->input->post('nombre'));
                $password   =trim($this->input->post('password'));
                $repassword =trim($this->input->post('repassword'));

                if(!($password =='')){
                    if($password == $repassword){
                            $this->modelusuario->updatenombre(array(
                                'id'=>$this->session->userdata('idusu'),
                                'nombre'=>$nombre
                            ));

                            $this->modelusuario->updatepass(array(
                                'id'=>$this->session->userdata('idusu'),
                                'password'=>$this->encryption->encrypt($password)
                            ));

                            $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                            $data['successmsj']=$this->alerterror->error();
                        
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Password y Repassword deben ser iguales'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }else{
                    $this->modelusuario->updatenombre(array(
                        'id'=>$this->session->userdata('idusu'),
                        'nombre'=>$nombre
                    ));

                    $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                    $data['successmsj']=$this->alerterror->error();
                }
    
            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
              
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }

        }else{
            show_404();
        }

        echo json_encode($data);
    }

    function permisos(){
        $id             =$this->uri->segment(3);
        $rol	        =$this->modelroles->edit($id);
        $permisos	    =$this->modelpermisosxrol->finbymolRol(array('idrol'=>$id,'padre'=>''));
        $subpermisos	=$this->modelpermisosxrol->finbymolRol(array('idrol'=>$id,'nopadre'=>''));
        
        $data['rol']     =$rol;
        $data['permimod']=$permisos;
        $data['subpermisos']=$subpermisos;

        $this->load->view('roles/permisos',$data);
    }

    function savepermi(){
        $id     =$this->input->post('id');
        
        $this->modelpermisosxrol->deleteByidrol($id);
        $subpermisos	=$this->modelmodulos->search();

        foreach($subpermisos as $subperm){
            
            if($this->input->post('P'.$subperm->id)){
                $this->modelpermisosxrol->save(array(
                    'idrol'=>$id,
                    'idmodulo'=>$subperm->id,
                    'acceso'=>true
                ));
            }
            
        }

        echo json_encode(array());

        //redirect('roles');

    }

}
