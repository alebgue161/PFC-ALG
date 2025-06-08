<?php
$mysqli = new mysqli("localhost", "root", "", "overwatch_alg");
if ($mysqli-> connect_errno){
    echo "<p>Fallo al conectar con MySQL: (", $mysqli->connect_errno, ") ", $mysqli->connect_error, "</p>";
} 
// else {
//     echo "<p>Éxito al conectar</p>";
// }
?>