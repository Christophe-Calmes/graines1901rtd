
<div>
<button type="button" id="magic" class="open">Ouvrir le formulaire</button>
</div>
<div id="hiddenForm">
<form class="customerForm" action="<?php echo encodeRoutage(134); ?>" method="post" enctype="multipart/form-data">
    <label for="altImg">Alternate text</label>
    <input id="altImg" type="text" name="altImg" placeholder="Alt text for picture"/>
    <label for="name_picture">Picture for blog</label>
    <input id="name_picture" type="file" name="name_picture" accept="image/png, image/jpeg, image/webp"/>
    <label for="carrousellePicture">Carrouselle ?</label>
    <select id="carrousellePicture" name="carrousellePicture">
        <option value="0" selected>Non</option>
        <option value="1">Oui</option>
    </select>
    <button class="buttonForm" type="submit" name="idNav" value="<?php echo $idNav; ?>">Record picture</button>
</form>
</div>
<?php
require ('javaScript/magicButtonMenus.php');
require ('functions/functionPagination.php');
require ('modules/blog/objects/templateBlog.php');
$displayPicture = new TemplateBlog ();

if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
    echo '<p class="page">Page : '.$currentPage.'</p>';
} else {
    $currentPage = 1;
}
$nbrPicture = $displayPicture->nbrMiniaturePicture ();
$PictureByPage = 4;
$pages = ceil($nbrPicture/$PictureByPage);
$firstPage = ($currentPage * $PictureByPage) - $PictureByPage;
$displayPicture->displayImgCode (1, $idNav, $firstPage, $PictureByPage);

for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }