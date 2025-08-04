<?php
require('sources/events/objets/sqlEvents.php');
require ('functions/functionDateTime.php');

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
    public function formAddLocation ($idNav, $private = 0) {
        $arrayInput = [['name'=>'nameLocation', 'label'=>'Nom du lieu', 'placeholder'=>'Nom du lieu'],
        ['name'=>'adress', 'label'=>'Adresse', 'placeholder'=>'Adresse'],
        ['name'=>'city', 'label'=>'Ville', 'placeholder'=>'Ville'],
        ['name'=>'zipCode', 'label'=>'Code Postal', 'placeholder'=>'Code Postal'],
        ['name'=>'phone', 'label'=>'Telephone', 'placeholder'=>'Telephone'],];
        if($private == 0)  {
            
            echo '<h2 class="subTitleSite">Créer un lieu publique</h2>';
            $route = 153;
        } else  {
            echo '<h2 class="subTitleSite">Créer un lieu privé</h2>';
            $route = 176;
        }
        
        echo '<form class="customerForm" action="'.encodeRoutage($route).'"  method="post">';
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
    public function updateFormLocation ($idLocation, $idNav, $owner = 0) {
        if($owner == 0) {
            $route = 154;
            $message = 'public';
        } else {
            $route = 177;
            $message = 'privé';
        }
        $dataLocation = $this->getOneLocation ($idLocation);
         $arrayInput = [['name'=>'nameLocation', 'label'=>'Nom du lieu', 'value'=>$dataLocation['nameLocation']],
                        ['name'=>'adress', 'label'=>'Adresse', 'value'=>$dataLocation['adress']],
                        ['name'=>'city', 'label'=>'Ville', 'value'=>$dataLocation['city']],
                        ['name'=>'zipCode', 'label'=>'Code Postal', 'value'=>$dataLocation['zipCode']],
                        ['name'=>'phone', 'label'=>'Telephone', 'value'=>$dataLocation['phone']],];
        echo '<h2 class="subTitleSite">Modifier un lieux '.$message.'</h2>';
        echo '<form class="customerForm" action="'.encodeRoutage($route).'"  method="post">';
            foreach ($arrayInput as  $value) {
                $this->inputUpdateForm ($value['name'], $value['label'], $value['value']);
            }
            echo '<label id="valid">Lieu valide ?</label>';
            echo '<select id="valid", name="valid">';
            $valid = [['value'=>0, 'name'=>'Invalide'], ['value'=>1, 'name'=>'Valide']];
            foreach ($valid as $name) {
                if($dataLocation['valid'] == $name['value']) {
                    echo '<option value="'.$name['value'].'" selected>'.$name['name'].'</option>';
                } else {
                    echo '<option value="'.$name['value'].'">'.$name['name'].'</option>';
                }
                 
            }
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
    private function numberParticipantSelected ($number, $selected) {
        echo '<label for="numberParticipants">Nombre de participants</label>';
        echo '<select id="numberParticipants" name="numberParticipants">';
            for ($i=2; $i <= $number ; $i++) { 
                if($selected == $i) {
                    echo '<option value="'.$i.'" selected>'.$i.' joueurs</option>';
                } else {
                    echo '<option value="'.$i.'">'.$i.' joueurs</option>';
                }
               
            }
        echo '</select>';
    }
    private function gamesList ($gameType) {
        $dataGames = $this->getAllGameByType ($gameType); 
        echo '<label for="idNameGame">Jeu proposé</label>';
        echo '<select id="idNameGame" name="idNameGame">';
            foreach ($dataGames as  $game) {
                echo '<option value="'.$game['id'].'">'.$game['nameGame'].'</option>';
            }
        echo '</select>';
    }
    private function gamesListSelected ($gameType, $idNameGame) {
        $dataGames = $this->getAllGameByType ($gameType); 
        echo '<label for="idNameGame">Jeu proposé</label>';
        echo '<select id="idNameGame" name="idNameGame">';
            foreach ($dataGames as  $game) {
                if($game['id'] == $idNameGame) {
                    echo '<option value="'.$game['id'].'" selected>'.$game['nameGame'].'</option>';
                } else {
                    echo '<option value="'.$game['id'].'">'.$game['nameGame'].'</option>';
                }
            }
        echo '</select>';
    }
    private function locationList () {
        $dataLocation = $this->getAllLocation ();
        echo '<label for="idLocation">Jeu proposé</label>';
        echo '<select id="idLocation" name="idLocation">';
                    foreach ($dataLocation as  $location) {
                        echo '<option value="'.$location['id'].'">'.$location['nameLocation'].' - '.$location['adress'].' - '.$location['city'].'</option>';
                    }
        echo '</select>';
    }
    private function locationListSelected ($idLocation) {
        $dataLocation = $this->getAllLocation ();
        echo '<label for="idNameGame">Jeu proposé</label>';
        echo '<select id="idNameGam" name="idLocation">';
                    foreach ($dataLocation as  $location) {
                        if($location['id'] == $idLocation) {
                            echo '<option value="'.$location['id'].'" selected>'.$location['nameLocation'].' - '.$location['adress'].' - '.$location['city'].'</option>';
                        } else {
                            echo '<option value="'.$location['id'].'">'.$location['nameLocation'].' - '.$location['adress'].' - '.$location['city'].'</option>';
                        }
                        
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
        echo '<div class="flex-row-reverse-simple">';
            echo '<label id="check">Assurez vous que les locaux sont libre avant de valider.</label>';
            echo '<input id="check" type="checkbox" name="valid"/>';
        echo '</div>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
        echo '</form>';
    }
    protected function formUpdateEvent ($idNav, $gameType, $detailOneEvent) {
        
        echo '<form class="customerForm" action="'.encodeRoutage(162).'"  method="post">';
        echo '<h2 class="subTitleSite">Modifier une partie : '.$detailOneEvent['typeGame'].'</h2>';
       
        echo '<label for="nameEvent">Nom de votre événement</label>';
        echo '<input id="nameEvent" type="text" name="nameEvent" value="'.$detailOneEvent['nameEvent'].'" size="'.strlen($detailOneEvent['nameEvent']).'"/>';
        echo '<label for="objetEvent">Description</label>';
        echo '<textarea id="objetEvent", name="objetEvent" rows="10" cols="60" placeholder="Remplissez une bréve description de la partie.">'.$detailOneEvent['objetEvent'].'</textarea>';
        echo '<label for="dateEvent">Date</label>';
        echo '<input type="date" id="dateEvent" name="dateEvent" value="'.$detailOneEvent['dateEvent'].'"/>';
        echo '<label for="hourEvent">Heure</label>';
        echo '<input type="time" id="hourEvent" name="hourEvent" value="'.$detailOneEvent['hourEvent'].'"/>';
        $this->numberParticipantSelected  (6, $detailOneEvent['numberParticipants']);
        $this->gamesListSelected ($gameType, $detailOneEvent['idNameGame']);
        $this->locationListSelected ($detailOneEvent['idLocation']) ;
        echo '<input type="hidden" name="idEvent" value="'.$detailOneEvent['idEvent'].'"/>';
        echo '<div class="flex-row-reverse-simple box">';
          echo '<label id="check"><p>Assurez vous que les locaux sont libre avant de valider.</p>
                <p>Modifier la date engendre la perte des inscriptions à la partie, sauf la votre.</p>
                <p>Clic sur la checkbox si tu as compris.</p></label>';
            echo '<p><input class="paddingLeft" id="check" type="checkbox" name="valid"/></p>';
        echo '</div>';
        
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
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
    private function register ($dataRegister, $idEvent, $idNav) {
        $idUser = new Controles ();
        $idParticipant = $idUser->idUser($_SESSION);
        $idUser = array_column($dataRegister, 'idUser');
        $matchId = array_search($idParticipant, $idUser);
        return $matchId;
    }
    private function subscribEvent ($matchId, $idNav, $idEvent) {
        if($matchId === false) {
            echo '<form action="'.encodeRoutage(157).'"  method="post">';
            echo '<input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Inscription</button>';
            echo '</form>';
        }
    }
    private function unSubscribEvent ($matchId, $idNav, $idEvent) {
        if($matchId !== false) {
            echo '<form action="'.encodeRoutage(158).'"  method="post">';
            echo '<input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Désinscription</button>';
            echo '</form>';
        }
    }
    private function displayRegister ($idEvent, $idNav, $numberMax) {
        $dataRegister = $this->registerEvent ($idEvent);
        $actual = $this->countParticipantsOneEvent ($idEvent);
        echo '<ul class="listClass">';
        echo '<li><h4 class="titleEventItem">Liste des inscrits ('.$actual.'/'.$numberMax.') :</h4></li>';
        foreach ($dataRegister as $speudo) {
            echo '<li>'.$speudo['login'].'</li>';
        }
       echo '</ul>';
       $matchId = $this->register ($dataRegister, $idEvent, $idNav);
       $delta = $numberMax- $actual;
       if($matchId !== false) {
            $this->unSubscribEvent ($matchId, $idNav, $idEvent);
       }
       if($delta>0) {
        $this->subscribEvent ($matchId, $idNav, $idEvent);
       }
    }
    private function displayRegisterAdmin ($idEvent, $idNav, $numberMax) {
        $dataRegister = $this->registerEvent ($idEvent);
        $actual = $this->countParticipantsOneEvent ($idEvent);
        echo '<ul class="listClass">';
        echo '<li><h4 class="titleEventItem">Liste des inscrits ('.$actual.'/'.$numberMax.') :</h4></li>';
        foreach ($dataRegister as $speudo) {
            echo '<li>'.$speudo['login'].'</li>';
        }
       echo '</ul>';
    }

    private function deleteEvent ($idEvent, $idNav) {
            echo '<form action="'.encodeRoutage(156).'"  method="post">';
            echo '<div class="flex-row-reverse-simple">';
            echo '<label id="check">Vous êtes certain de détruire cette événement ?</label>';
            echo '<input id="check" type="checkbox" name="valid"/>';
            echo '</div>';
            echo '<input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>';
            echo '</form>';
    }
    protected function displayEvent ($valid, $moment, $admin, $idNav) {
        $dataEvents = $this->getMyEvent ($valid, $moment);
        if($moment == true) {
            $message = '<h2 class="subTitleSite">Evénement à venir</h2>';
        } else {
              $message = '<h2 class="subTitleSite">Evénement passé</h2>';
        }
        if(!empty($dataEvents)) {
            echo $message;
            echo '<main class="gallery">';
                    foreach ($dataEvents as $detail) {
                        echo '<article class="item">';
                            echo '<ul class="listClass">';
                 
                                echo '<li class="subTitleSite">'.$detail['nameEvent'].'</li>';
                                if($admin) {
                                    echo '<li><a class="link" href="'.findTargetRoute(258).'&idEvent='.$detail['idEvent'].'">Administrer</a></li>';
                                }
                                echo '<li>Le '.brassageDate($detail['dateEvent']).' à '.$detail['hourEvent'].'</li>';
                                echo '<li><p>'.$detail['objetEvent'].'</p></li>';
                                echo '<li>Type de jeu  : '.$detail['typeGame'].'</li>';
                                echo '<li>Nom du jeu  : '.$detail['nameGame'].'</li>';
                                echo '<li>Lieu : '.$detail['nameLocation'].'</li>';
                                echo '<li>Adresse : '.$detail['adress'].', '.$detail['zipCode'].' '.$detail['city'].'</li>';
                                echo '<li>Telephone : '.$detail['phone'].'</li>';
                                echo '<li>Date de création : '.formatDateHeureFr($detail['creat_date']).'</li>';
                                if(($admin)&&($detail['dateEvent']<date('Y-m-d'))) {
                                 echo '<li>'.$this->deleteEvent ($detail['idEvent'], $idNav).'</li>';
                                }
                          
                                $this->displayRegister ($detail['idEvent'], $idNav, $detail['numberParticipants']);
             
                            echo '</ul>';
                        echo '</article>';
                    }
                echo '</main>';
        }
        if(!empty($dataEvent)) {
            echo '<td><a href="'.findTargetRoute(249).'">Créer un événement ?</a>';
        }
    }

    public function adminMyEvent ($sort, $idNav) {
        // $sort = [$valid(bool), $moment(bool), $admin(bool)]
        $this->displayEvent ($sort[0], $sort[1], $sort[2], $idNav);
    }
    private function googleDateFormat ($dateEvent) {
        $dateTime = new DateTime($dateEvent);
        $formattedDate = $dateTime->format('Ymd');
        return $formattedDate . '/' . $formattedDate;
    }
    private function oneEventSheet ($detail, $idNav) {
                   echo '<article class="item">';
                            echo '<ul class="listClass">';
                                $fullAddress = htmlspecialchars_decode($detail['adress'].', '.$detail['zipCode'].' '.$detail['city']);
                                echo '<li><a class="link" href="https://calendar.google.com/calendar/render?action=TEMPLATE&text='.urlencode($detail['nameEvent']).'&dates='.$this->googleDateFormat($detail['dateEvent']).'&details='.urlencode($detail['nameGame']).'&location='.urlencode($fullAddress).'&sf=true&output=xml" target="_blank">Ajouter à Google Agenda</a></li>';
                                echo '<li class="subTitleSite">'.$detail['nameEvent'].'</li>';
                                echo '<li>Le '.brassageDate($detail['dateEvent']).' à '.$detail['hourEvent'].'</li>';
                                echo '<li><p>'.$detail['objetEvent'].'</p></li>';
                                echo '<li>Type de jeu  : '.$detail['typeGame'].'</li>';
                                echo '<li>Nom du jeu  : '.$detail['nameGame'].'</li>';
                                echo '<li>Lieu : '.$detail['nameLocation'].'</li>';
                                echo '<li>Adresse : '.$detail['adress'].', '.$detail['zipCode'].' '.$detail['city'].'</li>';
                                echo '<li>Telephone : '.$detail['phone'].'</li>';
                               $this->displayRegister ($detail['idEvent'], $idNav, $detail['numberParticipants']);
                            echo '</ul>';
                        echo '</article>';
    }
    private function deleteEventByGestionnaire ($idEvent, $idNav) {
     echo '<li>
                <form action="'.encodeRoutage(161).'"  method="post">';
                        echo '<div class="flex-row-reverse-simple box">';
                        echo '<label id="check">Vous êtes certain de détruire cette événement ?</label>';
                        echo '<input id="check" type="checkbox" name="valid"/>';
                        echo '</div>';
                        echo '<input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
                        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>';
            echo '</form>
        </li>';
    }
    private function oneAdminEventSheet ($detail, $idNav) {
                   echo '<article class="item">';
                            echo '<ul class="listClass">';
                                $fullAddress = htmlspecialchars_decode($detail['adress'].', '.$detail['zipCode'].' '.$detail['city']);
                                echo '<li><a class="link" href="https://calendar.google.com/calendar/render?action=TEMPLATE&text='.urlencode($detail['nameEvent']).'&dates='.dateAndTimeAgendaGoogle($detail['dateEvent']).'&details='.urlencode($detail['nameGame']).'&location='.urlencode($fullAddress).'&sf=true&output=xml" target="_blank">Ajouter à Google Agenda</a></li>';
                                echo '<li class="subTitleSite">'.$detail['nameEvent'].'</li>';
                                echo '<li>Le '.brassageDate($detail['dateEvent']).' à '.$detail['hourEvent'].'</li>';
                                echo '<li><p>'.$detail['objetEvent'].'</p></li>';
                                echo '<li>Type de jeu  : '.$detail['typeGame'].'</li>';
                                echo '<li>Nom du jeu  : '.$detail['nameGame'].'</li>';
                                echo '<li>Lieu : '.$detail['nameLocation'].'</li>';
                                echo '<li>Adresse : '.$detail['adress'].', '.$detail['zipCode'].' '.$detail['city'].'</li>';
                                echo '<li>Telephone : '.$detail['phone'].'</li>';
                                    $this->displayRegisterAdmin  ($detail['idEvent'], $idNav, $detail['numberParticipants']);
                                    $this->deleteEventByGestionnaire ($detail['idEvent'], $idNav);
                            echo '</ul>';
                        echo '</article>';
    }


    public function actualEvent ($idNav) {
        $dataActualEvent = $this->getActualEvent ();
        if(!empty($dataActualEvent)) {
            echo '<h2 class="subTitleSite">Evénement à venir</h2>';;
            echo '<main class="gallery">';
                    foreach ($dataActualEvent as $detail) {
                        $this->oneEventSheet ($detail, $idNav);
                    }
                echo '</main>';
        }
    }
    public function myAgenda ($idNav) {
        $dataMyAgenda = $this->getMyAgenda ();
         if(!empty($dataMyAgenda)) {
            echo '<h2 class="subTitleSite">Votre agenda</h2>';
            echo '<main class="gallery">';
                    foreach ($dataMyAgenda as $detail) {
                            $this->oneEventSheet ($detail, $idNav);
                    }
                echo '</main>';
        } else {
                echo '<h2 class="subTitleSite">Votre agenda est vide</h2>';
        }

    }
    private function formUpdateTypeGame ($idTypeGame, $idNav, $valid) {
        echo '<form action="'.encodeRoutage(160).'"  method="post">';
            echo '<input type="hidden" name="idTypeGame" value="'.$idTypeGame.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.($valid ? 'Invalide' : 'Valide').'</button>';
        echo '</form>';
    }
    private function displayGameTypeAdmin ($data, $valid, $idNav) {
        if($valid == 1) {
            echo '<h2 class="subTitleSite">Type de jeux valide</h2>';
        }
        if($valid == 0) {
            echo '<h2 class="subTitleSite">Type de jeux invalide</h2>';
        }
            echo '<article class="tripleColum box">';
                echo '<div class="One">Type de jeu</div>';
                echo '<div class="Two">Valide ?</div>';
                echo '<div class="Three">Administrer</div>';
            echo '</article>';
            foreach ($data as $detail) {
               echo '<article class="tripleColum box">';
                echo '<div class="One">';
                    echo $detail['typeGame'];
                echo '</div>';
                echo '<div class="Two">';
                    echo ($detail['valid'] ? 'Oui' : 'Non');
                echo '</div>';
                echo '<div class="Three">';
                    $this->formUpdateTypeGame ($detail['idTypeGame'], $idNav, $detail['valid']);
                echo '</div>';
                echo '</article>';
            }
           

    }

    public function displayGameType ($idNav) {
        $dataGameTypeValid = $this->getGamesTypesAdmin (1);
        $dataGameTypeUnvalid = $this->getGamesTypesAdmin (0);
        if(!empty($dataGameTypeValid)) {
            $this->displayGameTypeAdmin ($dataGameTypeValid, 1, $idNav) ;
        }
        if(!empty($dataGameTypeUnvalid )){
            $this->displayGameTypeAdmin ($dataGameTypeUnvalid, 0, $idNav) ;
        }
    }
    public function formGameType ($idNav) {
        echo '<form class="customerForm" action="'.encodeRoutage(159).'"  method="post">';
            echo '<label for="typeGame">Nom du Type</label>';
            echo '<input id="typeGame" type="text" name="typeGame" placeholder="Nouveau type" />';
            echo '<div class="flex-row-reverse-simple">';
            echo '<label id="check">Assurez vous que ce type de jeu soit valide.</label>';
            echo '<input id="check" type="checkbox" name="valid"/>';
        echo '</div>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
        echo '</form>';

    }
    public function displayBilanEvents () {
        $dataBilan = $this->getAllDateBilan ();
        echo '<h2 class="subTitleSite">Bilans nombre événements</h2>';
           echo '<article class="tripleColum box">';
                echo '<div class="One">Date démarrage bilan</div>';
                echo '<div class="Two">Date fin de bilan</div>';
                echo '<div class="Three">Nombre de parties</div>';
            echo '</article>';
        foreach ($dataBilan as $value) {
            echo '<article class="tripleColum">';
                echo '<div class="One box">'.brassageDate($value['openCompta']).'</div>';
                echo '<div class="Two box">'.brassageDate($value['closeCompta']).'</div>';
                echo '<div class="Three box">'.$value['nombre_evenements'].'</div>';
            echo '</article>';
        }
    }

    public function displayAdminEvents ($firstPage, $parPage, $past, $idNav) {
        $dataEvents = $this->GetEvents ($firstPage, $parPage, $past);
            echo '<main class="gallery">';
                foreach ($dataEvents as  $detail) {
                    $this->oneAdminEventSheet ($detail, $idNav);
                }
            echo '</main>';
    }
    public function updateFormEvent ($idEvent, $idNav) {
        $detailOneEvent = $this->getOneEvent ($idEvent);
        if(!empty($detailOneEvent)) {
            $detailOneEvent = $detailOneEvent[0];
                    $this->formUpdateEvent ($idNav, $detailOneEvent['idTypeGame'], $detailOneEvent);
        } else {
            echo '<h2 class="subTitleSite">Donnée inaccessible, contacter l\'administrateur ?</h2>';
        }
      
    }
    private function onePublicEventSheet ($detail) {
                   echo '<article class="item">';
                            echo '<ul class="listClass">';
                                $fullAddress = htmlspecialchars_decode($detail['adress'].', '.$detail['zipCode'].' '.$detail['city']);
                                echo '<li class="subTitleSite">'.$detail['nameEvent'].'</li>';
                                echo '<li>Le '.brassageDate($detail['dateEvent']).' à '.$detail['hourEvent'].'</li>';
                                echo '<li><p>'.$detail['objetEvent'].'</p></li>';
                                echo '<li>Type de jeu  : '.$detail['typeGame'].'</li>';
                                echo '<li>Nom du jeu  : '.$detail['nameGame'].'</li>';
                                if($detail['private'] == 0) {
                                    echo '<li>Lieu : '.$detail['nameLocation'].'</li>';
                                    echo '<li>Adresse : '.$fullAddress.'</li>';
                                } else {
                                    echo '<li>Adresse : Lieu privé</li>';
                                }
                           
                                $dataRegister = $this->registerEvent ($detail['idEvent']);
                                $actual = $this->countParticipantsOneEvent ($detail['idEvent']);
                                echo '<li><h4 class="titleEventItem">Liste des inscrits ('.$actual.'/'.$detail['numberParticipants'].')</h4></li>';
                            echo '</ul>';
                        echo '</article>';
    }
    public function publicFuturEvent (){
        $dataActualEvent = $this->getActualEvent ();
        if(!empty($dataActualEvent)) {
        echo '<h4 class="titleEventItem">Nos futurs événements</h4>';
        
          echo '<main class="gallery">';
                foreach ($dataActualEvent as $detail) {
                    $this->onePublicEventSheet ($detail);
                }
          echo '</main>';
    
        } else {
            echo '<h2 class="titleEventItem">Aucun événement à venir.</h2>';
        }
        echo '<article class="formAdmin">';
            echo '<a href="'.findTargetRoute(73).'">Nous rejoindre ?</a>';
        echo '</article>';

    }
    public function displayPrivateOwnerLocation ($valid) {
        $dataPrivateLocation = $this->getOwnerPrivateLocation ($valid);
         if(!empty($dataPrivateLocation)) {
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
            foreach ($dataPrivateLocation as $location) {
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
                    echo '<a href="'.findTargetRoute(266).'&idLocation='.$location['id'].'">Administrer</a>';;
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
    public function KPIEventsActualBilan () {

        $dataEventsActualBilan = $this->getLastKPIEvents ()[0];
        $numberActualEventInBilan = $this->getNumberEventsInBilan ()[0];
        $inscriptionNet = $dataEventsActualBilan['nrRegister'] - $dataEventsActualBilan['nbrDeleteRegister'];
        if($dataEventsActualBilan['nbrEvents'] != 0) {
            $moyenInscritByEvent = $inscriptionNet/$dataEventsActualBilan['nbrEvents'];
        } else {
             $moyenInscritByEvent = 0;
        }

           echo '<h2 class="subTitleSite">Résultat des événements du bilan actuel</h2>';
        echo '<ul class="listeProfil">';
            echo '<li>Nombre événements créer par les adhérants : '.$dataEventsActualBilan['nbrEvents'].'</li>';
            echo '<li>Nombre d\'événements actuellement en ligne :  '.$numberActualEventInBilan['nombre_evenements'].'</li>';
            echo '<li>Total des inscrites à un événements : '.$inscriptionNet.' personnes</li>';
            echo '<li>Nombre événements supprimer par un modérateur : '.$dataEventsActualBilan['nbrDeleteEvents'].'</li>';
            echo '<li>Nombre moyen d\'inscrit par événements : '.round($moyenInscritByEvent, 2).' personnes / événement</li>';
        echo '</ul>';

    }
}
