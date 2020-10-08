<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Msjemail extends CI_Controller {

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
        $this->load->model('modelmsjemails');
        
    }

	public function index()
	{

        $resultado	=$this->modelmsjemails->search(array());
        $data['resultado']=$resultado;
        
        $this->load->view('msjemail/index',$data);
    }

    public function nuevo(){

        $rescatego	=$this->modelcategorias->search(array());
        $data['rescatego']=$rescatego;

        $ressubcatego	=$this->modelsubcategorias->search(array());
        $data['ressubcatego']=$ressubcatego;

        $this->load->view('msjemail/nuevo',$data);
    }

    function save(){
        if($this->input->post()){
            $idcatego       =trim($this->input->post('idcatego'));
            $idsubcatego    =trim($this->input->post('idsubcatego'));
            $subject        =trim($this->input->post('subject'));
            $mensaje        =trim($this->input->post('mensaje'));

            if(!($idsubcatego=='' || $subject=='' || $mensaje=='')){
                $config=array(
                    'mailfromnane'=>'Colombia Justa Libres',
                    'mailfrom'=>'eruiz2706@gmail.com',
                    'to'=>'eruiz2706@gmail.com',
                    'subject'=>$subject,
                    'html'=>$mensaje,
                    'text'=>''
                );

                $this->load->library('sendmailgun',$config);
                $send=$this->sendmailgun->send();

                if(isset($send['id'])){
                    $columns    =array(
                        'para'=>'eruiz2706@gmail.com',
                        'asunto'=>$subject,
                        'mensaje'=>$mensaje,
                        'idcatego'=>$idcatego,
                        'idsubcatego'=>$idsubcatego
                    );
                    $columns    =$this->security->xss_clean($columns);
                    $this->modelmsjemails->save($columns);


                    $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Correo enviado correctamente'));
                    $data['errormsj']=$this->alerterror->error();
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Error al enviar correo'));
                    $data['errormsj']=$this->alerterror->error();
                }

            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'De agregar los campos requeridos'));
                $data['errormsj']=$this->alerterror->error();
            }

        }else{
            $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'De agregar los campos requeridos'));
            $data['errormsj']=$this->alerterror->error();
        }

        echo json_encode($data);
       
    }

    public function edit()
	{
        $id =$this->uri->segment(3);
        
        $rescatego	=$this->modelcategorias->search(array());
        $data['rescatego']=$rescatego;

        $ressubcatego	=$this->modelsubcategorias->search(array());
        $data['ressubcatego']=$ressubcatego;

        $correo =$this->modelmsjemails->edit($id);
        $data['correo']=$correo;
        
        $this->load->view('layout/headercontent');
		$this->load->view('msjemail/nuevo',$data);
        $this->load->view('layout/footercontent');
    }


}
