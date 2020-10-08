<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the fo
	 * llowing URL
	 * else{
	 *
	 *}		http://example.com/index.php/welcome
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
        $this->load->model('modelusuario');
        $this->load->model('modelroles');
    }

    public function index()
    {
        $data=array();
        $resdepart	=$this->modeldepartamentos->search(array());
        $data['resdepart']=$resdepart;

        $resmunicip	=$this->modelmunicipios->search(array());
        $data['resmunicip']=$resmunicip;
  
        $this->session->sess_destroy();
		$this->load->view('login/index',$data);
    }
    
    public function getdepart(){
        $iddepartamento =$this->uri->segment(3);
        $resultado	=$this->modelmunicipios->search(array('iddepartamento'=>$iddepartamento));
        echo json_encode($resultado);
       
    }

    /*valida el ingreso de un usuario */
    public function in(){
        if($this->input->post()){
            $recaptcha  =$_POST['g-recaptcha-response'];

            if($recaptcha){
                $captcharesponse    =$this->validaCaptcha($recaptcha);
                if($captcharesponse->success){
                    $data=array();
			        $resusu	=$this->modelusuario->getValidate($this->input->post('cta')); 

			        if($resusu){
				        if($this->input->post('ctacl')==$this->encryption->decrypt($resusu->password)){
					        if($resusu->estado==1){
                                $userdata  =  array ( 
                                    'idusu'  =>  $resusu->id,
                                    'username'  =>  $resusu->usuario, 
                                    'nombreusu' =>  $resusu->nombre, 
                                    'idrol' =>  $resusu->idrol, 
                                    'nomrol' =>  $resusu->nomrol, 
                                    'authin'  	=>  1 
                                ); 
						        $this->session->set_userdata($userdata);
						
						        redirect('principal');
                            }else{  
                                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'El usuario se encuentra inactivo'));
                                $error=$this->alerterror->error();
                                $data['errormsj']=$error;
                            }	
                        }else{
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Usuario o contraseña incorrectos'));
                            $error=$this->alerterror->error();
                            $data['errormsj']=$error;
                        }
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Usuario o contraseña incorrectos'));
                        $error=$this->alerterror->error();
                        $data['errormsj']=$error;
                    }
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Intento de suplantacion de captcha'));
                    $error=$this->alerterror->error();
                    $data['errormsj']=$error;
                }
            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe validar el captcha'));
                $error=$this->alerterror->error();
                $data['errormsj']=$error;
            }

            $this->load->view('login/index',$data);
		}else{
			$this->session->sess_destroy();
			redirect('login');
		}

			
	}

    function user(){
        $data=array();

        if($this->input->post()){
            $recaptcha  =$_POST['g-recaptcha-response'];

            if($recaptcha){
                $captcharesponse    =$this->validaCaptcha($recaptcha);
                if($captcharesponse->success){

                    $this->form_validation->set_rules('documento', 'documento', 'required');
                    $this->form_validation->set_rules('nombre', 'nombre', 'required');
                    $this->form_validation->set_rules('apellido', 'apellido', 'required');
                    $this->form_validation->set_rules('genero', 'genero', 'required');
                    $this->form_validation->set_rules('idmunicipio', 'Municipio', 'required');
                    $this->form_validation->set_rules('celular', 'celular', 'required');
                    $this->form_validation->set_rules('correo', 'correo', 'required');
                    $this->form_validation->set_rules('password', 'password', 'required');
                    $this->form_validation->set_rules('repassword', 're-password', 'required');
                
                    if($this->form_validation->run()!=false){ //Si la validación es correcta
                        $documento      =trim($this->input->post('documento'));
                        $nombre         =trim($this->input->post('nombre'));
                        $apellido       =trim($this->input->post('apellido'));
                        $genero         =trim($this->input->post('genero'));
                        $idmunicipio    =trim($this->input->post('idmunicipio'));
                        $celular        =trim($this->input->post('celular'));
                        $fijo           =trim($this->input->post('fijo'));
                        $dirdomicilio   =trim($this->input->post('dirdomicilio'));
                        $barriodomicilio=trim($this->input->post('barriodomicilio'));
                        $correo         =trim($this->input->post('correo'));
                        $password       =trim($this->input->post('password'));
                        $repassword     =trim($this->input->post('repassword'));

                        if($password != $repassword){
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'El password y re-password deben ser iguales'));
                            $data['errormsj']=$this->alerterror->error(); 
                        }else if($this->modelpersonas->findbyDocumento($documento)){
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un usuario con el documento agregado'));
                            $data['errormsj']=$this->alerterror->error();    
                        }else{
                            $columns    =array(
                                'documento'=>$documento,
                                'nombre'=>$nombre,
                                'apellido'=>$apellido,
                                'genero'=>$genero,
                                'idmunicipio'=>$idmunicipio,
                                'celular'=>$celular,
                                'fijo'=>$fijo,
                                'dirdomicilio'=>$dirdomicilio,
                                'barriodomicilio'=>$barriodomicilio,
                                'correo'=>$correo,
                            );
                            $columns    =$this->security->xss_clean($columns);
                            $idinsert   =$this->modelpersonas->saveRegistro($columns);

                            if($idinsert !=null){
                                $this->load->library('encrypt');
                                $roles  =$this->modelroles->getNombre('personas');
                                $idrol    =($roles->id=='') ? null : $roles->id;
        
                                $columns    =array(
                                    'nombre'=>trim($nombre." ".$apellido),
                                    'password'=>$this->encryption->encrypt($password),
                                    'usuario'=>$documento,
                                    'idrol'=>$idrol,
                                    'estado'=>true
                                );
                                $columns    =$this->security->xss_clean($columns);
                                $this->modelusuario->saveRegistro($columns);

                                $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                                $data['successmsj']=$this->alerterror->error();
                            }else{
                                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar crear el registro'));
                                $data['errormsj']=$this->alerterror->error();
                            }

                            
                        }
                    }else{
                        $errors="";
                        if(form_error('documento') !='')$errors .=form_error('documento');
                        if(form_error('nombre') !='')$errors .=form_error('nombre');
                        if(form_error('apellido') !='')$errors .=form_error('apellido');
                        if(form_error('genero') !='')$errors .=form_error('genero');
                        if(form_error('idmunicipio') !='')$errors .=form_error('idmunicipio');
                        if(form_error('celular') !='')$errors .=form_error('celular');
                        if(form_error('correo') !='')$errors .=form_error('correo');
                        if(form_error('password') !='')$errors .=form_error('password');
                        if(form_error('repassword') !='')$errors .=form_error('repassword');
                        
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Intento de suplantacion de captcha'));
                    $error=$this->alerterror->error();
                    $data['errormsj']=$error;
                }
            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe validar el captcha'));
                $error=$this->alerterror->error();
                $data['errormsj']=$error;
            }

        }else{
            show_404();
        }

        echo json_encode($data);
        
    }
    

    /*valida si el captcha ingresado es valido*/
    function validaCaptcha($recaptcha){
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LfIjkcUAAAAAKvAI4sPdY226WT_52D0LA-s5PZZ',
            'response' => $recaptcha
        );

        $options = array(
            'http' => array (
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        
        return $captcha_success;
    }
}
