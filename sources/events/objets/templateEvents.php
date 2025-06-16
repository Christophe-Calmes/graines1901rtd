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
        print_r($game['idTypeGame']);
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
}
