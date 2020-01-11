 <html>
 <head>
     <title>
         Prueba Javascirpt
     </title>
 </head>

     <body>
         <div id="contenedor">---</div>
     </body>
     <script>
        let i;
        elemento = document.getElementById("contenedor");
        for(i=0;i<50;i++)
        {
            elemento.insertAdjacentHTML('beforeend', 'contando '+i+'<br>');
        }
     </script>
 </html>
