<?php
if(isset($_GET['idArticle'])) {
  require_once('modules/blog/objects/sqlBlog.php');
  $idArticle = filter($_GET['idArticle']);
  $metaArticle = new SQLblog ();
  $description = $metaArticle->getMetaArticle($idArticle, $description);

}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$description?>">
    <meta name="Cache-Control" content="max-age=31536000">
    <link rel="stylesheet" href="<?=$css?>" media="screen">
    <link rel="stylesheet" href="<?=$css?>" media="print">
    <title><?=$title?></title>
</head>
  <body class="gridPage">
     
