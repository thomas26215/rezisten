<?php
// Acces aux classe
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dao.class.php');





try {
    print("Création d'un user : ");
    $user = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");


    print("test des getters");
    $value = $user->getBirthDate();
    $expected = "24/08/2005";
    if ($value != $expected) {

        throw new Exception("birthdate incorrecte : '$value', attendu '$expected'");

    }

    $value = $user->getFirstName();
    $expected = "brayan";
    if ($value != $expected) {

        throw new Exception("prenom incorrecte : '$value', attendu '$expected'");

    }
    $value = $user->getMail();
    $expected = "bilsbrayan@gmail.com";
    if ($value != $expected) {

        throw new Exception("mail incorrecte : '$value', attendu '$expected'");

    }

    $value = $user->getRole();
    $expected = "a";
    if ($value != $expected) {

        throw new Exception("role incorrecte : '$value', attendu '$expected'");

    }
    $value = $user->getSurname();
    $expected = "bils";
    if ($value != $expected) {

        throw new Exception("Nom incorrecte : '$value', attendu '$expected'");

    }
    $value = $user->getUsername();
    $expected = "prapra";
    if ($value != $expected) {

        throw new Exception("pseudo incorrecte : '$value', attendu '$expected'");

    }

    print(" getter ok, bravo thomas \n");



    print("TEST FONCTION CREATE");

    $user->create();
    $expected = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");
    $dao = DAO::getInstance();
    $query = $dao->getUtilitaire()->prepare("Select * FROM utilisateurs WHERE username = :username");
    $query->execute([":username" => "prapra"]);
    $table = $querry->fetchAll();
    $row = $table[0];
    



}
catch
 (Exception
 $e) {
  exit("\nErreur: ".$e->getMessage()."\n");
}
