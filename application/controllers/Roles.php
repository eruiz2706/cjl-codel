<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Roles extends CI_Controller {

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
       
        $this->load->model('modelroles');
        $this->load->model('modelmodulos');
        $this->load->model('modelpermisosxrol');

    }

	public function index()
	{

        $resultado	=$this->modelroles->search(array());
        $data['resultado']=$resultado;
        
        $this->load->view('roles/index',$data);
    }


    public function save(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('alias', 'alias', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $nombre =trim($this->input->post('nombre'));
                $alias  =trim($this->input->post('alias'));
                
                
                if($this->modelroles->getNombre($nombre)){
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un registro con el nombre agregado'));
                    $data['errormsj']=$this->alerterror->error();    
                }else{
                    $columns=array(
                        'nombre'=>$nombre,
                        'alias'=>$alias
                    );
                    $columns    =$this->security->xss_clean($columns);
                    $idinsert=$this->modelroles->save($columns);

                    if($idinsert !=null){
                        $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                        $data['successmsj']=$this->alerterror->error();
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar crear el registro'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }
            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('alias') !='')$errors .=form_error('alias');
              
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }
        }else{
            show_404();
        }
        

        echo json_encode($data);
    }

    public function edit(){
        $id =$this->uri->segment(3);
        $resultado	=$this->modelroles->edit($id);
        echo json_encode($resultado);
       
    }

    public function update(){
        $data=array();
       
        if($this->input->post()){
            $this->form_validation->set_rules('alias', 'alias', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $id     =trim($this->input->post('id'));
                $alias  =trim($this->input->post('alias'));
    
                
                $columns=array(
                    'id'=>$id,
                    'alias'=>$alias
                );
                $columns    =$this->security->xss_clean($columns);
                $idupdate   =$this->modelroles->update($columns);
    
                if($idupdate !=null){
                    $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                    $data['successmsj']=$this->alerterror->error();
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                    $data['errormsj']=$this->alerterror->error();
                }
                
            }else{
                $errors="";
                if(form_error('alias') !='')$errors .=form_error('alias');
              
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
