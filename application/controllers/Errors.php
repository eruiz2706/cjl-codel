<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Errors extends CI_Controller {

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
        if(!($this->session->authin==1)){
			$this->load->helper('url');
			redirect('login', 'refresh');
        }
    }

	public function index()
	{

        $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Acceso denegado'));
        $data['errormsj']=$this->alerterror->error();

      	$this->load->view('errors/acceso',$data);
       
    }


}
