<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Subcategorias extends CI_Controller {

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
	   
		$this->load->model('modelcategorias');
        $this->load->model('modelsubcategorias');
    }

	public function index()
	{

        $resultado	=$this->modelcategorias->search(array());
        $data['rescategorias']=$resultado;

        $resultado	=$this->modelsubcategorias->search(array());
        $data['resultado']=$resultado;
        
        $this->load->view('subcategorias/index',$data);
     }

    public function save(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('categoria', 'categoria', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $nombre     =trim($this->input->post('nombre'));
                $categoria  =trim($this->input->post('categoria'));
    
                if($this->modelsubcategorias->findbyNombre($nombre)){
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Ya existe un registro con el nombre agregado'));
                    $data['errormsj']=$this->alerterror->error(); 
                }else{
                    $columns=array(
                        'nombre'=>$nombre,
                        'idcategorias'=>$categoria
                    );
                    $columns    =$this->security->xss_clean($columns);
                    $idinsert   =$this->modelsubcategorias->save($columns);
    
                    if($idinsert !=null){
                        $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se creo el registro correctamente'));
                        $data['successmsj']=$this->alerterror->error();
                    }else{
                        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Hubo una inconsistencia al intentar creo el registro'));
                        $data['errormsj']=$this->alerterror->error();
                    }                    
                }
            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('categoria') !='')$errors .=form_error('categoria');
              
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
        $resultado	=$this->modelsubcategorias->edit($id);
        echo json_encode($resultado);
       
    }

    public function update(){
        $data=array();

        if($this->input->post()){
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('categoria', 'categoria', 'required');

            if($this->form_validation->run()!=false){ //Si la validación es correcta
                $nombre     =trim($this->input->post('nombre'));
                $categoria  =trim($this->input->post('categoria'));

                $columns    =array(
                    'id'=>$this->input->post('id'),
                    'nombre'=>$nombre,
                    'idcategorias'=>$categoria
                );
                $columns    =$this->security->xss_clean($columns);
                $this->modelsubcategorias->update($columns);
                $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se actualizo el registro correctamente'));
                $data['successmsj']=$this->alerterror->error();
            }else{
                $errors="";
                if(form_error('nombre') !='')$errors .=form_error('nombre');
                if(form_error('categoria') !='')$errors .=form_error('categoria');
              
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>$errors));
                $data['errormsj']=$this->alerterror->error();
            }
        }else{
            show_404();
        }

        echo json_encode($data);
    }


}
