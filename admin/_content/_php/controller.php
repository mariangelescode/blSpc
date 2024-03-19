<?php
require_once('model.php');

function handler($data_post){

	if (array_key_exists('action', $data_post)) {
		$event = $data_post['action'];
	}

	$habilidades_data = helper__data($data_post);

	$habilidades = set_obj();

	switch ($event) {
		case 'get_center':
			$habilidades->get_center($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		
		case 'get_activity':
			$habilidades->get_activity($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		
		case 'add_points':
			$habilidades->add_points($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		default:
			echo ($data);
			break;
	}
}

function set_obj(){
	$obj = new Habilidades();
	return $obj;
}

function helper__data($data_post){
	$habilidades_data = array();
	if (array_key_exists('idCenter', $data_post)) {
		$habilidades_data['idCenter'] = $data_post['idCenter'];
	}
	
	if (array_key_exists('userCoins', $data_post)) {
		$habilidades_data['userCoins'] = $data_post['userCoins'];
	}
	
	if (array_key_exists('center', $data_post)) {
		$habilidades_data['center'] = $data_post['center'];
	}
	// if(array_key_exists('blocked', $data_post)){
	// 	$habilidades_data['blocked'] = $data_post['blocked'];
	// }
	return $habilidades_data;
}

$data_post = json_decode(file_get_contents('php://input'), true);

if (is_array($data_post)) {
	handler($data_post);
}
?>