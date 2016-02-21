function change_name(id, inner){
  document.getElementById(id).innerHTML = inner;
}

// change_onclick(id, func){
//   document.getElementById(id).onclick = func;
// }

function send_likes(id){
  get_facebook_likes(function(data){
    var send = "id=" + id;
    var name = "";
    var idlike = "";

    for(var i = 0; i < data.length; i++){
      name += data[i].name;
      idlike += data[i].id;

      if(i != data.length - 1){
        name += "<||>";
        idlike += "<||>";
      }
    }
    send += "&idlike=" + idlike + "&names=" + name;
    post_from_server("add_likes.php", true, send);

  });
}

function send_profile(onsuccess){
  get_facebook_profile(function(data){
    var send = "id_fb_users=" + data.id + "&name_users=" + data.name;
    send = data.bio                 != 'undefined' ? send + "&bio_users="      + data.bio : send;
    send = data.birthday            != 'undefined' ? send + "&birthday_users=" + data.birthday : send;
    send = data.gender              != 'undefined' ? send + "&gender_users="   + data.gender : send;
    send = data.location.name       != 'undefined' ? send + "&location_users=" + data.location.name : send;
    send = data.relationship_status != 'undefined' ? send + "&relation_users=" + data.relationship_status : send;
    send = data.interested_in != 'undefined' ? send + "&interested_users=" + (data.interested_in.length == 1 ? data.interested_in[0] : data.interested_in[0] + ',' + data.interested_in[1]) : send;

    post_from_server("add_profile.php", true, send, function(){
      if(onsuccess){
        onsuccess(data.id);
      }
    });
  });
}


function send_photos(id){
  get_facebook_photos(function(data){
    if(data.url != 'undefined'){
      var send = "id=" + id + "&url=" + encodeURIComponent(data.url);
      console.log(send);
      post_from_server("add_photos.php", true, send, function(xhr){
        console.log(xhr.responseText);
      });
    }
  });
}
