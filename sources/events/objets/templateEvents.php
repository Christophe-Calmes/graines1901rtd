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
}
