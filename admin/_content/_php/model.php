<?php
require_once '../../../db_abstract_model.php';

class Habilidades extends DBAbstractModel
{
    public $success;

    public function get_center($habilidades_data = array()){
        // if ($habilidades_data['user']!='') {
            $this->query="
                SELECT
                    tb_centers.cpId AS id,
                    tb_centers.cpCenter AS nameCenter
                FROM tb_centers";

            //$this->mensaje = $this->query;
            $this->get_results_from_query();
            if (count($this->rows) >= 1) {
                $this->success = true;
                //$this->mensaje = 'Se han encontrado resultados.';
                $this->datos = $this->rows;
            }
        // }
    }

    public function get_activity($habilidades_data = array())
    {
        // if ($habilidades_data['user'] != '') {
            foreach ($habilidades_data as $campo => $valor) {
                $$campo = $valor;
            }
            $this->query = "
                SELECT
                    tb_activities.cpId AS id,
                    tb_activities.cpIdCenter AS center,
                    tb_activities.cpActivity AS activity,
                    tb_activities.cpCoins AS coins,
                    tb_activities.cpMinCoins AS minCoins,
                    tb_activities.cpMaxCoins AS maxCoins,
                    tb_activities.cpStatus AS status,
                    tb_activities.cpUser AS user,
                    tb_activities.cpInitialDate AS initialDate,
                    tb_activities.cpFinalDate AS finalDate
                FROM
                    tb_activities
                WHERE
                    cpIdCenter = '$idCenter' AND cpStatus = 1 || cpStatus = 2";
                #GROUP BY ntr_tb_security_test_answers.cpAnswer
        // }
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->success = true;
            $this->mensaje = 'Se han encontrado resultados.';
            $this->datos = $this->rows;
        } else {
            $this->success = false;
            $this->mensaje = 'No se encontró ningún resultado.';
        }
    }

    public function add_points($habilidades_data = array())
    {
        
        // if ($habilidades_data['user'] != '') {
            // foreach ($habilidades_data as $campo => $valor) {
            //     $$campo = $valor;
            // }
            foreach ($habilidades_data['userCoins'] as $key => $value){
                $$key = $value;
            }
            
            $this->query = "
                SELECT
                    tb_users.cpUser
                FROM tb_users
                WHERE
                    tb_users.cpUser = '$user'
                    AND tb_users.cpIdCenterActivity = '$idCenter'
            ";
                    
            $this->get_results_from_query();
            if (count($this->rows) >= 1) {
                $this->insert_coins($habilidades_data);
            } else {
                $this->success = false;
                $this->mensaje = 'El usuario no existe en la base o su centro esta mal ';
            }
    }

    public function insert_coins($habilidades_data = array())
    {
        // if($habilidades_data['user'] != ''){
            // foreach ($habilidades_data as $campo => $valor){
            //     $$campo = $valor;
            // }
            foreach ($habilidades_data['userCoins'] as $key => $value){
                $$key = $value;
            }
            $this->query = "INSERT INTO tb_usercoins (cpUser, cpIdActivity, cpcoins) SELECT * FROM (SELECT '$user' AS user, '$idActivity' AS idActivity, '$coins' AS coins) AS userCoins";
            
            $this->execute_single_query();

            // $this->success = true;
            if($this->success == true){
                $this->mensaje = 'Ha sido aplicado'; 
            }else{
                $this->mensaje = 'Existe un registro previo';
            }
            // $this->mensaje = 'Ha sido aplicado';
        // }else{
        //     $this->mensaje = 'No se ha agregado la encuesta.';
        // }
    }





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
            $this->mensaje = 'Error en el query';
        }
    }
    
    
    # Metodo constructor
    public function __construct()
    {
        $this->db_name = 'u460553087_bL';
    }
}
