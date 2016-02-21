function facebook_is_connected(ontrue, onfalse){
  //console.log('facebook_is_connected start');

  FB.getLoginStatus(function(response) {
    if(response.status === 'connected'){
      if(ontrue){
        ontrue();
      }
    }
    else{
      if(onfalse){
        onfalse();
      }
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

function get_facebook_likes(onsuccess, onerror){
  //alert('get_facebook_likes start');

  facebook_is_connected(function(){
    FB.api('/me/likes?fields=category,genre,name',function(response){
      if (response && !response.error) {
        data = response.data;
        if(onsuccess){
          onsuccess(data);
        }
      }
      else if(response && response.error){
        if(onerror){
          onerror(response);
        }
      }
    });
  });
  //alert('get_facebook_likes end');
}

function get_facebook_profile(onsuccess, onerror){
  //alert('get_faceboook_profile start');

  facebook_is_connected(function(){
    FB.api(
    '/me/',
    'GET',
    {"fields":"bio,birthday,name,gender,interested_in,location,relationship_status,work"},
    function(response) {
      if (response && !response.error) {
        data = response;
        if(onsuccess){
          onsuccess(data);
        }
      }
      else if(response && response.error){
        if(onerror){
          onerror(response);
        }
      }
    });
  });
  //alert('get_faceboook_profile end');
}

function get_facebook_photos(onsuccess, onerror){
  //alert('get_faceboook_profile start');

  facebook_is_connected(function(){
    FB.api(
    '/me/picture',
    'GET',
    {"type":"large"},
    function(response) {
      if (response && !response.error) {
        data = response.data;
        if(onsuccess){
          onsuccess(data);
        }
      }
      else if(response && response.error){
        if(onerror){
          onerror(response);
        }
      }
    });
  });
  //alert('get_faceboook_profile end');
}

function get_id(callback){
  //console.log("get_id start");
  facebook_is_connected(function(){
    FB.api('/me/', function(response) {
      if (response && !response.error) {
        if(callback){
          callback(response.id);
        }
      }
    });
  });
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

function getXHR(){
  var xhr;
  if (window.XMLHttpRequest){
    xhr = new XMLHttpRequest();     //  Firefox, Safari, ...
  }
  else if (window.ActiveXObject){
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xhr;
}

function get_from_server(url, asynchrone, onsuccess){
  var xhr = getXHR();

  xhr.onreadystatechange  = function(){
    if(xhr.readyState  == 4){
      if(xhr.status  == 200){
        if(onsuccess){
          onsuccess(xhr);
        }
      }
      else{
        return false;
      }
    }
  };
  var asynchrone = asynchrone == 'undefined' ? false : asynchrone;
  xhr.open("GET", url,  asynchrone);
  xhr.send(null);
}

function post_from_server(url, asynchrone, parameters, onsuccess){
  var xhr = getXHR();
  xhr.onreadystatechange  = function(){
    if(xhr.readyState  == 4){
      if(xhr.status  == 200){
        if(onsuccess){
          onsuccess(xhr);
        }
      }
      else{
        return false;
      }
    }
  };
  var asynchrone = asynchrone ? asynchrone : false;
  xhr.open("POST", url,  asynchrone);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(parameters);
}
