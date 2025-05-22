<?php
function brassageDate($data) {
if($data === null) {
  return 'No date';
}

setlocale(LC_ALL, "fr_FR");
  $dateDay = new DateTime($data);
  $formatter = new IntlDateFormatter(
    "fr_FR",
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE
  );
  return $formatter->format($dateDay);
}
function heure($data) {
  $time = $data;
  $heure = substr($time,0,2);
  $minute = substr($time,3,2);
  $data = $heure.'h'.$minute;
  return $data;
}
function dateHeure($data) {
  $date = $data;
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);
  $heure = substr($date,11,2);
  $minute = substr($date,14,2);
  $date = $day.'/'.$month.'/'.$year.' - '.$heure.'H'.$minute;
  return $date;
}
function year($data) {
  $date = $data;
  $year = substr($date,0,4);
  return $year;
}
function formatDateHeureFr($data) {
    if($data === null) {
      return 'No date';
    }
  
    setlocale(LC_ALL, "fr_FR");
    $dateDay = new DateTime($data);
    $formatter = new IntlDateFormatter(
      "fr_FR",
      IntlDateFormatter::FULL,
      IntlDateFormatter::SHORT
    );
    return $formatter->format($dateDay);
}
function justHeureFr($data) {
  if($data === null) {
    return 'No date';
  }

  setlocale(LC_ALL, "fr_FR");
  $dateDay = new DateTime($data);
  $formatter = new IntlDateFormatter(
    "fr_FR",
    IntlDateFormatter::NONE,
    IntlDateFormatter::NONE,
    null,
    null,
    "HH'h'mm" 
  );
  return $formatter->format($dateDay);
}
function dateAndTimeAgendaGoogle ($date) {
  $dateTime = new DateTime($date);
  $date_format = $dateTime->format("Ymd\THis");
  return $date_format;
}
