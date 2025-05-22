<?php
require_once('modules/blog/objects/sqlBlog.php');
class PresentationHTML extends SQLBlog 
{   
    protected $classCSS;
    public function __construct () {
        $this->classCSS = ['strong'=>'titlePrintDataSheet', 
        'ul'=>'listClass', 
        'article'=>'articleBlog', 
        'p'=>'p-class', 
        'h2'=>'titleSite', 
        'h3'=>'subTitleSite', 
        'h4'=>'subTitleSite',
        'a'=>'link',
        'img'=>'pictureBlog',
        'center'=>'centerBlog'];
    }
    private function link ($data, $class) {
        //*ea*[urlLink]*nameLink*ca*
        $html = str_replace('*ea*', '<a class="'.$class.'" href=', $data);
        $html = str_replace('[', '"', $html);
        $html= str_replace(']', '">', $html);
        $html=str_replace('*ca*','</a>', $html);
        return $html;
    }
    private function center ($data, $class) {
        $html = str_replace('*sCenter*', '<aside class="'.$class.'">', $data);
        $html = str_replace('*eCenter*', '</aside>', $html);
        return $html;
    }
    private function img ($data, $class) {
        // *oimg* {src} (alt) *cmig*
        $html = str_replace('OpenPicture', '<img class="'.$class.'"', $data);
        $html = str_replace('{', 'src="modules/blog/blogPictures/', $html);
        $html = str_replace('}', '"', $html);
        $html = str_replace('(', 'alt ="', $html);
        $html = str_replace(')', '"', $html);
        $html= str_replace('ClosePicture', "/>", $html);
        return $html;
    }
    private function listHTML ($data, $class) {
        $StepUL = str_replace('*sl*','<ul class="'.$class.'">',$data);
        $stepUlEnd = str_replace('*el*','</ul>',$StepUL);
        $stepLI = str_replace('*sli*','<li>',  $stepUlEnd);
        $text = str_replace('*eli*','</li>', $stepLI);
        return $text;
    }
    private function  lineBreak ($data) {
        return str_replace('*','<br/>', $data); 
    }
    private function strong ($data, $class) {
        $setp1 = str_replace('*sSt*', '<strong class="'.$class.'">', $data);
        return str_replace('*eSt*', ' </strong>', $setp1);
    }
    private function article ($data, $class) {
        $setp1 = str_replace('*sArt*', '<article class="'.$class.'">', $data);
        return str_replace('*eArt*', ' </article>', $setp1);
    }
    private function paragraphe ($data, $class) {
        $setp1 = str_replace('*sP*', '<p class="'.$class.'">', $data);
        return str_replace('*eP*', ' </p>', $setp1);
    }
    private function title2 ($data, $class) {
        $setp1 = str_replace('*sh2*', '<h2 class="'.$class.'">', $data);
        return str_replace('*eh2*', ' </h2>', $setp1);
    }
    private function title3 ($data, $class) {
        $setp1 = str_replace('*sh3*', '<h3 class="'.$class.'">', $data);
        return str_replace('*eh3*', ' </h3>', $setp1);
    }
    private function title4 ($data, $class) {
        $setp1 = str_replace('*sh4*', '<h4 class="'.$class.'">', $data);
        return str_replace('*eh4*', ' </h4>', $setp1);
    }
    protected function htmlText ($data) {
        $html = $this->article ($data, $this->classCSS['article']);
        
        $html = $this->paragraphe ($html, $this->classCSS['p']);
        $html = $this->strong ($html, $this->classCSS['strong']);
        $html = $this->listHTML ($html, $this->classCSS['ul']);
        $html = $this-> title2  ($html, $this->classCSS['h2']);
        $html = $this-> title3  ($html, $this->classCSS['h3']);
        $html = $this-> title4  ($html, $this->classCSS['h4']);
        $html = $this->link ($html, $this->classCSS['a']);
        $html = $this->img ($html, $this->classCSS['img']);
        $html = $this->center ($html, $this->classCSS['center']);
        $html = $this->lineBreak ($html);
        return $html;
    }
}
