<html>
    <head>
        <title>Ejemplon</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    </head>

    <style>
    </style>
    <body>

        <div id="lista_alumnos"></div>

    </body>
    <script type="text/javascript">
    $(document).ready(function(){


          var tabla = '<table cellpadding="0" cellspacing="0" border="1" class="display" id="lista_paciente">';
              tabla += '<caption>Mi Tabla</caption>';
              tabla += '<thead>';
              tabla += '<tr>';
              tabla += '<th>Nombre</th><th>Apellido</th><th>Sexo</th><th>Sexo</th>';
              tabla += '</tr>';
              tabla += '</thead>';
              tabla += '<tbody>';
              tr = '';

              for (i = 0; i < 5; i++){
                  tr += '<tr>';
                  tr += '<td>'+i+'</td><td>ee</td><td>ii</td><td>oo</td>';
                  tr += '</tr>';
              }

              tabla += tr;
              tabla += '</tbody></table>';

              $('#lista_alumnos').html( tabla );
          });




    </script>
</html>
