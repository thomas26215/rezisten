<?php
include_once('./model/lieux.class.php');
include_once('framework/view.fw.php');

$lieu = Place::read(1); // mettre l'id du lieu en foction de l'histoire

$nom = $lieu->getName();
$type = $lieu->getPlaceType();
$ville = $lieu->getCity();
$description = $lieu->getDescription();

$view = new View();
$view->assign('nom', $nom);
$view->assign('type', $type);
$view->assign('ville', $ville);
$view->assign('description', $description);
$view->display('consulterLieu');
?>