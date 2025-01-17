<?php
include_once('./model/lieux.class.php');
include_once('framework/view.fw.php');

$id=htmlspecialchars($_GET['id']);
$place = Place::read($id); // mettre l'id du lieu en foction de l'histoire

$coordinates = explode(',',$place->getCoordinates());
$latitude = $coordinates[0];
$longitude = $coordinates[1];
$imgLieu = $id.".webp";

$view = new View();
$view->assign('imgLieu',$imgLieu);
$view->assign('latitude',$latitude);
$view->assign('longitude',$longitude);  
$view->assign('place',$place);
$view->display('consulterLieu');

?>