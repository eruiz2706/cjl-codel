<?php
defined('BASEPATH') OR exit('No se permite acceso directo al script');

class Menu{
    private $arr_menu;
    private $arr_submenu;
    public function __construct($args){
        $this->arr_menu=$args[0];
        $this->arr_submenu=$args[1];
    }

    public function cargar(){
        $menu="";
        foreach($this->arr_menu as $option){
            $treview =($option->url=='#') ? 'treeview': '';

            $menu   .="<li class='$treview'>";
            $menu   .="<a href=\"javascript:openUrl('".base_url()."index.php/','".$option->url."','".$option->nombre."','".$option->descripcion."');\"><i class='fa ".$option->icono."'></i><span>".$option->nombre."</span>";
            if($option->url=='#'){
                $menu   .="<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>";
            }
            $menu   .="</a>";
            
            if($option->url=='#'){
                $menu   .="<ul class='treeview-menu'>";
                foreach($this->arr_submenu as $sub){
                    if($option->id==$sub->padre){
                        $menu   .="<li><a href=\"javascript:openUrl('".base_url()."index.php/','".$sub->url."','".$sub->nombre."','".$sub->descripcion."');\"><i class='fa ".$sub->icono."'></i><span>".$sub->nombre."</a></span></li>";
                    }
                }
                $menu   .="</ul>";
            }
            $menu   .="</li>";
           
        }

        
        return $menu;
    }


}

?>