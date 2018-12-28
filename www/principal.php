<?php 
    include "../../../seguridad/discoduro/checkSession.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <title>Principal</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/main.js"></script>
    <style>
        table, th, td{
            border:1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
    <header>
        <h4>Página Principal</h4>
        <div id="id">Usuario: <?=$user?> <a href='signOff.php'>Cerrar Sesión</a></div>
    </header>
    <main>
        <div id="showFiles">
            <table>
                <tr>
                    <th colspan="3">Ficheros</th>
                </tr>
                <tr>
                    <td id="name">Nombre del fichero</td>
                    <td><button id="download">Descargar</button></td>
                    <td><button id="delete">Borrar</button></td>
                </tr>
            </table>
        </div>
        <br />
        <br />
        <div id="upFiles">
            <form  enctype="multipart/form-data" action="javascript:void(0)" method="post">
                <table>
                    <tr>
                        <th colspan="3">Subir ficheros</th>
                    </tr>
                    <tr>
                        <td>Fichero(s)<input type="hidden" name="MAX_FILE_SIZE" value="2500000" /></td>
                        <td><input type="file" name="files[]" id="files" multiple="multiple"></td>
                        <td><button id="submitFiles">Subir</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
</body>
</html>