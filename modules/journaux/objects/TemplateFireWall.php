<?php
require ('modules/journaux/objects/SQLbanIP.php');
require ('functions/functionDateTime.php');
Class TemplateFireWall extends SQLFireWall {
    public function displayAllBanIP ($idNav) {
        $dataIPBan = $this->getAllBanIP ();
        if(!empty($dataIPBan)){
            echo '<div class="flex-rows">
            <table>';
            echo '<caption><h3>Tableau des IP bannis</h3></caption>';
            echo '<thead>
                    <tr>
                        <th>IP</th>
                        <th>Date</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                ';
                foreach($dataIPBan as $value) {
                    echo '<tr>
                            <td>'.$value['BanIP'].'</td>
                            <td>'.brassageDate($value['dateCreat']).'</td>
                            <td> <form class="flex-colonne" action="'.encodeRoutage(63).'" method="post">
                            <input type="hidden" name="id" value="'.$value['id'].'"/>
                            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Del IP ban</button>
                          </form></td>
                    </tr>';
                }
            echo '
            </tbody>
            </table>
            </div>';
        } else {
            echo 'No IP ban';
        }
         
  
    }
    public function addIPBan ($idNav) {
        echo '<div class="flex-rows">
                <form class="flex-colonne" action="'.encodeRoutage(64).'" method="post">
                    <label for="ip">IP à bannir</label>
                    <div class="flex-row">
                        <input id="ip" type="number" name="membre1" min="0" max="255" value="127"/>
                        .
                        <input id="ip" type="number" name="membre2" min="0" max="255" value="0"/>
                        .
                        <input id="ip" type="number" name="membre3" min="0" max="255" value="0"/>
                        .
                        <input id="ip" type="number" name="membre4" min="0" max="255" value="1"/>
                    </div>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Add IP ban</button>
                </form>
            </div>';
    }
}