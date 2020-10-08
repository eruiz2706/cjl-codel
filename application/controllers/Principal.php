<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Principal extends CI_Controller {

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
		$this->load->model('modelmenu');
		
		$this->load->library('session');

		if(!($this->session->authin==1)){
			$this->load->helper('url');
			redirect('login', 'refresh');
		}

    }

	public function index()
	{
	
		$a_menu	=$this->modelmenu->getPermit();
		$resmod	=$a_menu[0];
		$ressub	=$a_menu[1];	

		$this->load->library('Menu',array($resmod,$ressub));
		$data['menu']	=$this->menu->cargar();
		
		$this->load->view('layout/header',$data);
		$this->load->view('principal');
		$this->load->view('layout/footer');
	}
}
