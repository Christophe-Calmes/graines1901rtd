<?php
require('sources/events/objets/sqlEvents.php');
class TemplateEvents extends sqlEvents
{

    public function formAddGame ($idNav) {
        $gamesTypes = $this->getGamesTypes ();
        echo '<form class="customerForm" action="'.encodeRoutage(151).'"  method="post">';
            echo '<label for="nameGame">Nom du jeu</label>';
            echo '<input id="nameGame" type="text" name="nameGame" placeholder="Nouveau jeu" />';
            echo '<label for="typeGame">Type de jeu ?</label>';
            echo '<select id="idTypeGame", name="typeGame">';
            foreach ($gamesTypes as$value) {
            echo '<option value="'.$value['idTypeGame'].'">'.$value['typeGame'].'</option>';
            }
            echo '</select>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
        echo '</form>';
    }
    public function displayPaginationGames ($premier, $parPage) {
        $dataGame = $this->paginationGames ($premier, $parPage);
        echo '<article class="tripleColum box">';
         echo '<div class="One">';
            echo 'Nom du jeu';
         echo '</div>';
         echo '<div class="Two">';
            echo 'Type de jeu';
         echo '</div>';
         echo '<div class="Three">';
            echo 'Administration';
         echo '</div>';
        echo '</article>';
        foreach ($dataGame AS $game) {
        echo '<article class="tripleColum">';
            echo '<div class="One box leftAlign">';
                echo $game['nameGame'];
            echo '</div>';
            echo '<div class="Two box">';
                echo $game['typeGame'];
            echo '</div>';
            echo '<div class="Three box leftAlign">';
                echo '<a href="'.findTargetRoute(246).'&idGame='.$game['idNameGame'].'">'.$game['nameGame'].'</a>';
            echo '</div>';
        echo '</article>';
        }

    }
    private function formUpdateGame ($game, $idNav) {
         $gamesTypes = $this->getGamesTypes ();
        echo '<h2 class="subTitleSite">Modifier un jeu ?</h2>';
        echo '<form class="customerForm" action="'.encodeRoutage(152).'"  method="post">';
            echo '<label for="nameGame">Nom du jeu</label>';
            echo '<input id="nameGame" type="text" name="nameGame" value="'.$game['nameGame'].'" />';
            echo '<label for="typeGame">Type de jeu ?</label>';
            echo '<select id="idTypeGame", name="typeGame">';
            foreach ($gamesTypes as $value) {
                if($game['idTypeGame'] == $value['idTypeGame']) {
                    echo '<option value="'.$value['idTypeGame'].'" selected>'.$value['typeGame'].'</option>';
                } else {
                    echo '<option value="'.$value['idTypeGame'].'">'.$value['typeGame'].'</option>';
                }
            }
            echo '</select>';
             echo '<label for="valid">Effacer</label>';
            echo '<select id="valid", name="valid">';
                echo '<option value="0">Effacer le jeu des options</option>';
                echo '<option value="1" selected>Non</option>';
            echo '</select>';
            echo '<input type="hidden" name="idGame" value="'.$game['idGame'].'"/>';
                echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
            echo '</div>';
        echo '</form>';
    }
    public function displayAdminGame ($idGame, $idNav) {
        $game = $this->getGameSheet ($idGame);
        $this->formUpdateGame ($game, $idNav);
        
    }
    private function inputForm ($name, $label, $placeholder) {
        echo '<label for="'.$name.'">'.$label.'</label>';
        echo '<input id="'.$name.'" name="'.$name.'" size="'.strlen($placeholder).'" placeholder="'.$placeholder.'"/>';
    }
    private function inputUpdateForm ($name, $label, $value) {
        echo '<label for="'.$name.'">'.$label.'</label>';
        echo '<input id="'.$name.'" name="'.$name.'" value="'.$value.'" size="'.strlen($value).'"/>';
    }
    public function formAddLocation ($idNav) {
        $arrayInput = [['name'=>'nameLocation', 'label'=>'Nom du lieu', 'placeholder'=>'Nom du lieu'],
        ['name'=>'adress', 'label'=>'Adresse', 'placeholder'=>'Adresse'],
        ['name'=>'city', 'label'=>'Ville', 'placeholder'=>'Ville'],
        ['name'=>'zipCode', 'label'=>'Code Postal', 'placeholder'=>'Code Postal'],
        ['name'=>'phone', 'label'=>'Telephone', 'placeholder'=>'Telephone'],];
        echo '<h2 class="subTitleSite">Créer un lieux publique</h2>';
        echo '<form class="customerForm" action="'.encodeRoutage(153).'"  method="post">';
            foreach ($arrayInput as  $value) {
                $this->inputForm ($value['name'], $value['label'], $value['placeholder']);
            }
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
        echo '</form>';
    }
    public function displayLocation ($valid, $private, $idNav) {
        $dataLocation = $this->getLocation ($valid, $private);
        if(!empty($dataLocation)) {
            if($valid == 0) {
                echo '<h2 class="subTitleSite">Lieu non valide.</h2>';
            } else {
                echo '<h2 class="subTitleSite">Lieu valide.</h2>';
            }
            echo '<article class="sixColum box">';
                    echo '<div class="One">';
                    echo 'Nom du lieu';
                    echo '</div>';
                    echo '<div class="Two">';
                    echo 'Adresse';
                    echo '</div>';
                    echo '<div class="Three">';
                    echo 'Code postal';
                    echo '</div>';
                        echo '<div class="Four">';
                    echo 'Ville';
                    echo '</div>';
                        echo '<div class="Five">';
                    echo 'Telephone';
                    echo '</div>';
                        echo '<div class="Six">';
                    echo 'Administration';
                    echo '</div>';
            echo '</article>';
            foreach ($dataLocation as $location) {
                        echo '<article class="sixColum box">';
                    echo '<div class="One">';
                    echo $location['nameLocation'];
                    echo '</div>';
                    echo '<div class="Two">';
                    echo $location['adress'];
                    echo '</div>';
                    echo '<div class="Three">';
                    echo $location['zipCode'];
                    echo '</div>';
                        echo '<div class="Four">';
                    echo $location['city'];
                    echo '</div>';
                        echo '<div class="Five">';
                    echo $location['phone'];
                    echo '</div>';
                        echo '<div class="Six leftAlign">';
                    echo '<a href="'.findTargetRoute(248).'&idLocation='.$location['id'].'">Administrer</a>';;
                    echo '</div>';
            echo '</article>';
            }
        } else {
              if($valid == 0) {
                echo '<h2 class="subTitleSite">Aucun lieu non valide.</h2>';
            } else {
                echo '<h2 class="subTitleSite">Aucun lieu valide dans la base de donnée.</h2>';
            }
              
        }
        

    }
    public function updateFormLocation ($idLocation, $idNav) {
        $dataLocation = $this->getOneLocation ($idLocation);
         $arrayInput = [['name'=>'nameLocation', 'label'=>'Nom du lieu', 'value'=>$dataLocation['nameLocation']],
                        ['name'=>'adress', 'label'=>'Adresse', 'value'=>$dataLocation['adress']],
                        ['name'=>'city', 'label'=>'Ville', 'value'=>$dataLocation['city']],
                        ['name'=>'zipCode', 'label'=>'Code Postal', 'value'=>$dataLocation['zipCode']],
                        ['name'=>'phone', 'label'=>'Telephone', 'value'=>$dataLocation['phone']],];
        echo '<h2 class="subTitleSite">Créer un lieux publique</h2>';
        echo '<form class="customerForm" action="'.encodeRoutage(154).'"  method="post">';
            foreach ($arrayInput as  $value) {
                $this->inputUpdateForm ($value['name'], $value['label'], $value['value']);
            }
            echo '<select id="valid", name="valid">';
                echo '<option value="0">Invalide</option>';
                echo '<option value="1" selected>valide</option>';
            echo '</select>';
            echo '<input type="hidden" name="idLocation" value="'.$dataLocation['id'].'"/>';
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
        echo '</form>';
    }
    private function numberParticipant ($number) {
        echo '<label for="numberParticipants">Nombre de participants</label>';
        echo '<select id="numberParticipants" name="numberParticipants">';
            for ($i=2; $i <= $number ; $i++) { 
               echo '<option value="'.$i.'">'.$i.' joueurs</option>';
            }
        echo '</select>';
    }
    private function gamesList ($gameType) {
        $dataGames = $this->getAllGameByType ($gameType); 
        echo '<label for="idNameGame">Jeu proposé</label>';
        echo '<select id="idNameGam" name="idNameGame">';
            foreach ($dataGames as  $game) {
                echo '<option value="'.$game['id'].'">'.$game['nameGame'].'</option>';
            }
        echo '</select>';
    }
    private function locationList () {
        $dataLocation = $this->getAllLocation ();
        echo '<label for="idNameGame">Jeu proposé</label>';
        echo '<select id="idNameGam" name="idNameGame">';
                    foreach ($dataLocation as  $location) {
                        echo '<option value="'.$location['id'].'">'.$location['nameLocation'].' - '.$location['adress'].' - '.$location['city'].'</option>';
                    }
        echo '</select>';
    }
    protected function formCreatEvent ($idNav, $gameType) {
        echo '<h2 class="subTitleSite">Créer une partie</h2>';
        echo '<form class="customerForm" action="'.encodeRoutage(155).'"  method="post">';
        echo '<label for="nameEvent">Nom de votre événement</label>';
        echo '<input id="nameEvent" type="text" name="nameEvent" placeholder="Nom de votre événement" size="20"/>';
        echo '<label for="objetEvent">Description</label>';
        echo '<textarea id="objetEvent", name="objetEvent" rows="10" cols="60" placeholder="Remplissez une bréve description de la partie."></textarea>';
        echo '<label for="dateEvent">Date</label>';
        echo '<input type="date" id="dateEvent" name="dateEvent"/>';
        echo '<label for="hourEvent">Heure</label>';
        echo '<input type="time" id="hourEvent" name="hourEvent"/>';
        $this->numberParticipant (6);
        $this->gamesList ($gameType);
        $this->locationList ();
        echo '<input type="hidden" name="idTypeGame" value="'.$gameType.'"/>';
        echo '<div class="flex-row-reverse-simple">';
            echo '<label id="check">Assurez vous que les locaux sont libre avant de valider.</label>';
            echo '<input id="check" type="checkbox" name="valid"/>';
        echo '</div>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
        echo '</form>';
    }
    public function displayFormsEvent ($idNav) {
        $dataGameTypes = $this->getAllGameTypes ();
            if(!empty($dataGameTypes)) {
                echo '<article class="flex-colonne-form">';
                echo '<h3 class="titleSite">Ajouter un évément</h3>';
                foreach ($dataGameTypes as $gameType) {
                echo '<details>
                        <summary class="titleSite">
                            '.$gameType['typeGame'].'
                        </summary>';
            $this->formCreatEvent ($idNav, $gameType['id']);
            echo '</details>';
            }
            echo '</article>';
        } else {
            echo '<h3 class="titleSite">Aucun type de jeu dans la base</h3>';
        }
    }
}
