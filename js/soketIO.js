var socket = io("http://45.32.168.197:3001/");
var registerSLSAH="";
$(function () {
    socket.on('avisoAttack', function(data){

        if(data['to']==idPersonaje)
        {
          if(MaloId!=data['from'])
          {
            MaloId==data['from'];
            jConfirm(data['atacado']+' te esta atacando! lo queres atacar?', 'Cuidado!', function(r) {
                
                if( r)
                {
                   window.location = "index.php?sec=mundo&mundo="+data['idMundo']+"&target="+data['from'];
                }
              });
          }

          refreshChat();
        }
    });
    
    socket.on('heyWakeUp', function(data){
      if(data['to']==idPersonaje)
        refreshChat();
      if(data['party']==idPersonaje)
        refreshChat();
  });

       socket.on('register', function(data){
          $.ajax({
          data: "op=set&id="+data.id,
          type: "GET",
          dataType: "json",
          url: "json/ChatAuth.php",
          success: function(data){
          updateChatAuth(data);
        }
        });

    });

  });
  function attackAviser(to) {
        socket.emit('avisoAttack', {"atacado": userNombre, "idMundo": mundo,"from":idPersonaje,"to":to});
   };

updateChatAuth=(data)=>{
  if(data['error']==0)
  {
    registerSLSAH = data['auth'];

    socket.emit('mynigga', {"id": registerSLSAH,"name": userNombre, "pjid":idPersonajeBase}); 
  }
}

$(document).ready(function(){ 

    $.ajax({
          data: "op=get",
          type: "GET",
          dataType: "json",
          url: "json/ChatAuth.php",
          success: function(data){
          updateChatAuth(data);
        }
        });
});


