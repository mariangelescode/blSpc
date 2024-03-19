
const send_action_get_center = ( ) =>{
	const data_post = {};
  	data_post.action = 'get_center';
  	handler_petitions( data_post );
}

const send_action_get_activity = ( ) =>{
	const data_post = {};
  	data_post.action = 'get_activity';
	data_post.idCenter = document.getElementById('center').value;
  	handler_petitions( data_post );
}

const send_action_add_points = ( ) =>{
	const data_post = {};
	data_post.action = 'add_points';
	data_post.userCoins = userCoins;
	handler_petitions( data_post );
}

send_action_get_center();

