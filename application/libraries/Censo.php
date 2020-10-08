<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Censo{
    private $args;
    public function __construct($args){
        $this->args=$args;
    }

    public function consultar(){
        $context = stream_context_create(array('http' => array('timeout' => 5)));
	    $url = file_get_contents("https://wsp.registraduria.gov.co/censo/_censoResultado.php?nCedula=".$this->args['cedula'], 0, $context);
	    $doc = new DOMDocument();
                    
        libxml_use_internal_errors(true);
	    $doc->loadHTML($url);
	    $fci = $doc->getElementById('ls_table_ficha_cabecera_indice');
	    $spans = $doc->getElementsByTagName('tr');
    
        $departam=$municipio=$dirpuesto=$direccion=$fechar=$mesav=$observacion='';

        if ($spans->length > 0){
            for ($i = 0; $i < $spans->length; $i++) {
                if (substr_count($spans->item($i)->nodeValue, "Departamento:") >= 1){
                    $depar= $spans->item($i)->nodeValue;
                    $depar = explode(":",$depar);
                    $departam= trim($depar[1]);
                }
                if (substr_count($spans->item($i)->nodeValue, "Municipio:") >= 1){
                    $munic = $spans->item($i)->nodeValue;
                    $munic = explode(":",$munic);
                    $municipio= trim($munic[1]);
                }
                    
                if (substr_count($spans->item(2)->nodeValue, "Puesto:") == 1){
                    $dirpuest = $spans->item(2)->nodeValue;
                    $dirpuest = explode("Puesto:",$dirpuest,7);
                    $dirpuesto = trim($dirpuest[1]);
                }
                    
                if (substr_count($spans->item($i)->nodeValue, "Dirección ") >= 1){
                    $direcc = $spans->item($i)->nodeValue;
                    $direcc = explode("Dirección Puesto:",$direcc);
                    $direccion = trim($direcc[1]);
                }
                
                if (substr_count($spans->item($i)->nodeValue, "Fecha") >= 1){
                    $fecha = $spans->item($i)->nodeValue;
                    $fecha = explode(":",$fecha);
                    $fechar = trim($fecha[1]);
                }
                if (substr_count($spans->item($i)->nodeValue, "Mesa") >= 1){
                    $mesa = $spans->item($i)->nodeValue;
                    $mesa = explode("Mesa",$mesa);
                    $mesav = trim($mesa[1]);
                }
                
                $observacion = "Cedula inscrita";	
            }
        }else{
            $spans = $doc->getElementsByTagName('strong');
            
            $observacion = $spans->item(1)->nodeValue." <br> ";
            if (strcmp($observacion, "REGISTRADURÍA NACIONAL DEL ESTADO CIVIL")==6){
                $observacion = "Debe inscribir la Cedula";
            }
            $observacion = str_replace(" <br>", "", $observacion);
                    
            
        }

        return array('departam'=>$departam,
                'municipio'=>$municipio,
                'puesto'=>$dirpuesto,
                'direcpuest'=>$direccion,
                'fecha'=>$fechar,
                'mesa'=>$mesav,
                'observacion'=>$observacion
            );
    }


}

?>