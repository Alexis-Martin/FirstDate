function change_name(id, inner){
  document.getElementById(id).innerHTML = inner;
}

// change_onclick(id, func){
//   document.getElementById(id).onclick = func;
// }

function random_photo(max, Class, id, tab){
    var num = Math.floor(Math.random()*(max)+1);

    while(tab.indexOf(num) != -1){
        num = Math.floor(Math.random()*(max)+1);
    }
     var img = "<img src=\"photos/"+num+".jpg\" class=\"" + Class + "\" alt=\"Photo de couple\" />";
     var html = document.getElementById(id).innerHTML;
     document.getElementById(id).innerHTML = Class == 'left' ? img + html : html + img;
    return num;
}


function get_user_info(id){
  post_from_server("get_user_data.php", true, "id=" + id, function(xhr){
    var aux=xhr.responseText;
    var partsArray = aux.split('<||>');
    
    //here I am
    document.getElementById('nom').value=partsArray[1];
    document.getElementById('datepicker').value=partsArray[3];
    
    console.log("Avant New test2 "+document.getElementById('text').innerHTML);// prbl!!
    document.getElementById('text').innerHTML=partsArray[2]=="undefined"?"Comment décririez-vous ? Quels sont vos hobby ?":partsArray[2];
    
    console.log("Apres New test2 "+document.getElementById('text').innerHTML);// prbl!!
    
    document.getElementById('city').value=partsArray[5];
    if(partsArray[4]=="h"){
        document.getElementById('homme').checked=true;
        document.getElementById('femme').checked=false;
     }
     else if(partsArray[4]=="f"){
        document.getElementById('homme').checked=false;
        document.getElementById('femme').checked=true;
     }
     
     document.getElementById('h').checked=false;
     document.getElementById('f').checked=false;
     
     var sexArray = (partsArray[7]+", ,").split(',');
     if(sexArray[0]=="male" || sexArray[1]=="male"){
        document.getElementById('h').checked=true;
     }
     else{
     document.getElementById('h').checked=false;
     }
     //document.getElementById('f').checked=(partsArray[7].indexOf("female")!=-1);
     
     if(sexArray[0]=="female" || sexArray[1]=="female"){
        document.getElementById('f').checked=true;
     }
     else{
        document.getElementById('f').checked=false;
     }
     if(partsArray[6]=="Single"){
        document.getElementById('situation').value="célib";
     }
     else if(partsArray[6]=="Maried"){
        document.getElementById('situation').value="marié";
     }
     else{
        document.getElementById('situation').value="compliqué";
     }
  });   
}
function maj(id){
    var name= document.getElementById('nom').value;
    var date= document.getElementById('datepicker').value
    
    
    console.log("Avant inner New test2 "+document.getElementById('text').innerHTML);
    console.log("Avant New test2 "+document.getElementById('text').html);
    
    var text= document.getElementById('text').innerHTML;
    
    console.log("Apres inner New test2 "+document.getElementById('text').innerHTML);
    console.log("Apres New test2 "+document.getElementById('text').html);
    
    var city= document.getElementById('city').value;
    //var bio = document.getElementById('text').value;
    //var birth= document.getElementById().value;
    var gen="";
    if(document.getElementById('homme').checked){
        gen="h";
        }
      else if(document.getElementById('femme').checked){
        gen="f";
     }
     
    //var loc = document.getElementById("").value;
    var rel = document.getElementById('situation').value;
    var int="";
    if(document.getElementById('f').checked){
        int+="female";
        if(document.getElementById('h').checked)
            int+=",male";
    }
    else if(document.getElementById('h').checked)
        int+="male";
        
    
    var send= "id="+id+"&name="+name+ "&date="+date+"&text="+text+"&city="+city+"&gen="+gen+"&rel="+rel+"&int="+int;
    console.log("ICICIC77 "+send);
    //var res="update users set name_users ='"+name+"', bio_users='"+text+"',birthday_users="+date+" where id_fb_users="10207795536022976";//, gender_users=' ', location_users=' ', relation_users=' ', interested_users where id_users="+1;
    post_from_server("update_compte.php", true, send);
    
}
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
      post_from_server("add_photos.php", true, send);
    }
  });
}

function get_matches(id){
  post_from_server("get_matches.php", true, "id=" + id, function(xhr){
    console.log(xhr.responseText);
    console.log(document.getElementById('all'));
  });
}
