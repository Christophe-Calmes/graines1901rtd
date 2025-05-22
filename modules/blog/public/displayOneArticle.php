<?php
// findTargetRoute(214, 215, 216, 215)
require('modules/blog/objects/templateBlog.php');
$idArticle = filter($_GET['idArticle']);
$blog = new TemplateBlog ();
$blog->menuCategorieBlog ();
$blog->displayOneArticleOfBlog ($idArticle, 1);
