<?php

// Accès aux classes

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/dialogues.class.php');

class dialoguesTest extends TestCase {
    private Chapter $chapter;
    private User $creator;
    private Place $place;
    private Story $story;
    private Character $character;
    private Dialog $dialog;

    protected function setUp(): void {
        $this->chapter = new Chapter(1,"Comment rater son école d'art");
        $this->creator = new User("prapra", "brayan", "bils", "24/08/2005", "bilsbrayan@gmail.com", "2706", "a");
        $this->place = new Place("iut" ,"batiment" ,"Endoit où l'on a cours", "38000" , "0.0");
        $this->story = new Story("Titre" ,$this->chapter ,$this->creator, $this->place , "background",false);
        $this->character = new Character("pierre", "chemin");
        $this->dialog = new Dialog(1,$this->story ,$this->character, "Bonjour" , false,'11.mp3');
    }

    public function testGetters()  {
        $this->assertEquals($this->story, $this->dialog->getStory());
$this->assertEquals($this->character, $this->dialog->getSpeaker());
        $this->assertEquals("Bonjour", $this->dialog->getContent());
        $this->assertEquals(false, $this->dialog->getBonus());
        $this->assertEquals("11.mp3", $this->dialog->getDubbing());
    }

    public function testSetters() {
        $this->dialog->setStory($this->story);
        $this->dialog->setSpeaker($this->character);
        $this->dialog->setContent("test");
        $this->dialog->setBonus(true);
        $this->dialog->setDubbing("dubbing");

        $this->assertEquals($this->story, $this->dialog->getStory());
        $this->assertEquals($this->character, $this->dialog->getSpeaker());
        $this->assertEquals("test", $this->dialog->getContent());
        $this->assertEquals(true, $this->dialog->getBonus());
        $this->assertEquals("dubbing", $this->dialog->getDubbing());
    }

    public function testCreate() {
        $this->assertTrue($this->dialog->create());
    }

    public function testRead() {
    $this->chapter->create();
    $this->creator->create();
    $this->place->create();
    $this->story->create();
    $this->character->create();
    $this->dialog->create();

    $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
    $this->assertNotNull($readDialog);
    $this->assertEquals($this->dialog->getContent(), $readDialog->getContent());
    $this->assertEquals($this->dialog->getBonus(), $readDialog->getBonus());
    $this->assertEquals($this->dialog->getDubbing(), $readDialog->getDubbing());
}


    protected function tearDown(): void {
        if($this->chapter->getNumChapter > 0) {
            Chapter::delete($this->chapter->getNumChapter());
        }
        if($this->creator->getId() > 0) {
            Creator::delete($this->creator->getId());
        }
        if($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if($this->story->getId() > 0) {
            Story::delete($this->story->getId())  ;
        }
        if($this->character->getId() > 0) {
            Character::delete($this->character->getId());
        }
        if($this->dialog->getId() > 0 && $this->dialog->getStory()->getId() > 0) {
            Dialog::delete($this->dialog->getId(), $this->dialog->getStory()->getId());
        }
        
        
    }
}

 


/*
try {
    // Test de création d'un dialogue


    $chapitre =  Chapter::read(0);
    $createur = User::read(4);
    $lieu = Place::read(1);
    $histoire = Story::read(1);
    $perso = Character::read(1);
    $dialogue = new Dialog(1,$histoire ,$perso, "Bonjour" , false,'11.mp3');


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getId', 'expected' => 1],
        ['method' => 'getStory', 'expected' => $histoire],
        ['method' => 'getSpeaker', 'expected' => $perso],
        ['method' => 'getContent', 'expected' => "Bonjour"],
        ['method' => 'getBonus', 'expected' => false],
        ['method' => 'getDubbing', 'expected' => "11.mp3"]];

        foreach ($testGetters as $test) {
            $value = $dialogue->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");

    print("Test des setters : ");

        $newStory = Story::read(2);
        $newSpeaker = Character::read(2);

        $dialogue->setId(2);
        $dialogue->setStory($newStory);
        $dialogue->setSpeaker($newSpeaker);
        $dialogue->setContent("Salut");
        $dialogue->setBonus(true);
        $dialogue->setDubbing("121.mp3");


        if ( $dialogue->getId() !== 2 ||
             $dialogue->getStory() !== $newStory ||
             $dialogue->getSpeaker() !== $newSpeaker ||
             $dialogue->getContent() !== "Salut" ||
             $dialogue->getBonus() !== true ||
             $dialogue->getDubbing() !== "121.mp3")
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");

    print("Test de la méthode create : ");
    try{
        $dialogue->create();
        print("La création a réussi\n");
    }catch(Exception $e){
        print("La création a échouée\n");
    }

    print("Test de la méthode update : ");
    try{
        $dialogue->update();
        print("L'update a réussi\n");
    }catch(Exception $e){
        print("L'update a échouée\n");
    }

    print("Test de la méthode getDialogsBeforeQuestion : ");
    try{
        $dialogs = Dialog::getDialogsBeforeQuestion(1);
        foreach($dialogs as $dial):
            if($dial->getContent() === "limquestion"){
                print("La recherche va trop loin");
                exit;
            }
        endforeach;
        print("La recherche a fonctionnée\n");
    }catch(Exception $e){
        print($e->getMessage());
    }

    print("Test de la méthode getDialogsBonusAfterQuestion : ");
    try{
        $dialogs = Dialog::getDialogsBonusAfterQuestion(1);
        foreach($dialogs as $dial):
            if($dial->getBonus() === "false"){
                print("Un dialogue non bonus est trouvé !!");
                exit;
            }
        endforeach;
        print("La recherche a fonctionné\n");
    }catch(Exception $e){
        print($e->getMessage());
    }

    print("Test de la méthode getDialogsClassicAfterQuestion : ");
    try{
        $dialogs = Dialog::getDialogsClassicAfterQuestion(1);
        foreach($dialogs as $dial):
            if($dial->getBonus() === "true"){
                print("Un dialogue bonus est trouvé !!");
                exit;
            }
        endforeach;
        print("La recherche a fonctionné\n");
    }catch(Exception $e){
        print($e->getMessage());
    }

    
/*     print("Test de la méthode getDialogsFromStory");
    try{
        $hist = Story::read(2);
        $expectedAmount = Dialog::countDialogs($hist->getId());
        $amount = sizeof(Dialog::getdialogsFromstory($hist->getId()));
        if($amount != $expectedAmount){
            print("Le nombre est incorrect");
        }else{
            print("Le nombre de dialogues est correct");
        }

    }catch(Exception $e){
        print("Les dialogues n'ont pas pu être lus");
    }
  


 


    }catch(Exception $e){
        echo $e->getMessage();
    }

    print("\nSuppression des valeurs de test de la base de données \n");
    $dialogue->delete($dialogue->getId(),$dialogue->getStory()->getId());
    foreach($dialogs as $d):
        $d->delete($d->getId(),$d->getStory()->getId());
    endforeach;

 */

?>
