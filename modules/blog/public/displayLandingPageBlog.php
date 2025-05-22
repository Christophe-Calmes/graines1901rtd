<?php
require('modules/blog/objects/templateBlog.php');
$blog = new TemplateBlog ();
$blog->menuCategorieBlog ();
$blog->displayLastArticle ();
