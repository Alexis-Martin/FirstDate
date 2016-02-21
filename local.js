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

    var rep = xhr.responseText;
    var row = rep.split("<!!>");
    complete_text(row);
  });
}

function complete_text(row){
    document.getElementById('all').innerHTML = "";
    for(var i = 0; i < row.length-1; i++){
      document.getElementById('all').innerHTML += "<div id=\"row" + i + "\" class=\"rows\">";
      var infos = row[i].split("|/|");
      if(infos[0] == 'female'){
        document.getElementById('row' + i).style = "background:lightpink;";
      }
      else if (infos[0] == 'male') {
        document.getElementById('row' + i).style = "background:lightblue;";
      }
      else{
        document.getElementById('row' + i).style = "background:lightgrey;";
      }
      document.getElementById('row' + i).innerHTML += "<div id=\"photo" + i +"\" class=\"photo\">";
      if(infos[1] != ''){
        document.getElementById('photo' + i).innerHTML += "<img src=\"" + infos[1] + "\"/>";
      }
      document.getElementById('row' + i).innerHTML += "</div>";


      if(infos.length >= 10 && infos[9] != '' && infos[9] != 'undefined'){
        document.getElementById('row' + i).innerHTML += "<p class=\"match\">" + infos[9] + "</p>";
      }

      document.getElementById('row' + i).innerHTML += "<div id=\"infos" + i +"\"  class=\"infos\">";

      document.getElementById('infos' + i).innerHTML += "<div id=\"head" + i +"\"  class=\"head\">";

      if(infos[2] != ''){
        document.getElementById('head' + i).innerHTML += "<span class=\"name\">" + infos[2] + "</span>";
      }

      //if(infos[3] != '0000-00-00'){
        document.getElementById('head' + i).innerHTML += "<span>" + infos[3] + "<span>";
      //}

      document.getElementById('infos' + i).innerHTML += "</div>";

      document.getElementById('infos' + i).innerHTML += "<div id=\"bio" + i +"\" class=\"bio\">";
      if(infos[4] != 'undefined'){
        document.getElementById('bio' + i).innerHTML += "<p>" + infos[4] + "</p>";
      }
      document.getElementById('infos' + i).innerHTML += "</div>";

      document.getElementById('infos' + i).innerHTML += "<div id=\"foot" + i +"\" class=\"foot\">";
      if(infos[5] != ''){
        document.getElementById('foot' + i).innerHTML += "<span class=\"city\">vit à " + infos[5] + "</span>";
      }

      if(infos[6] != 'undefined'){
        document.getElementById('foot' + i).innerHTML += "<span class=\"research\">recherche : " + infos[6] + "</span>";
      }
      if(infos[7] != ''){
        document.getElementById('foot' + i).innerHTML += "<span class=\"relation\">est actuellement : " + infos[7] + "</span>";
      }
      document.getElementById('foot' + i).innerHTML += "<br/><span class=\"fb_page\"> <a href=\"https://www.facebook.com/" + infos[8] + "\">voir sa page</a></span>";

      document.getElementById('foot' + i).innerHTML += "<button class=\"send_mess\" onclick=\"javascript:FB.ui({app_id:'1696235890620110', method: 'send', to:'" + infos[8] + "', link: 'https://www.facebook.com/" + infos[8] + "',});\">envoyer message</button>";


      document.getElementById('infos' + i).innerHTML += "</div>";

      document.getElementById('row' + i).innerHTML += "</div>";
    }
}

function send_research(){
  console.log(document.getElementById('search_name').value);
  var send = "name=" + document.getElementById('search_name').value;
  if(send != 'name=' && send != 'recherche'){
    post_from_server("research_name.php", true, send, function(xhr){

      var rep = xhr.responseText;
      console.log(rep);
      var row = rep.split("<!!>");
      complete_text(row);
    });
  }
  else{
    get_id(function(id){get_matches(id);});
  }
}
