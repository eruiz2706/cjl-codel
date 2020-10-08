<?php

class Modelcsv extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('modelroles');
    }
    function uploadData()
    {
        $count=0;
        $tot_regok = 0;
        $tot_regma = 0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");

        
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $datos=explode(";",$csv_line[0]);
                 if (trim($datos[0]) =="")$datos[0]= null;
                 if (trim($datos[1]) =="")$datos[1]= null;
                 if (trim($datos[2]) =="")$datos[2]= null;
                 if (trim($datos[3]) =="")$datos[3]= null;
                 if (trim($datos[4]) =="")$datos[4]= null;
                 if (trim($datos[5]) =="")$datos[5]= null;
                 if (trim($datos[6]) =="")$datos[6]= null;
                 if (trim($datos[7]) =="")$datos[7]= null;

                 
                $insert_csv = array();
                if ($datos[0] != null){
                    $cedula ="";
                    $this->db->select('documento');
                    $this->db->from('personas');
                    $this->db->where('documento',trim($datos[0]));
                    $consulta = $this->db->get();
                    $resultado = $consulta->row();
                    if($resultado != null) $cedula = $resultado->documento;
                   

                    if($cedula ==""){
                        $tot_regok++;
                        $insert_csv['documento']  = utf8_encode($datos[0]);
                        $insert_csv['nombre']     = utf8_encode($datos[1]);//remove if you want to have primary key,
                        $insert_csv['apellido']   = utf8_encode($datos[2]);
                        $insert_csv['celular']    = utf8_encode($datos[3]);
                        $insert_csv['fijo']       = utf8_encode($datos[4]);
                        $insert_csv['correo']     = utf8_encode($datos[5]);
                        $insert_csv['dirdomicilio']= utf8_encode($datos[6]);
                        $insert_csv['barriodomicilio']= utf8_encode($datos[7]);
                    }else{
                         $tot_regma++; 
                    }
                }else{
                   $tot_regma++; 
                }

            }
            $i++;
            if($tot_regok > 0){
                $this->load->library('encrypt');
                $roles  =$this->modelroles->getNombre('personas');
                $idrol    =($roles->id=='') ? null : $roles->id;

                 $columns    =array(
                    'nombre'=>trim($insert_csv['nombre']),
                    'password'=>$this->encryption->encrypt($insert_csv['documento']),
                    'usuario'=>$insert_csv['documento'],
                    'idrol'=>$idrol,
                    'estado'=>true
                );
                $columns    =$this->security->xss_clean($columns);
                $this->modelusuario->save($columns);

                $data = array(
                    'documento' =>       $insert_csv['documento'], 
                    'nombre' =>          $insert_csv['nombre'] ,
                    'apellido' =>        $insert_csv['apellido'] ,
                    'celular' =>         $insert_csv['celular'],
                    'fijo' =>            $insert_csv['fijo'],
                    'correo' =>          $insert_csv['correo'],
                    'dirdomicilio' =>    $insert_csv['dirdomicilio'],
                    'barriodomicilio' => $insert_csv['barriodomicilio'],
                    'usuc'=>$this->session->userdata('username'),
                    'fecc'=>date('Y-m-d H:i:s')
                );
                $data['crane_features']=$this->db->insert('personas', $data);
		
            }
        }
	
        $data2['tot_regok']=$tot_regok;
        $data2['tot_regma']=$tot_regma;
        fclose($fp) or die("can't close file");
        $data2['success']="success";
        return $data2;
    }
}