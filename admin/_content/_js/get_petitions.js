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
        data_post.action == 'get_center' && get_center(respJson);
        data_post.action == 'get_activity' && get_activity(respJson);
        data_post.action == 'add_points' && add_points(respJson);
      } else {
            if(data_post.action == 'add_points' && http.status == 500){
                add_points(500);
            }
      }
    } else {
    }
  }  
}
