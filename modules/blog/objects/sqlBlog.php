<?php
class SQLBlog 
{
    private function getLastid () {
        $select = "SELECT `id` AS `idArticle` FROM `articles` ORDER BY `id` DESC LIMIT 1;";
        return ActionDB::select($select, [], 1)[0]['idArticle'];
    }
    private function recordCategorieArticle ($id_subject) {
        $id_article = $this->getLastid ();
        $insert ="INSERT INTO `link_subject_article`(`id_subject`, `id_article`) VALUES (:id_subject, :id_article);";
        $param = [['prep'=>':id_subject', 'variable'=>$id_subject],
                    ['prep'=>':id_article', 'variable'=>$id_article]];
        ActionDB::access($insert, $param, 1);
    }
    public function creatNewArticle ($param, $id_subject) {
        $insert = "INSERT INTO `articles`(`author`, `title`, `article`,`meta`, `publish`) VALUES (:idUser, :title, :article, :meta, :publish);";
        ActionDB::access($insert, $param, 1);
        $this->recordCategorieArticle ($id_subject);
        return true;
    }
    public function creatNewCategorie ($param) {
        $insert = "INSERT INTO `subjects`( `subject`, `occurance`) VALUES (:subject, :occurance);";
        return ActionDB::access($insert, $param, 1);
    }
    public function idCategorieExist ($id) {
        $select = "SELECT COUNT(`id`) AS `nbrCategorie` FROM `subjects` WHERE `id` = :id;";
        $param = [['prep'=>':id', 'variable'=>$id]];
        if(ActionDB::select($select, $param, 1)[0]['nbrCategorie'] == 1) {
            return true;
        }
        return false;
    }
    public function updateCategorie ($param) {
        $update = "UPDATE `subjects` 
        SET `subject`=:subject,`update_date`= NOW(),`valid`=:valid, `occurance`= :occurance 
        WHERE `id`=:id;";
        return ActionDB::access($update, $param, 1);
    }
    protected function getLastArticle () {
        $select = "SELECT `id_subject`, `id_article`, `articles`.`id` AS `idArticle`, `author`, `title`, `article`, 
        `articles`.`valid`, `publish`, `articles`.`creat_date`, `articles`.`update_date`, `subject`
                    FROM `link_subject_article` 
                    INNER JOIN `articles` ON `id_article` = `articles`.`id`
                    INNER JOIN `subjects` ON `id_subject` = `subjects`.`id`
                    WHERE  `publish` = 1
                    ORDER BY `articles`.`id` DESC LIMIT 1;";
        $lastArticle = ActionDB::select($select, [], 1);
        if(!empty($lastArticle)) {
            return $lastArticle[0];
        }
        return false;
    }
    protected function getAllCategories ($valid) {
        $select ="SELECT `id`, `subject`, `creat_date`, `update_date`, `valid`, `occurance` 
        FROM `subjects` 
        WHERE `valid` = :valid
        ORDER BY `occurance`;";
        $param = [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function numberOfArticle ($idSubject, $publish) {
        $select = "SELECT COUNT(`id_article`) AS `nbrArticle` 
        FROM `link_subject_article`
        INNER JOIN `articles` ON `articles`.`id` = `id_article`
        WHERE `id_subject` = :idSubject AND `articles`.`publish` = :publish;";
        $param = [['prep'=>':idSubject', 'variable'=>$idSubject],
                ['prep'=>':publish', 'variable'=>$publish]];
        return ActionDB::select($select, $param, 1)[0]['nbrArticle'];
    }
    public function nameSubject ($idSubject) {
        $select = "SELECT `subject` FROM `subjects` WHERE `id` = :idSubject;";
        $param = [['prep'=>':idSubject', 'variable'=>$idSubject]];
        return ActionDB::select($select, $param, 1)[0]['subject'];
    }
    protected function getArticlePagination($firstPage, $parPage, $idSubject, $publish) {
        $select = "SELECT 
        `articles`.`id` AS `idArticle`, 
        `author`, 
        `title`, 
        `article`, 
        `articles`.`valid` AS `validArticle`, 
        `publish`, 
        `articles`.`creat_date` AS `creatArticleDate`, 
        `articles`.`update_date` AS `updateArticleDate`,
        `subject`
        FROM `link_subject_article`
        INNER JOIN `articles` ON `articles`.`id` = `id_article`
        INNER JOIN `subjects` ON `id_subject` = `subjects`.`id`
        WHERE `id_subject` = :idSubject AND `articles`.`publish` = :publish
        ORDER BY `articles`.`creat_date` DESC
        LIMIT {$firstPage}, {$parPage};";
        $param = [['prep'=>':idSubject', 'variable'=>$idSubject],
                    ['prep'=>':publish', 'variable'=>$publish]];
        return ActionDB::select($select, $param, 1);
    }
    protected function getArticlePaginationAdmin($firstPage, $parPage, $publish) {
        $select = "SELECT 
        `articles`.`id` AS `idArticle`, 
        `author`, 
        `title`, 
        `article`, 
        `articles`.`valid` AS `validArticle`, 
        `publish`, 
        `articles`.`creat_date` AS `creatArticleDate`, 
        `articles`.`update_date` AS `updateArticleDate`,
        `subject`
        FROM `link_subject_article`
        INNER JOIN `articles` ON `articles`.`id` = `id_article`
        INNER JOIN `subjects` ON `id_subject` = `subjects`.`id`
        WHERE  `articles`.`publish` = :publish
        ORDER BY `articles`.`creat_date` DESC, `id_subject`
        LIMIT {$firstPage}, {$parPage};";
        $param = [['prep'=>':publish', 'variable'=>$publish]];
        return ActionDB::select($select, $param, 1);
    }
    protected function getOneArticle ($idArticle, $valid) {
        $select = "SELECT `articles`.`id` AS `idArticle`, `author`, `title`, `article`, `meta`, `articles`.`valid`, `publish`, `articles`.`creat_date`, `articles`.`update_date`,  `subject`, `id_subject`
                FROM `articles`
                INNER JOIN `link_subject_article` ON `articles`.`id` = `id_article`
                INNER JOIN `subjects` ON `id_subject` = `subjects`.`id`
                WHERE `articles`.`id` = :idArticle AND `articles`.`valid` = :idValid; AND ";
        $param = [['prep'=>':idArticle', 'variable'=>$idArticle],
                    ['prep'=>':idValid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1)[0];

    }
    public function updateArticle ($param) {
        $update = "UPDATE `articles` SET `title`= :title,`article`= :article, `meta`= :meta, `publish`=:publish,`update_date`=NOW() WHERE `id` = :idArticle AND `author`=:idUser;
        UPDATE `link_subject_article` SET `id_subject`= :id_subject  WHERE `id_article` = :idArticle;";
        return ActionDB::access($update, $param, 1);
    }
    public function checkIdArticle ($idArticle) {
        $select = "SELECT COUNT(`id`) AS `nbrArticle` FROM `articles` WHERE `id` = :idArticle;";
        $param = [['prep'=>':idArticle', 'variable'=>$idArticle]];
        $checkArticle = ActionDB::select($select, $param, 1)[0]['nbrArticle'];
        if($checkArticle == 1) {
            return true;
        }
        return false;
    }
    public function deleteArticleByOwner ($param) {
        $delete = "DELETE FROM `articles` WHERE `id` = :idArticle AND `author`=:idUser;";
        return ActionDB::access($delete, $param, 1);
    }
    public function recordPictureBlog($param) {
        $insert = "INSERT INTO `pictures`(`altImg`, `carrouselPicture`, `name_picture`, `author`) VALUES (:altImg, :carrousellePicture, :name_picture,  :idUser);";
        return ActionDB::access($insert, $param, 1);
    }
    protected function getPictureBlogPagination ($valid, $firstPage, $PictureByPage) {
        $select = "SELECT * FROM  `pictures` 
        WHERE `valid` = :valid
        LIMIT {$firstPage}, {$PictureByPage};";
        $param = [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function nbrMiniaturePicture () {
        $select = "SELECT COUNT(`id`) AS `nbrPicture` FROM `pictures`;";
        return ActionDB::select($select, [], 1)[0]['nbrPicture'];
    }
    public function getLastSubject () {
        $select = "SELECT `id` FROM `subjects` ORDER BY`id` LIMIT 1;";
        $idSubject = ActionDB::select($select, [], 1);
        if(!empty($idSubject)) {
            return $idSubject[0]['id'];
        }
        return false;
    }
    public function numberOfArticleAllSubject ($publish) {
        $select = "SELECT COUNT(`id`) AS `nbrArticle` FROM `articles` WHERE `publish`=:publish;";
        $param = [['prep'=>':publish', 'variable'=>$publish]];
        return ActionDB::select($select, $param, 1)[0]['nbrArticle'];
    }
    protected function getCarouselPictures ($valid, $carrousel, $limit) {
        $select = "SELECT `name_picture`, `altImg` FROM `pictures` WHERE `valid` = :valid AND `carrouselPicture` = :carrouselPicture ORDER BY `id` ASC LIMIT {$limit};";
        $param = [['prep'=>':valid', 'variable'=>$valid], 
                ['prep'=>':carrouselPicture', 'variable'=>$carrousel]];
        return ActionDB::select($select, $param, 1);
    }
    public function checkPictureExist ($idPicture) {
        $select = "SELECT COUNT(`id`) AS `nbrPicture` FROM `pictures` WHERE `id` = :idPicture;";
        $param = [['prep'=>':idPicture', 'variable'=>$idPicture]];
        $chekPicture = ActionDB::select($select, $param, 1)[0]['nbrPicture'];
        if($chekPicture == 1) {
            return true;
        }
        return false;
    }
    private function getNamePicture ($param) {
        $select = "SELECT `name_picture` FROM `pictures` WHERE `id` = :idPicture;";
        return ActionDB::select($select, $param, 1)[0]['name_picture'];
    }
    public function deletePicture ($idPicture) {
        $param = [['prep'=>':idPicture', 'variable'=>$idPicture]];
        $namePicture = $this->getNamePicture ($param);
        $delete = "DELETE FROM `pictures` WHERE `id` = :idPicture;";
        ActionDB::access($delete, $param, 1);
        return $namePicture;
    }
    public function getMetaArticle($idArticle, $description) {
        $select = "SELECT `meta` FROM `articles` WHERE `id` = :idArticle;";
        $param = [['prep'=>':idArticle', 'variable'=>$idArticle]];
        return ActionDB::select($select, $param, 1)[0]['meta'].', '.$description;
    }
}
