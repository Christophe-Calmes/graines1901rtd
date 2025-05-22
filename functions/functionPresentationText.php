<?php
function listHTML($data, $class) {
    $StepUL = str_replace('ulStart','<ul class="'.$class.'">',$data);
    $stepUlEnd = str_replace('ulEnd','</ul>',$StepUL);
    $stepLI = str_replace('listStart','<li>',  $stepUlEnd);
    $text = str_replace('liEnd','</li>', $stepLI);
    return $text;
}
function lineBreak($data) {
   return str_replace('*','<br/>', $data); 
}
function strongHTML($data){
    $setp1 = str_replace('strongStart', '<strong class="dayweek">', $data);
    return str_replace('EndStrong', ' </strong>', $setp1);
}
function selectHTML($data, $label, $selectList) {
    echo '<div class="publish">
    '.$selectList[$data].'
    <label for="'.$label.'"></label>';
    echo '<select name="'.$label.'">';
    for ($i=0; $i <count($selectList); $i++) { 
        if($data == $i) {
            echo '<option value="'.$i.'" selected>'.$selectList[$i].'</option>';
        } else {
            echo '<option value="'.$i.'">'.$selectList[$i].'</option>';
        }
    }
    echo '</select></div>';  
}