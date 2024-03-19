
const send_action_send_blocked = (blocked) =>{
	const data_post = {};
  	data_post.action = 'send_blocked';
  	data_post.user = user;
  	data_post.center = center;
  	data_post.blocked = blocked;
  	handler_petitions( data_post );
}

send_action_old_blocked();

