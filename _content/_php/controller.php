<?php
require_once('model.php');

function handler($data_post){

	if (array_key_exists('action', $data_post)) {
		$event = $data_post['action'];
	}

	$habilidades_data = helper__data($data_post);

	$habilidades = set_obj();

	switch ($event) {
		case 'send_blocked':
			$habilidades->send_blocked($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		case 'validate_blocked':
			$habilidades->validate_blocked($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		case 'print_blocked':
			$habilidades->print_blocked($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		case 'print_old_blocked':
			$habilidades->print_old_blocked($habilidades_data);
			$data = array(
				'success' => $habilidades->success,
				'data' => array(
					'message' => $habilidades->mensaje,
					'datos' => $habilidades->datos
				)
			);
			echo json_encode($data);
			break;
		case 'validate_existed_blocked':
			$habilidades->validate_existed_blocked($habilidades_data);
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
	if (array_key_exists('user', $data_post)) {
		$habilidades_data['user'] = $data_post['user'];
	}
	if (array_key_exists('center', $data_post)) {
		$habilidades_data['center'] = $data_post['center'];
	}
	if(array_key_exists('blocked', $data_post)){
		$habilidades_data['blocked'] = $data_post['blocked'];
	}
	return $habilidades_data;
}

$data_post = json_decode(file_get_contents('php://input'), true);

if (is_array($data_post)) {
	handler($data_post);
}
?>