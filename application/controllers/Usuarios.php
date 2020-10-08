<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Usuarios extends CI_Controller {

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
        $this->load->model('modelroles');
        $this->load->model('modelpermisosxrol');
    }

	public function index()
	{

        $resultado	=$this->modelusuario->search(array());
        $data['resultado']=$resultado;

        $resultado2	=$this->modelroles->search(array());
        $data['resultado2']=$resultado2;

        $this->load->view('usuarios/index',$data);
    }

    public function save(){
       
    }

    public function edit(){
        $id =$this->uri->segment(3);
        $resultado	=$this->modelusuario->edit($id);
        echo json_encode($resultado);

    }


   public function update(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('nombre', 'nombre usuario', 'required');
            $this->form_validation->set_rules('idrol', 'rol', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $id         =trim($this->input->post('id'));
                $nombre     =trim($this->input->post('nombre'));
                $password   =trim($this->input->post('password'));
                $repassword =trim($this->input->post('repassword'));
                $idrol      =trim($this->input->post('idrol'));
                $estado     =trim($this->input->post('estado'));

                if(!($password =='')){
                    if($password == $repassword){
                        $columns    =array(
                            'id'=>$id,
                            'nombre'=>$nombre,
                            'idrol'=>$idrol,
                            'estado'=>$estado
                        );
                        $columns    =$this->security->xss_clean($columns);
                        $idupdate   =$this->modelusuario->update($columns);
                        
                        if($idupdate !=null){
                            $this->modelusuario->updatepass(array(
                                'id'=>$id,
                                'password'=>$this->encryption->encrypt($password)
                            ));

                            $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                            $data['successmsj']=$this->alerterror->error();
                        }else{
                            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                            $data['errormsj']=$this->alerterror->error();
                        }
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Password y Repassword deben ser iguales'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }else{
                    $columns    =array(
                        'id'=>$id,
                        'nombre'=>$nombre,
                        'idrol'=>$idrol,
                        'estado'=>$estado
                    );
                    $idupdate   =$this->modelusuario->update($columns);
                    
                    if($idupdate !=null){
                        $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                        $data['successmsj']=$this->alerterror->error();
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }

            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('idrol') !='')$errors .=form_error('idrol');
              
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }
        }else{
            show_404();
        }  

        echo json_encode($data);
    }

}
