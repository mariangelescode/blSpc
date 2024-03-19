<?php
require_once '../../../../../connectionMvc/db_abstract_model.php';

class Habilidades extends DBAbstractModel
{
    public $success;
    public function send_blocked($habilidades_data = array()){
        if($habilidades_data['user'] != ''){
            $this->query="INSERT INTO tmp_tbbloqueousuarios(cpUsuario,cpFDesbloqueo,cpMotivo,cpUsuarioBloqueador) VALUES ";
            foreach ($habilidades_data['blocked'] as $key => $value) {
                $this->query .= "( '".$value["inpSap"]."', '".$value["inpFec"]."', '".$value["inpMot"]."' , '".$habilidades_data['user']."'), ";
            }
            $this->query = rtrim($this->query,", ");
            $this->execute_single_query();
            //$this->mensaje = $this->query;
        }else{
            $this->mensaje = 'Error en el query'.$this->query;
        }
    }
    public function validate_blocked($habilidades_data = array()){
        if ($habilidades_data['user']!='') {
            $this->query="SELECT cpUsuario
                FROM tmp_tbbloqueousuarios
                WHERE cpFDesbloqueo >= DATE(NOW())
                AND cpUsuario IN (".$habilidades_data['blocked'];
            $this->query.=")";
            //$this->mensaje = $this->query;
            $this->get_results_from_query();
            if (count($this->rows) >= 1) {
                $this->success = true;
                //$this->mensaje = 'Se han encontrado resultados.'.$this->query;
                $this->datos = $this->rows;
            }
        }
    }
    public function validate_existed_blocked($habilidades_data = array()){
        if ($habilidades_data['user']!='') {
            $this->query="SELECT cpUsuario
                FROM sys_tbusuarios
                WHERE cpEstatus = '1'
                AND cpUsuario = ".$habilidades_data['blocked'];
            //$this->mensaje = $this->query;
            $this->get_results_from_query();
            if (count($this->rows) >= 1) {
                $this->success = true;
                //$this->mensaje = 'Se han encontrado resultados.'.$this->query;
                $this->datos = $this->rows;
            }
        }
    }
    public function print_blocked($habilidades_data = array()){
        if ($habilidades_data['user']!='') {
            $this->query="
                SELECT tmp_tbbloqueousuarios.cpUsuario AS cpUsuario,
                CONCAT(cpNombre,' ',cpaPaterno,' ',cpaMaterno) AS cpNombre,
                cpFBloqueo,
                cpFDesbloqueo
                FROM tmp_tbbloqueousuarios, sys_tbusuarios
                WHERE cpFDesbloqueo >= DATE(NOW())
                AND tmp_tbbloqueousuarios.cpUsuario = sys_tbusuarios.cpUsuario";
            }
            $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->success = true;
            //$this->mensaje = 'Se han encontrado resultados.'.$this->query;
            $this->datos = $this->rows;
        }
    }
    public function print_old_blocked($habilidades_data = array()){
        if ($habilidades_data['user']!='') {
            $this->query="
                SELECT tmp_tbbloqueousuarios.cpUsuario AS cpUsuario,
                CONCAT(cpNombre,' ',cpaPaterno,' ',cpaMaterno) AS cpNombre,
                cpFBloqueo,
                cpFDesbloqueo
                FROM tmp_tbbloqueousuarios, sys_tbusuarios
                WHERE cpFDesbloqueo <= DATE(NOW())
                AND tmp_tbbloqueousuarios.cpUsuario = sys_tbusuarios.cpUsuario";
            }
            $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->success = true;
            //$this->mensaje = 'Se han encontrado resultados.'.$this->query;
            $this->datos = $this->rows;
        }
    }
    #get
    public function get($habilidades_data = '')
    {}
    # Crear un nuevo ranking
    public function set($habilidades_data = array())
    {}
    # Modificar ranking
    public function edit($habilidades_data = array())
    {}
    # Eliminar un usuario
    public function delete($user_email = '')
    {}
    # Metodo constructor
    public function __construct()
    {
        $this->db_name = 'gtc_bdSasc';
    }
}
