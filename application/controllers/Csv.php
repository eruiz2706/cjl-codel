<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');
class Csv extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelcsv');
        $this->load->library('encryption');
        $this->load->model('modelusuario');
    }
    function index()
    {
       $this->load->view('csv/index');
    }
    function uploadData()
    {
        $data=array();
        

       if ($_FILES['userfile']['tmp_name'] != ""){
            $explode_name = explode('.',$_FILES['userfile']['name']);
            if($explode_name[1] == 'csv'){
                $csv_file = "true";
            }
            else{
                $csv_file = "false";
            }  

           
            if ($csv_file == "true"){
                $data = $this->modelcsv->uploadData();
                $totalreg = $data['tot_regok'] + $data['tot_regma'];
                if ($data['tot_regok'] > 0){
                    $this->load->library('Alerterror',array('tipo'=>'success','descripcion'=>'Se Cargaron '.$data['tot_regok'].' Regitros de '.$totalreg));
                    $data['errormsj']=$this->alerterror->error();
                }else{
                    $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'No se cargo ningun registro'));
                    $data['errormsj']=$this->alerterror->error();
                }
            }else{
                $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'Solo Puede Cargar Archivos csv'));
                 $data['errormsj']=$this->alerterror->error();
            }
        }else{
             $this->load->library('Alerterror',array('tipo'=>'danger','descripcion'=>'No hay Archivos para cargar'));
             $data['errormsj']=$this->alerterror->error();
        }
        echo json_encode($data);
    }

}
?>