<?php
require ('modules/blog/objects/PresentationHTML.php');
require ('functions/functionDateTime.php');
class TemplateBlog extends PresentationHTML
{
    private function updateSubject ($data, $idNav) {
        echo '<form class="listRow" action="'.encodeRoutage(131).'" method="post">';
            echo '<label for="subject">Categorie</label>';
                echo '<input id="subject" type="text" name="subject" value="'.$data['subject'].'"/>';
            echo '<input type="hidden" name="id" value="'.$data['id'].'"/>';
            echo '<label for="valid">Valid</label>';
                echo '<select name="valid">';
                    $array_valid = ['No valid', 'Valid'];
                    for ($i=0; $i <=1 ; $i++) { 
                        if($data['valid'] == $i) {
                            echo '<option value="'.$i.'" selected>'. $array_valid[$i].'</option>';
                        } else {
                            echo '<option value="'.$i.'">'. $array_valid[$i].'</option>';
                        }
                        
                    }
                echo '</select>';
            echo '<lable for="occurance">Ordre apparition</label>';
                echo '<input type="number" id="occurance" name="occurance" min="0" max="15" value="'.$data['occurance'].'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Update</button>';
        echo '</form>';
    }
    private function displayOneArticleBlog ($data) {
        echo '<aside class="sectionBlog">';
                echo '<h3>Catégorie : '.$data['subject'].'</h3>';
                echo '<h1 class="titleEventItem">'.$data['title'].'</h1>';
                echo '<article>';
                echo '<p>Le '.brassageDate($data['creat_date']).'</p>';
                        echo $this->htmlText ($data['article']);
                echo '</article>';
        echo '</aside>';
    }
    private function redirectionPage () {
        if(!empty($_SESSION)) {
            switch ($_SESSION['role']) {
                case 0:
                    return 214;
                    break;
                case 1:
                    return 215;
                    break;
                case 2:
                    return 216;
                    break;
                case 3:
                    return 217;
                break;
                default:
                    return 214;
                    break;
            }
        } else {
            return 214;
        }
    }
    private function displayPreviweArticleBlog ($data) {
            echo '<aside class="sectionBlog">';
                echo '<h2 class="titleEventItem"><a class="link" href="'.findTargetRoute($this->redirectionPage ()).'&idArticle='.$data['idArticle'].'">'.$data['title'].'</a></h2>';
                if((!empty($_SESSION))&&($_SESSION['role'] == 3)) {
                    echo '<h2><a class="link" href="'.findTargetRoute(218).'&idArticle='.$data['idArticle'].'">Administrer</a></h2>';
                }
                echo '<h5>Catégorie : '.$data['subject'].'</h5>';
                    echo '<p>Le '.brassageDate($data['creatArticleDate']).'</p>';
                        echo substr($this->htmlText ($data['article']), 0, 550).' <strong><a class="link" href="'.findTargetRoute($this->redirectionPage ()).'&idArticle='.$data['idArticle'].'">[..]</a></strong>';
            echo '</aside>';
    }
    public function displayLastArticle () {
        $data = $this->getLastArticle ();
        if(!empty($data)) {
            $this->displayOneArticleBlog ($data);
        } else {
            echo '<h3>There are no new articles yet.</h3>';
        }
        
    }
    public function displayUpdateCategorie ($valid, $idNav) {
        $dataCategorie = $this->getAllCategories ($valid);
        if($valid ==1) {
            $title = '<h4 class="page">Catégorie valide</h4>';
        } else {
            $title = '<h4 class="page">Catégorie non valide</h4>';
        }
        if(!empty($dataCategorie)) {
                echo $title;
                echo '<ul class="listeProfil">';
                    foreach ($dataCategorie as $value) {
                        echo '<li class="formItem"><strong>'.$value['subject'].'</strong>';
                            echo ' Creat date : '.dateHeure($value['creat_date']);
                            echo ' Update date: '.dateHeure($value['update_date']);
                            $this->updateSubject ($value, $idNav);
                        echo '</li>';
                    }
                echo '</ul>';
            } else {
                echo $title;
                echo'<h5>No data</h5>';
            }
        
    }
    public function selectSubject () {  
        $dataCategorie = $this->getAllCategories (1);
        if(!empty($dataCategorie)) {
            echo '<label for="id_subject">Catégorie</label>';
            echo '<select id="id_subject" name="id_subject">';
                foreach ($dataCategorie as $value) {
                    echo '<option value="'.$value['id'].'">'.$value['subject'].'</option>';
                }
            echo ' </select>';
        }
    }
    public function selectedSubject ($idSubject) {
        $dataCategorie = $this->getAllCategories (1);
        if(!empty($dataCategorie)) {
            echo '<label for="id_subject">Catégorie</label>';
            echo '<select id="id_subject" name="id_subject">';
                foreach ($dataCategorie as $value) {
                    if($value['id'] == $idSubject) {
                        echo '<option value="'.$value['id'].'" selected>'.$value['subject'].'</option>';
                    } else {
                        echo '<option value="'.$value['id'].'">'.$value['subject'].'</option>';
                    }
                    
                }
            echo ' </select>';
        }
    }
    public function menuCategorieBlog () {
        if(!empty($_SESSION)) {
            switch ($_SESSION['role']) {
                case 0:
                    $route = 210;
                    break;
                case 1:
                    $route = 211;
                    break;
                case 2:
                    $route = 212;
                    break;
                case 3:
                    $route = 213;
                break;
                default:
                    $route = 210;
                    break;
            }
        } else {
            $route = 210;
        }

        $dataCategorie = $this->getAllCategories (1);
        if(!empty($dataCategorie)) {
            echo '<ul class="flex-rows-simple margingLeft">';
                foreach ($dataCategorie as $value) {
                    echo '<li><a href="'.findTargetRoute($route).'&idSubject='.$value['id'].'">'.$value['subject'].'</a></li>';
                }
            echo '</ul>';
        } else {
            echo "<h3>The blog isn't up and running yet.</h3>";
        }
    }
    public function displayPreloadArticle ($firstPage, $parPage, $idSubject, $publish) {
        $getArticles = $this->getArticlePagination($firstPage, $parPage, $idSubject, $publish);
        if(!empty($getArticles)) {
            echo '<div>';
            foreach ($getArticles as $value) {
                    $this->displayPreviweArticleBlog ($value); 
            }
            echo '<div>';
        } else {
            echo '<h5>No article in database</h5>';
        }
    }
    public function adminDisplayPreloadArticle ($firstPage, $parPage, $publish) {
        $getArticles = $this->getArticlePaginationAdmin($firstPage, $parPage, $publish);
        if(!empty($getArticles)) {
            echo '<div>';
            foreach ($getArticles as $value) {
                    $this->displayPreviweArticleBlog ($value); 
            }
            echo '<div>';
        } else {
            echo '<h5>No article in database</h5>';
        }
    }
    public function displayOneArticleOfBlog ($idArticle, $valid) {
        $data = $this->getOneArticle ($idArticle, $valid);
        $this->displayOneArticleBlog ($data);
    }

    public function admiArticleOfBlog ($idArticle, $valid, $idNav) {
        return $this->getOneArticle ($idArticle, $valid);
    }
    public function displayImgCode ($valid, $idNav, $firstPage, $PictureByPage) {
        function carrousel ($data) {
            if($data) {
                return 'Oui';
            }
            return 'Non';
        }
        $dataPictures = $this->getPictureBlogPagination ($valid, $firstPage, $PictureByPage);
        echo '<div class="gallery">';
        foreach ($dataPictures as $value) {
            echo '<aside class="itemPictureMini">';
                echo '<img class="miniPictureBlog" src="modules/blog/blogPictures/'.$value['name_picture'].'" alt="'.$value['altImg'].'"/>';
                echo '<figcaption>OpenPicture {'.$value['name_picture'].'} ('.$value['altImg'].') ClosePicture</figcaption>';
                echo '<p>alt = '.$value['altImg'].'</p>';
                echo '<p>Carrousel ? '.yes($value['carrouselPicture']).'</p>';
                    echo '<form action="'.encodeRoutage(141).'" method="post">';
                    echo '<input type="hidden" name="idPicture" value="'.$value['id'].'"/>';
                    echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Delete picture</button>';
                    echo '</form>';
            echo '</aside>';
    
        }
        echo '</div>';
    }
    public function carrouselDisplayPicture ($valid, $carrousel, $limit) {
        $dataPictures = $this->getCarouselPictures ($valid, $carrousel, $limit);
        if(!empty($dataPictures)) {
            $countPictures = count($dataPictures);
            echo '<div class="slide-container">';
            $numberPicture = 1;
            foreach ($dataPictures as $value) {
                echo '<div class="custom-slider fade">
                    <img class="CarrouselPictureBlog" src="modules/blog/blogPictures/'.$value['name_picture'].'" alt="'.$value['altImg'].'"/>
                    <div class="slide-text">'.$value['altImg'].'</div>
                </div>';
                $numberPicture +=1;
            }
            echo '</div>';
            echo '<div class="slide-dot">';
            for ($i=1; $i <= $countPictures ; $i++) { 
                echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
            }
                
            echo' </div>';
        } else {
            echo '<div class="slide-container">';
            echo '<h3>No image available</h3>';
            echo' </div>';
        }
    }
}
