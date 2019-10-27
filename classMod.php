<?php
class classMod extends Controller{
    
    public $json = [];
        
    public $Mmodel = false;
    
    public $dataEmpty = [];

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->json = [
            'success'   => true,
            'errors'    => [],
            'tasks'     => []
        ];
    }
    
    public function getUrlToID($url) {
        
        $pUrls = explode("/", $url);
        
        for ($index = count($pUrls)-1; $index > 0; $index--) {
            if($pUrls[$index])
                return str_replace("c", "",str_replace("p", "", $pUrls[$index]));
        }
        
        return "";
        
    }
    
}
