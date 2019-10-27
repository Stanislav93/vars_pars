<?php
class classModMod extends classMod{
    
    public function __construct($registry) {
        parent::__construct($registry);
                
        $this->json = [
            'success'   => true,
            'errors'    => [],
            'tasks'     => []
        ];
    }
    
    public function index(&$settings) {
        
        if($settings['method'] == "auto"){
            $settings['method'] = $this->AutoCheckTypeUrlMethod($settings['url']);
            if(!$settings['method']){
                $this->json['error'][] = 'Vars Pars->mod('.$settings['mod'].'): Не вдалося визначити '
                        . 'автоматично метод для парсера сторінки! Оберіть замість auto один із product або category.';
                $this->json['success'] = false;
                
                return $this->json;
            }
        }
        
        $this->json = $settings['getPage']->getPagePQ($settings['url']);
        
        if($this->json['success']){
            $settings['docpq'] = $this->json['output'];
        }else{
            return $this->json;
        }
        
        if($settings['method'] == "product"){
            $this->json = $this->product($settings);
        }elseif ($settings['method'] == "category") {
            $this->json = $this->category($settings);
        }       
        
        return $this->json;        
    }
    
    public function product(&$settings) {
        return $this->load->controller('extension/module/ssv_parser_/mod/'.$settings['mod'].'/'.$settings['mod'].'_product', $settings);        
    }
    
    public function category(&$settings) {
        return $this->load->controller('extension/module/ssv_parser_/mod/'.$settings['mod'].'/'.$settings['mod'].'_category', $settings);        
    }
    
    public function AutoCheckTypeUrlMethod($url) {
        $source_category_id = false;
        
        $routs = explode('/', $url);
        
        foreach ($routs as $value) {
            
            preg_match('/c[0-9]{1,9}/', $value, $output_array);
            
            if($output_array)
                return "category";
            
            preg_match('/p[0-9]{1,9}/', $value, $output_array);
            
            if($output_array)
                return "product";
        }
        
        return false;      
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
