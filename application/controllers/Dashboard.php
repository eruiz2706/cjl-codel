<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Dashboard extends CI_Controller {

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
	   
		$this->load->model('modeldashboard');

    }

	public function index()
	{

		$resgraf1	=$this->graf1();
		$data['refer']=$resgraf1[0];
		$data['person']=$resgraf1[1];
		$data['graf1']=$resgraf1[2];

		$resgraf2	=$this->graf2();
		$data['toolgraf2']=$resgraf2[0];
		$data['cadtitgraf2']=$resgraf2[1];
		$data['cadgraf2']=$resgraf2[2];

		$resgraf3	=$this->graf3();
		$data['toolgraf3']=$resgraf3[0];
		$data['cadtitgraf3']=$resgraf3[1];
		$data['cadgraf3']=$resgraf3[2];

		$resgraf4	=$this->graf4();
		$data['sindatos']=$resgraf4[0];
		$data['condatos']=$resgraf4[1];
		$data['graf4']=$resgraf4[2];

		$this->load->view('dashboard/index',$data);
        
	}

	function graf1(){
		$resultado	=$this->modeldashboard->ingvsref();
		$person 	=$resultado->person;
		$refer 		=$resultado->refer;

		if($person=='')$person=0;
		if($refer=='')$refer=0;

		if($refer==0 && $person==0){
			return array(
					0,
					0,
					"[{name:'Personas', y:0, color:'#147ADF'},{name:'Referidos', y:1, color:'#FF0000'}]"
			);	
		}else{
			return array(
					$refer,
					$person,
					"[{name:'Personas', y:".$person.", color:'#147ADF'},{name:'Referidos', y:".$refer.", color:'#FF0000'}]"
			);	
		}

	}

	function graf2(){
		$toolgraf2="{
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\" nowrap>{series.name}:  </td>' +
                '<td style=\"padding:0\" nowrap><b> {point.y:,0f}  </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
		}";
		
		$resperson	=$this->modeldashboard->personasxdia();
		$i=0;

		$cadtitgraf2="[";
		$cadpers	="";
		foreach($resperson as $rescat){
			$dia	=$rescat->dia;
			$cant 	=$rescat->cant;
			
			if($i==0){
				$cadtitgraf2 .="'$dia'";
				$cadpers	 .="$cant";
			}else{
				$cadtitgraf2 .=",'$dia'";
				$cadpers	 .=",$cant";
			}
			$i++;
		}
		$cadtitgraf2 .="]";


 		$cadgraf2="[{name:'Personas',data:[$cadpers]}]";
 
		return array($toolgraf2,
					$cadtitgraf2,
					$cadgraf2
				);
	}

	function graf3(){
		$toolgraf3="{
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\" nowrap>{series.name}:  </td>' +
                '<td style=\"padding:0\" nowrap><b> {point.y:,0f}  </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
		}";
		
		$rescatego	=$this->modeldashboard->ingvsrefcat();
		$i=0;

		$cadtitgraf3="[";
		$cadpers	="";
		$cadref		="";
		foreach($rescatego as $rescat){
			$nomcat	=$rescat->nombre;
			$pers 	=$rescat->canpers;
			$ref	=$rescat->canref;
			
			if($nomcat=='')$nomcat='sin categoria';

			if($i==0){
				$cadtitgraf3 .="'$nomcat'";
				$cadpers	 .="$pers";
				$cadref		 .="$ref";
			}else{
				$cadtitgraf3 .=",'$nomcat'";
				$cadpers	 .=",$pers";
				$cadref		 .=",$ref";
			}
			$i++;
		}
		$cadtitgraf3 .="]";


 		$cadgraf3="[{name:'Personas',data:[$cadpers]},{name:'Referidos',data:[$cadref]}]";
 
		return array($toolgraf3,
					$cadtitgraf3,
					$cadgraf3
				);
	}

	function graf4(){
		$resultado	=$this->modeldashboard->sindatosvot();
		$sin 	=$resultado->sindatos;
		$con 	=($resultado->total-$resultado->sindatos);

		if($sin=='')$sin=0;
		if($con=='')$con=0;

		if($sin==0 && $con==0){
			return array(
					0,
					0,
					"[{name:'Sin datos', y:0, color:'#147ADF'},{name:'Con datos', y:1, color:'#FF0000'}]"
			);
		}else{
			return array(
					$sin,
					$con,
					"[{name:'Con datos', y:".$con.", color:'#147ADF'},{name:'Sin datos', y:".$sin.", color:'#FF0000'}]"
			);
		}

		
	}
}
