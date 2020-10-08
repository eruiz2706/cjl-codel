<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Puestovotacion extends CI_Controller {

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
	   
        $this->load->model('modeldepartamentos');
        $this->load->model('modelmunicipios');
        $this->load->model('modelpuestovotacion');
    }

	public function index()
	{

        $resultado	=$this->modelpuestovotacion->search(array());
        $data['resultado']=$resultado;

        $resultado2	=$this->modeldepartamentos->search(array());
        $data['departamen']=$resultado2;

        $resultado3	=$this->modelmunicipios->search(array());
        $data['municipio']=$resultado3;
        
        $this->load->view('puestovotacion/index',$data);
   }

    public function save(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('iddepartamento', 'departamento', 'required');
            $this->form_validation->set_rules('idmunicipio', 'municipio', 'required');
            $this->form_validation->set_rules('puesto', 'puesto', 'required');
            $this->form_validation->set_rules('direccion', 'direccion', 'required');
            $this->form_validation->set_rules('estpersona', 'estimado de personas', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $direccion      =trim($this->input->post('direccion'));
                $puesto         =trim($this->input->post('puesto'));
                $iddepartamento =trim($this->input->post('iddepartamento'));
                $idmunicipio    =trim($this->input->post('idmunicipio'));
                $estpersona     =trim($this->input->post('estpersona'));

                if($this->modelpuestovotacion->findbyCodigo($puesto)){
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un registro con el codigo agregado'));
                    $data['errormsj']=$this->alerterror->error(); 
                }else{
                    $columns    =array(
                        'idmunicipio'=>$idmunicipio,
                        'puesto'=>$puesto,
                        'direccion'=>$direccion,
                        'estpersona'=>$estpersona
                        
                    );
                    $columns   =$this->security->xss_clean($columns);
                    $insert    =$this->modelpuestovotacion->save($columns);

                    if($insert !=null){
                        $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                        $data['successmsj']=$this->alerterror->error();
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar crear el registro'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }
            }else{
                $errors="";
                if(form_error('iddepartamento') !='')$errors .=form_error('iddepartamento');
                if(form_error('idmunicipio') !='')$errors .=form_error('idmunicipio');
                if(form_error('puesto') !='')$errors .=form_error('puesto');
                if(form_error('direccion') !='')$errors .=form_error('direccion');
                if(form_error('estpersona') !='')$errors .=form_error('estpersona');
              
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
        $resultado	=$this->modelpuestovotacion->edit($id);
        echo json_encode($resultado);
       
    }

    public function update(){
        $data=array();
        if($this->input->post()){
            $this->form_validation->set_rules('iddepartamento', 'departamento', 'required');
            $this->form_validation->set_rules('idmunicipio', 'municipio', 'required');
            $this->form_validation->set_rules('puesto', 'puesto', 'required');
            $this->form_validation->set_rules('direccion', 'direccion', 'required');
            $this->form_validation->set_rules('estpersona', 'estimado de personas', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $id             =trim($this->input->post('id'));
                $iddepartamento =trim($this->input->post('iddepartamento'));
                $idmunicipio    =trim($this->input->post('idmunicipio'));
                $puesto         =trim($this->input->post('puesto'));
                $direccion      =trim($this->input->post('direccion'));
                $estpersona     =trim($this->input->post('estpersona'));
            
                $columns    =array(
                    'id'=>$id,
                    'iddepartamento'=>$iddepartamento,
                    'idmunicipio'=>$idmunicipio,
                    'puesto'=>$puesto,
                    'direccion'=>$direccion,
                    'estpersona'=>$estpersona
                );
                $columns    =$this->security->xss_clean($columns);
                $idupdate   =$this->modelpuestovotacion->update($columns);

                if($idupdate !=null){
                    $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                    $data['successmsj']=$this->alerterror->error();
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                    $data['errormsj']=$this->alerterror->error();
                }
            }else{
                $errors="";
                if(form_error('iddepartamento') !='')$errors .=form_error('iddepartamento');
                if(form_error('idmunicipio') !='')$errors .=form_error('idmunicipio');
                if(form_error('puesto') !='')$errors .=form_error('puesto');
                if(form_error('direccion') !='')$errors .=form_error('direccion');
                if(form_error('estpersona') !='')$errors .=form_error('estpersona');
              
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }

        }else{
            show_404();
        }

        echo json_encode($data);
    }

    public function getdepartamentos(){
        $iddepartamento =$this->uri->segment(3);
        $resultado	=$this->modelmunicipios->search(array('iddepartamento'=>$iddepartamento));
        echo json_encode($resultado);
       
    }

}
