<?php
class SecurityAndRouterForm
{
    private array $session;
    private array $route;
    private string $requestMethod;
    private array $post;
    private int $border;
    
    public function __construct  (array $sessionData, array $routeForm, string $requestMethod, array $post, $border) {
        $this->session = $sessionData;
        $this->route = $routeForm;
        $this->requestMethod = $requestMethod;
        $this->post = $post;
        $this->border = $border;
    }
    private function setSecurity () {
        if(isset($this->route[0]['securiter'])) {
            return $this->route[0]['securiter'];
        } else {
            return false;
        }
       
    }
    private function setPath () {
        return '../'.$this->route[0]['chemin'];
    }
    private function setRole () {
        return $this->session['role'];
    }
    private function testRequest () {
        if($this->requestMethod === "POST") {
            return true;
        }
        return false;
    }
private function noVoidPostData(): bool {
   $filtered = array_filter($this->post, function ($value) {
        return trim((string)$value) === '';
    });
    return count($filtered) === 0;
}
    public function setIdNav () {
        if(array_key_exists('idNav', $this->post)) {
            return filter($this->post['idNav']);
        } else {
            return 0;
        }
    }
    public function routingForm () {
        if(empty($this->session)&&($this->testRequest ())) {
            return $this-> setPath ();
        }
        if(!$this->noVoidPostData ()) {
            header('location:../index.php?message=Champs vide dans votre formulaire&idNav='.$this->setIdNav ());
            exit;
        }
        if(($this->setSecurity () === $this->setRole ())&&($this->testRequest ())&&($this->border == 1)) {
            return $this-> setPath ();
        } else {
                session_destroy();
                $_SESSION = array();
               header('location:../index.php?message=Vous êtes déconnecté');
               exit;
        }
    }
}
