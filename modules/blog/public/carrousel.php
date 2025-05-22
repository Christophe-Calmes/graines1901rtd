<?php
require('modules/blog/objects/templateBlog.php');
$blog = new TemplateBlog ();
$blog->carrouselDisplayPicture (1, 1, 10);
require('modules/blog/javaScript/carrousel.php');