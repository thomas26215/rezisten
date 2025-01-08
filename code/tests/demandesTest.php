<?php

// Accès aux classes

use PhpParser\Node\Expr\Print_;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/demandes.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {

    // Test de création d'une demande
    //création d'un user pour la demande

    $user = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");
    $demande = new Demande($user,"acces");
    

    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getUser', 'expected' => $user],
        ['method' => 'getDocument', 'expected' => "acces"]];


        foreach ($testGetters as $test) {
            $value = $demande->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }


        print("Getters OK\n");


     // Test des setters
     print("Test des setters : ");

     $newuser = new User("newprapra","newbrayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");


     $demande->setUser($newuser);
     $demande->setDocument("newdoc");

     if ( $demande->getUser() !== $newuser ||
     $demande->getDocument() !== "newdoc" )
     {   
        throw new Exception("Les setters n'ont pas fonctionné correctement");
     }
     print("OK\n");



        // Test de la méthode create
        print("Test de la méthode create : ");
        $newuser->create();


        if (!$demande->create()) {
            throw new Exception("Échec de la création de la demande");
        }

        print("OK\n");

                // Test de la méthode read
                print("Test de la méthode read : ");
                $readDemande = Demande::read($demande->getUser()->getId());
                if (!$readDemande || $readDemande->getDocument() !== $demande->getDocument()) {
                    throw new Exception("Échec de la lecture de la demande");
                }
                print("OK\n");
        

        //Test de la méthode update
        print("Test de la méthode update : ");
        $demande->setDocument("docModifié");

        if (!$demande->update()) {
            throw new Exception("Échec de la mise à jour de la demande");
        }


        $updatedDemande = Demande::read($demande->getUser()->getId());
        if ($updatedDemande->getDocument() !== "docModifié") {
            throw new Exception("La mise à jour n'a pas été effectuée correctement");
        }


        print("OK\n");


        /* print("Test de la méthode delete : ");
        $idToDelete = $demande->getUser()->getId();

        if (!Demande::delete($idToDelete)) {
            throw new Exception("Échec de la suppression du lieu");
        }
    
        // Vérifier que le lieu a bien été supprimé
        $deletedDemande = Demande::read($idToDelete);
        if ($deletedDemande !== null) {
            throw new Exception("La demande n'a pas été supprimée correctement");
        }
        print("OK\n");
    


 */






        $newuser->delete($newuser->getId());

} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>