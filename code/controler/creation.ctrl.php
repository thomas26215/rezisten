<?php
//Includes
include_once('./framework/view.fw.php');
include_once('./model/lieux.class.php');
include_once('./model/histoires.class.php');
include_once('./model/chapitres.class.php');
include_once('./model/users.class.php');
include_once('./model/dialogues.class.php');
include_once('./model/personnages.class.php');
include_once('./model/questions.class.php');

$lieux = Place::readAll();


//vérification création
if(!isset($_GET['id'])){ //si l'histoire n'existe pas
    
    $histoire = new Story("Titre",
                          Chapter::read(100),
                          User::read(4), //changer par id de cette user)
                          Place::read(1),
                          "../view/design/image/background_story.png",
                          false    );
    $histoire->create();  
    $id = $histoire->getId();
}
else{
    $id = $_GET['id'];
    //var_dump($_GET['titre']);
    $histoire = Story::read($id);
    if (isset($_GET['titre']))
    {$histoire->setTitle($_GET['titre']) ; // ajouterDialogue ou ajouterQuestion ou afficherHistoire
    $histoire->setPlace(Place::read($_GET['lieu']));
    }
}

//Récupération des données utilisateurs
$idUser=4; //----------------------------a modifier----------------------------

//Récupération depuis le modèle
$personnages = array('Paul', 'Pierre','Jaques','Michel');
$iddialog = 1;
$dialogues [] = Question::read(1 , "g");
while(null !== (Dialog::read($iddialog,1))){
    $dialogues[] = Dialog::read($iddialog,1);
    $iddialog ++;
}


//Récupération des varibles
$article = $_GET['article'] ?? "ajouterDialogue"; // ajouterDialogue ou ajouterQuestion ou afficherHistoire


//Autres variables
$lien="./view/".$article.".view.php";

// à la sauvegarde
if(isset($_GET['sauvegarder'])){
    $histoire->update();
}
//supprimer un dialogue en appuyant sur la pitite poubelle

if(isset($_GET['idDialogue'])){
    if ($_GET['typeDialogue']){
         Dialog::delete($_GET['idDialogue'],$histoire->getId());
    } else{
        Question::delete($_GET['idDialogue'],$histoire->getId());
    }
}

//chapitre -> chapitre des créateurs

//Créer la vue
$view = new View();
$view->assign('titre',Story::read($histoire->getId())->getTitle());
$view->assign('id',$histoire->getId());
$view->assign('lieux',$lieux);
$view->assign('lien',$lien);
$view->assign('dialogues' , $dialogues);
$view->assign('personnages', $personnages); //pour ajouter dialogue
$view->display('creation');

?>
