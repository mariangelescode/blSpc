let handler_petitions = ( data_post ) => {
  let json_post = JSON.stringify(data_post);
  let http = new XMLHttpRequest();
  http.open("POST", URL, true);
  http.setRequestHeader("Content-type", "application/json; charset=utf-8");
  http.send(json_post);
  http.onreadystatechange = function () {
    if (http.readyState === 4) {
      if (http.status === 200) {
        let resp = http.responseText;
        let respJson = JSON.parse(resp);
        data_post.action == 'send_blocked' && send_blocked(respJson);
        data_post.action == 'validate_blocked' && validate_blocked(respJson);
        data_post.action == 'validate_existed_blocked' && validate_existed_blocked(respJson);
        data_post.action == 'print_blocked' && print_blocked(respJson);
        data_post.action == 'print_old_blocked' && print_old_blocked(respJson);
      } else {
      }
    } else {
    }
  }  
}
