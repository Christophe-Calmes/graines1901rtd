<form class="customerForm" action="<?php echo encodeRoutage(130); ?>" method="post" enctype="multipart/form-data">
    <label for="subject">Catégorie</label>
    <input id="subject" type="text" name="subject" placeholder="Nouvelle catégorie"/>
    <lable for="occurance">Ordre apparition</label>
    <input type="number" id="occurance" name="occurance" min="0" max="15" value="1"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?php echo $idNav; ?>">Créer</button>
</form>
<?php
require ('modules/blog/objects/templateBlog.php');
$displayCategories = new TemplateBlog ();
$displayCategories->displayUpdateCategorie (1, $idNav);
$displayCategories->displayUpdateCategorie (0, $idNav);
