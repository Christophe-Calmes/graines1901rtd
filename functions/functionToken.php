<?php
function genToken ($size) {
    $alpha = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $caharacters = strlen($alpha);
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = random_int(0, $caharacters -1);
      $letter = substr($alpha, $number, 1);
      $token = $token.$letter;
    }
    return $token;
}
function IntToken ($size) {
    $alpha = '1234567890';
    $caharacters = strlen($alpha);
    $token = '';
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = random_int(0, $caharacters -1);
      $token = $token.$alpha[$number];
    }
    return $token;
}
