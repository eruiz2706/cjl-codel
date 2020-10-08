<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Alerterror{
    private $args;
    public function __construct($args){
        $this->args=$args;
    }

    public function error(){
        $tipo       =(isset($this->args['tipo'])) ? $this->args['tipo'] : '';
        $descripcion=(isset($this->args['descripcion'])) ? $this->args['descripcion']: '';
        $titulo     =(isset($this->args['titulo'])) ? $this->args['titulo']: '';
        $icon       ='';

        if($tipo=='danger'){
            $tipo="alert-danger";
            $icon='fa-ban';
        }else if($tipo=='info'){
            $tipo="alert-info";
            $icon='fa-info';
        }else if($tipo=='warning'){
            $tipo="alert-warning";
            $icon='fa-warning';
        }else if($tipo=='success'){
            $tipo="alert-success";
            $icon='fa-check';
        }

        $content="<div class='alert $tipo alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
        if($titulo !=''){
            $content .="<h4><i class='icon fa $icon'></i> $titulo</h4>";
        } 
        $content .="$descripcion</div>";
                    
        return $content;
    }


}

?>