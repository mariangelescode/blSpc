<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./_content/_css/admin.css">
    <title>Admin Puntos</title>
</head>
<body>
    <p class="title--size title--color textAlign--center --paddingTop25">Administrador de Puntos</p>
    <div class="container__adminPoints">
        <div class="container__addPoints__selects">
            <select class="selects--style" name="center" id="center" onchange="send_action_get_activity()"></select>
            <select class="selects--style" name="activity" id="activity">
                <option value=0>Selecciona una actividad</option>
            </select>
        </div>

        <div id="containerInpUser" class="--displayNoneGrl textAlign--center">
            <input type="text" name="user" id="user" class="addPoints__inpUser" placeholder="Usuario">
        </div>
        <div id="containerPoints">
            
        </div>
    </div>

	<script src="./_content/_js/manipulate_data.js"></script>
	<script src="./_content/_js/get_petitions.js"></script>
	<script src="./_content/_js/send_action.js"></script>
</body>

</html>