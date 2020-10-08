<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Personas extends CI_Controller {

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

		
        $this->load->library('encryption');
        $this->load->model('modelpersonas');
        $this->load->model('modeldepartamentos');
        $this->load->model('modelmunicipios');

        $this->load->model('modelcategorias');
        $this->load->model('modelsubcategorias');
        $this->load->model('modelusuario');
        $this->load->model('modelroles');
        
    }

	public function index()
	{

        $rescatego	=$this->modelcategorias->search(array());
        $data['rescatego']=$rescatego;

        $ressubcatego	=$this->modelsubcategorias->search(array());
        $data['ressubcatego']=$ressubcatego;

        $resdepart	=$this->modeldepartamentos->search(array());
        $data['resdepart']=$resdepart;

        $resmunicip	=$this->modelmunicipios->search(array());
        $data['resmunicip']=$resmunicip;

        $resultado	=$this->modelpersonas->search(array());
        $data['resultado']=$resultado;

        $this->load->view('personas/index',$data);
    }

    public function save(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('documento', 'documento', 'required');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('apellido', 'apellido', 'required');
            $this->form_validation->set_rules('celular', 'celular', 'required');
           // $this->form_validation->set_rules('genero', 'genero', 'required');
            //$this->form_validation->set_rules('barriodomicilio', 'barrio domicilio', 'required');
            /*$this->form_validation->set_rules('dirdomicilio', 'direccion domicilio', 'required');
            $this->form_validation->set_rules('correo', 'correo', 'required');*/
            $this->form_validation->set_rules('idsubcatego', 'subcategoria', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $documento      =trim($this->input->post('documento'));
                $nombre         =trim($this->input->post('nombre'));
                $apellido       =trim($this->input->post('apellido'));
                $idmunicipio    =trim($this->input->post('idmunicipio'));
                $celular        =trim($this->input->post('celular'));
                $fijo           =trim($this->input->post('fijo'));
                $genero         =trim($this->input->post('genero'));
                $dirdomicilio   =trim($this->input->post('dirdomicilio'));
                $barriodomicilio=trim($this->input->post('barriodomicilio'));
                $correo         =trim($this->input->post('correo'));
                $idsubcatego    =trim($this->input->post('idsubcatego'));
                $cuotaper       =trim($this->input->post('cuotaper'));
                if($cuotaper=='')$cuotaper=0;

                $testigo        =trim($this->input->post('testigo'));
                $docc           =trim($this->input->post('docc'));
                $departamen     =trim($this->input->post('departamen'));
                $municipio      =trim($this->input->post('municipio'));
                $dirpuesto      =trim($this->input->post('dirpuesto'));
                $mesa           =trim($this->input->post('mesa'));
                $puesto         =trim($this->input->post('puesto'));
                $testigo        =($testigo=='A') ? 'true' : 'false';
                
                $idpuestovot    =trim($this->input->post('idpuestovot'));
                if($idpuestovot=='')$idpuestovot=0;

                if(!($mesa=='')){

                    if($documento != $docc){
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'No puede cambiar el documento, una vez generada la informacion de votacion'));
                        $data['errormsj']=$this->alerterror->error();
                    }else{

                        if($this->modelpersonas->findbyDocumento($documento)){
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un registro con el documento agregado'));
                            $data['errormsj']=$this->alerterror->error();    
                        }else{
                            $columns    =array(
                                'documento'=>$documento,
                                'nombre'=>$nombre,
                                'apellido'=>$apellido,
                                'celular'=>$celular,
                                'fijo'=>$fijo,
                                'correo'=>$correo,
                                'barriodomicilio'=>$barriodomicilio,
                                'idmunicipio'=>$idmunicipio,
                                'dirdomicilio'=>$dirdomicilio,
                                'idsubcatego'=>$idsubcatego,
                                'genero'=>$genero,
                                'cuotaper'=>$cuotaper,
                                'departamen'=>$departamen,
                                'municipio'=>$municipio,
                                'puesto'=>$puesto,
                                'dirpuesto'=>$dirpuesto,
                                'mesa'=>$mesa,
                                'testigo'=>$testigo,
                                'idpuestovot'=>$idpuestovot
                            );
                            $columns    =$this->security->xss_clean($columns);
                            $idinsert   =$this->modelpersonas->save($columns);
                            if($idinsert !=null){
                                $this->load->library('encrypt');
                                $roles  =$this->modelroles->getNombre('personas');
                                $idrol    =($roles->id=='') ? null : $roles->id;
        
                                $columns    =array(
                                    'nombre'=>trim($nombre." ".$apellido),
                                    'password'=>$this->encryption->encrypt($documento),
                                    'usuario'=>$documento,
                                    'idrol'=>$idrol,
                                    'estado'=>true
                                );
                                $columns    =$this->security->xss_clean($columns);
                                $this->modelusuario->save($columns);

                                $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                                $data['successmsj']=$this->alerterror->error();
                            }else{
                                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar crear el registro'));
                                $data['errormsj']=$this->alerterror->error();
                            }

                            
                        }
                    }

                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe agregar la informacion de votacion'));
                    $data['errormsj']=$this->alerterror->error();
                }
            }else{
                $errors="";
                if(form_error('documento') !='')$errors .=form_error('documento');
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('apellido') !='')$errors .=form_error('apellido');
                if(form_error('celular') !='')$errors .=form_error('celular');
                //if(form_error('genero') !='')$errors .=form_error('genero');
                //if(form_error('dirdomicilio') !='')$errors .=form_error('dirdomicilio');
                //if(form_error('barriodomicilio') !='')$errors .=form_error('barriodomicilio');
                //if(form_error('correo') !='')$errors .=form_error('correo');
                if(form_error('idsubcatego') !='')$errors .=form_error('idsubcatego');
              
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
        $resultado	=$this->modelpersonas->edit($id);
        echo json_encode($resultado);

    }


   public function update(){
        $data=array();

     if($this->input->post()){

            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('apellido', 'apellido', 'required');
            $this->form_validation->set_rules('celular', 'celular', 'required');
            //$this->form_validation->set_rules('genero', 'genero', 'required');
            //$this->form_validation->set_rules('barriodomicilio', 'barrio domicilio', 'required');
            $this->form_validation->set_rules('idsubcatego', 'subcategoria', 'required');
            /*$this->form_validation->set_rules('dirdomicilio', 'direccion domicilio', 'required');
            $this->form_validation->set_rules('correo', 'correo', 'required');*/
            
            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $id             =trim($this->input->post('id'));
                $documento      =trim($this->input->post('documento'));
                $nombre         =trim($this->input->post('nombre'));
                $apellido       =trim($this->input->post('apellido'));
                $idmunicipio    =trim($this->input->post('idmunicipio'));
                $celular        =trim($this->input->post('celular'));
                $fijo           =trim($this->input->post('fijo'));
                $genero         =trim($this->input->post('genero'));
                $dirdomicilio   =trim($this->input->post('dirdomicilio'));
                $barriodomicilio=trim($this->input->post('barriodomicilio'));
                $correo         =trim($this->input->post('correo'));
                $idsubcatego    =trim($this->input->post('idsubcatego'));
                $testigo        =trim($this->input->post('testigo'));
                $docc           =trim($this->input->post('docc'));
                $departamen     =trim($this->input->post('departamen'));
                $municipio      =trim($this->input->post('municipio'));
                $dirpuesto      =trim($this->input->post('dirpuesto'));
                $mesa           =trim($this->input->post('mesa'));
                $puesto         =trim($this->input->post('puesto'));
                
                $cuotaper       =trim($this->input->post('cuotaper'));
                if($cuotaper=='')$cuotaper=0;

                $testigo        =($testigo=='A') ? '1' : '0';
                $idpuestovot    =trim($this->input->post('idpuestovot'));
                if($idpuestovot=='')$idpuestovot=0;

                if(!($mesa=='')){

                    if($documento != $docc){
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'No puede cambiar el documento, una vez generada la informacion de votacion'));
                        $data['errormsj']=$this->alerterror->error();
                    }else{
                        $columns    =array(
                            'id'=>$id,
                            'nombre'=>$nombre,
                            'apellido'=>$apellido,
                            'celular'=>$celular,
                            'fijo'=>$fijo,
                            'correo'=>$correo,
                            'idsubcatego'=>$idsubcatego,
                            'idmunicipio'=>$idmunicipio,
                            'dirdomicilio'=>$dirdomicilio,
                            'barriodomicilio'=>$barriodomicilio,
                            'genero'=>$genero,
                            'departamen'=>$departamen,
                            'municipio'=>$municipio,
                            'puesto'=>$puesto,
                            'dirpuesto'=>$dirpuesto,
                            'mesa'=>$mesa,
                            'testigo'=>$testigo,
                            'idpuestovot'=>$idpuestovot,
                            'cuotaper'=>$cuotaper,
                        );
                        $columns    =$this->security->xss_clean($columns);
                        $idupdate   =$this->modelpersonas->update($columns);
    
                        if($idupdate !=null){
                            $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                            $data['successmsj']=$this->alerterror->error();
                        }else{
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                            $data['errormsj']=$this->alerterror->error();
                        }
                    }  
    
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe agregar la informacion de votacion'));
                    $data['errormsj']=$this->alerterror->error();
                }
            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('apellido') !='')$errors .=form_error('apellido');
                if(form_error('celular') !='')$errors .=form_error('celular');
                //if(form_error('genero') !='')$errors .=form_error('genero');
                //if(form_error('dirdomicilio') !='')$errors .=form_error('dirdomicilio');
                //if(form_error('barriodomicilio') !='')$errors .=form_error('barriodomicilio');
                if(form_error('idsubcatego') !='')$errors .=form_error('idsubcatego');
                //if(form_error('correo') !='')$errors .=form_error('correo');
                
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }

        }else{
            show_404();
        }

        echo json_encode($data);
    }

    public function getCenso(){
        $documento =$this->uri->segment(3);
        
        $this->load->library('Censo',array('cedula'=>$documento));
        $datosconsulta=$this->censo->consultar();

        echo json_encode($datosconsulta);
    }

    public function getdepartamentos(){
        $iddepartamento =$this->uri->segment(3);
        $resultado	=$this->modelmunicipios->search(array('iddepartamento'=>$iddepartamento));
        echo json_encode($resultado);
       
    }

    public function getdecatego(){
        $idcategorias =$this->uri->segment(3);
        $resultado	=$this->modelsubcategorias->search(array('idcategorias'=>$idcategorias));
        echo json_encode($resultado);
       
    }

    public function findBydocumento(){
        $documento =$this->uri->segment(3);
        $resultado	=$this->modelpersonas->findbyDocumento($documento);
        echo json_encode($resultado);
    }

}
