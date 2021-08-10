<?php
header("Access-Control-Allow-Origin: *");// API utilisé par tous...
//header("Access-Control-Allow-Origin: https://ludis-R5.fr"); (API autorisé depuis tel ou tel site )
// 'Content-Type: application/json' permet de spécifier le type de contenu.`
// ici, du JSON. La contrainte REST permet de dev' pour n'importe quel support et le JSON est parfait pour ça.
header("Content-Type: application/json; charset=UTF-8");
// 'Access-Control-Allow-Methods' permet de spécifier la/les méthodes autorisées
header("Access-Control-Allow-Methods: DELETE");
// 'Access-Control-Max-Age' permet de spécifier le temps de cache. (en seconde)
header("Access-Control-Max-Age: 3600");
// 'Access-Control-Allow-Headers' permet de spécifier les headers autorisés
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 ?>
