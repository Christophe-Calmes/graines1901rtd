<?php 
require ('modules/blog/objects/templateBlog.php');
$formNewArticle = new TemplateBlog ();
?>
<form class="customerForm" action="<?php echo encodeRoutage(129); ?>" method="post" enctype="multipart/form-data">
    <label for="title">Titre article</label>
    <input id="title" type="text" name="title" placeholder="Titre"/>
    <label for="article">Texte de votre article</label>
    <div class="flex-clos">
        <div>
            <p class="link" onclick="insererMarqueur('sh2')">&lt;h2&gt;</p>
            <p class="link" onclick="insererMarqueur('eh2')">&lt;/h2&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sh3')">&lt;h3&gt;</p>
            <p class="link" onclick="insererMarqueur('eh3')">&lt;/h3&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sh4')">&lt;h4&gt;</p>
            <p class="link" onclick="insererMarqueur('eh4')">&lt;/h4&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sArt')">&lt;article&gt;</p>
            <p class="link" onclick="insererMarqueur('eArt')">&lt;/article&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sP')">&lt;p&gt;</p>
            <p class="link" onclick="insererMarqueur('eP')">&lt;/p&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sSt')">&lt;strong&gt;</p>
            <p class="link" onclick="insererMarqueur('eSt')">&lt;/strong&gt;</p>
        </div>
        <div>
            <p class="link" onclick="insererMarqueur('sl')">&lt;ul&gt;</p>
            <p class="link" onclick="insererMarqueur('el')">&lt;/ul&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sli')">&lt;li&gt;</p>
            <p class="link" onclick="insererMarqueur('eli')">&lt;/li&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('*')">&lt;br/&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('link')">&lt;a href="[urlLink]"&gt;name_Link&lt;a&gt;</p>
            |
            <p class="link" onclick="insererMarqueur('sCenter')">&lt;center&gt;</p>
            <p class="link" onclick="insererMarqueur('eCenter')">&lt;/center&gt;</p>
        </div>
    </div>
    <textarea id="article" name="article" rows="10" cols="70"></textarea>
    <label for="meta">Meta description de votre article</label>
    <input type="text" id="meta" name="meta" placeholder="meta description de l'article"/>
    <label for="publish">Publication ?</label>
    <select id="status" name="publish">
        <option value="0">En rédaction</option>
        <option value="1">publier</option>
    </select>
    <?php
        $formNewArticle->selectSubject ();
    ?>

    <button class="buttonForm" type="submit" name="idNav" value="<?php echo $idNav; ?>">Submit</button>
</form>
<script>
        function insererMarqueur(marqueur) {
            let textarea = document.getElementById("article");
            let position = textarea.selectionStart;
            let texte = textarea.value;
            let nouveauTexte;

            switch (marqueur) {
                case 'sArt':
                    nouveauTexte = texte.substring(0, position) + "*sArt*" + texte.substring(position);
                    break;
                case 'eArt':
                    nouveauTexte = texte.substring(0, position) + "*eArt*" + texte.substring(position);
                    break;
                case 'sl':
                    nouveauTexte = texte.substring(0, position) + "*sl*" + texte.substring(position);
                    break;
                case 'el':
                    nouveauTexte = texte.substring(0, position) + "*el*" + texte.substring(position);
                    break;
                case 'sli':
                    nouveauTexte = texte.substring(0, position) + "*sli*" + texte.substring(position);
                    break;
                case 'eli':
                    nouveauTexte = texte.substring(0, position) + "*eli*" + texte.substring(position);
                    break;
                case 'sP':
                    nouveauTexte = texte.substring(0, position) + "*sP*" + texte.substring(position);
                    break;
                case 'eP':
                    nouveauTexte = texte.substring(0, position) + "*eP*" + texte.substring(position);
                    break;
                case 'sh2':
                    nouveauTexte = texte.substring(0, position) + "*sh2*" + texte.substring(position);
                    break;
                case 'eh2':
                    nouveauTexte = texte.substring(0, position) + "*eh2*" + texte.substring(position);
                    break;
                case 'sh3':
                    nouveauTexte = texte.substring(0, position) + "*sh3*" + texte.substring(position);
                    break;
                case 'eh3':
                    nouveauTexte = texte.substring(0, position) + "*eh3*" + texte.substring(position);
                    break;
                case 'sh4':
                    nouveauTexte = texte.substring(0, position) + "*sh4*" + texte.substring(position);
                    break;
                case 'eh4':
                    nouveauTexte = texte.substring(0, position) + "*eh4*" + texte.substring(position);
                    break;
                case 'sSt':
                    nouveauTexte = texte.substring(0, position) + "*sSt*" + texte.substring(position);
                break;
                case 'eSt':
                    nouveauTexte = texte.substring(0, position) + "*eSt*" + texte.substring(position);
                break;
                case 'sCenter':
                    nouveauTexte = texte.substring(0, position) + "*sCenter*" + texte.substring(position);
                break;
                case 'eCenter':
                    nouveauTexte = texte.substring(0, position) + "*eCenter*" + texte.substring(position);
                break;
                case 'link':
                nouveauTexte = texte.substring(0, position) + "*ea*[urlLink]*nameLink*ca*" + texte.substring(position);
                break;
                case '*':
                    nouveauTexte = texte.substring(0, position) + "*" + texte.substring(position);
                    break;
            }

            textarea.value = nouveauTexte;
        }
    </script>
