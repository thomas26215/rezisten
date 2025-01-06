<?php
// Accès aux classes
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {
    // Test de création d'un utilisateur
    print("Création d'un user : ");
    $user = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");

    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getBirthDate', 'expected' => "24/08/2005"],
        ['method' => 'getFirstName', 'expected' => "brayan"],
        ['method' => 'getMail', 'expected' => "bilsbrayan@gmail.com"],
        ['method' => 'getRole', 'expected' => "a"],
        ['method' => 'getSurname', 'expected' => "bils"],
        ['method' => 'getUsername', 'expected' => "prapra"]
    ];

    foreach ($testGetters as $test) {
        $value = $user->{$test['method']}();
        $expected = $test['expected'];
        if ($value != $expected) {
            throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
        }
    }

    print("Getters OK\n");

    // Test de la méthode create
    print("Test de la méthode create : ");
    if (!$user->create()) {
        throw new Exception("Échec de la création de l'utilisateur");
    }
    print("OK\n");

    // Test de la méthode read
    print("Test de la méthode read : ");
    $readUser = User::read($user->getId());
    if (!$readUser || $readUser->getUsername() !== $user->getUsername()) {
        throw new Exception("Échec de la lecture de l'utilisateur");
    }
    print("OK\n");

    // Test de la méthode update
    print("Test de la méthode update : ");
    $user->setFirstName("BrayanModifié");
    if (!$user->update()) {
        throw new Exception("Échec de la mise à jour de l'utilisateur");
    }
    $updatedUser = User::read($user->getId());
    if ($updatedUser->getFirstName() !== "BrayanModifié") {
        throw new Exception("La mise à jour n'a pas été effectuée correctement");
    }
    print("OK\n");

    // Test de la méthode delete
    print("Test de la méthode delete : ");
    if (!User::delete($user->getId())) {
        throw new Exception("Échec de la suppression de l'utilisateur");
    }
    $deletedUser = User::read($user->getId());
    if ($deletedUser !== null) {
        throw new Exception("L'utilisateur n'a pas été supprimé correctement");
    }
    print("OK\n");

    // Test des setters
    print("Test des setters : ");
    $user->setUsername("newUsername");
    $user->setFirstName("newFirstName");
    $user->setSurname("newSurname");
    $user->setBirthDate("01/01/2000");
    $user->setMail("new@email.com");
    $user->setPassword("newPassword");
    $user->setRole("b");

    if ($user->getUsername() !== "newUsername" ||
        $user->getFirstName() !== "newFirstName" ||
        $user->getSurname() !== "newSurname" ||
        $user->getBirthDate() !== "01/01/2000" ||
        $user->getMail() !== "new@email.com" ||
        $user->getRole() !== "b") {
        throw new Exception("Les setters n'ont pas fonctionné correctement");
    }
    print("OK\n");

    print("Tous les tests ont réussi !\n");

} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>
