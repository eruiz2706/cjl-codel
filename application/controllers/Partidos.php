<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Partidos extends CI_Controller {

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
	   
        $this->load->model('modelpartidos');
    }

	public function index()
	{

        $resultado	=$this->modelpartidos->search(array());
        $data['resultado']=$resultado;
        
        $this->load->view('partidos/index',$data);
    }

    public function save(){
        $data=array();

        if($this->input->post()){
            $nombre =trim($this->input->post('nombre'));
            $codigo =trim($this->input->post('codigo'));

            if(!($nombre =='' || $codigo  == '' )){
                if($this->modelpartidos->findbyCodigo($codigo)){
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un registro con el codigo agregado'));
                    $data['errormsj']=$this->alerterror->error();    
                }else{
                    $columns    =array(
                        'nombre'=>$nombre,
                        'codigo'=>$codigo
                    );
                    $columns   =$this->security->xss_clean($columns);
                    $insert    =$this->modelpartidos->save($columns);
    
                    if($insert !=null){
                        $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                        $data['successmsj']=$this->alerterror->error();
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar crear el registro'));
                        $data['errormsj']=$this->alerterror->error();
                    }
                }
            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe agregar los campos requeridos'));
                $data['errormsj']=$this->alerterror->error();
            }
        }

        echo json_encode($data);
    }

    public function edit(){
        $id =$this->uri->segment(3);
        $resultado	=$this->modelpartidos->edit($id);
        echo json_encode($resultado);
       
    }

    public function update(){
        $data=array();
       
        if($this->input->post('nombre') !='' || $this->input->post('codigo') !=''){
            $columns    =array(
                'id'=>$this->input->post('id'),
                'nombre'=>$this->input->post('nombre')
            );
            $columns    =$this->security->xss_clean($columns);
            $idupdate   =$this->modelpartidos->update($columns);

            if($idupdate !=null){
                $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                $data['successmsj']=$this->alerterror->error();
            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar actualizar el registro'));
                $data['errormsj']=$this->alerterror->error();
            }
        }else{
            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Debe agregar los campos requeridos'));
            $data['errormsj']=$this->alerterror->error();
        }

        echo json_encode($data);
    }

}
