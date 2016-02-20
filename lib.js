function facebook_is_connected(ontrue, onfalse){
  //alert('facebook_is_connected start');

  FB.getLoginStatus(function(response) {
    if(response.status === 'connected'){
      if(ontrue){
        ontrue();
      }
      return true;
    }
    else{
      if(onfalse){
        onfalse();
      }
      return false;
    }
  });

  //alert('facebook_is_connected end');
}

function facebook_connection(scope, onsuccess, onerror){
  // alert('facebook_connection start');

  facebook_is_connected(false, function(){
    if(typeof(scope) == 'undefined'){
      FB.login(function(response) {
        if (response.authResponse) {
            if(onsuccess){
              onsuccess();
            }
            return true;
        }
        else {
          if(onerror){
            onerror();
          }
          return false;
        }
      });
    }
    else{
      FB.login(function(response) {
        if (response.authResponse) {
            if(onsuccess){
              alert(response.authResponse.accessToken);
              onsuccess();
            }
            return true;
        }
        else {
          if(onerror){
            onerror();
          }
          return false;
        }
      }, scope);
    }
  });

  //alert('facebook_connection start');
}

function get_facebook_likes(){
  //alert('get_facebook_likes start');
  FB.api('/me/likes',function(response){
    if (response && !response.error) {
      data = response.data;
      for (var i = 0; i < data.length; i++) {
          alert(data[i].name);
        };
      //return response.data;
    }
    else if(response && response.error){
      alert('error ' + response.error.message);
    }

  });

  //alert('get_facebook_likes end');
}

function test(){
  alert("it's works!");
}




function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}
