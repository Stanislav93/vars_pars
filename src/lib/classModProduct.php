<?php

class classModProduct extends classMod{
    
    public $dataProductEmpty = [];


    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->json = [
            'success'   => true,
            'errors'    => [],
            'tasks'     => []
        ];
        
         
        $this->load->model('localisation/language');
        foreach ($this->model_localisation_language->getLanguages() as $value) {
            $this->dataProductEmpty['product_description'][$value['language_id']] = [
                'name' => '',
                'meta_title' => '',
                'meta_h1' => '',
                'seo_h1' => '',
                'seo_title' => '',
                'meta_keyword' => '',
                'meta_description' => '',
                'description' => '',
                'description_mini' => '',
                'tag' => ''
            ];
        }        
        
        $this->dataProductEmpty['mod'] = '';
        $this->dataProductEmpty['url'] = '';
        $this->dataProductEmpty['settign'] = '';
        $this->dataProductEmpty['model'] = '';
        $this->dataProductEmpty['sku'] = '';
        $this->dataProductEmpty['upc'] = '';
        $this->dataProductEmpty['ean'] = '';
        $this->dataProductEmpty['jan'] = '';
        $this->dataProductEmpty['isbn'] = '';
        $this->dataProductEmpty['mpn'] = '';
        $this->dataProductEmpty['location'] = '';
        $this->dataProductEmpty['price'] = '';
        $this->dataProductEmpty['tax_class_id'] = '0';
        $this->dataProductEmpty['quantity'] = '9999';
        $this->dataProductEmpty['minimum'] = '1';
        $this->dataProductEmpty['subtract'] = '1';
        $this->dataProductEmpty['stock_status_id'] = '7';
        $this->dataProductEmpty['keyword'] = '';
        $this->dataProductEmpty['date_available'] = date('Y-m-d');
        $this->dataProductEmpty['length'] = '0';
        $this->dataProductEmpty['width'] = '0';
        $this->dataProductEmpty['weight'] = '0';
        $this->dataProductEmpty['weight_class_id'] = '1';
        $this->dataProductEmpty['height'] = '0';
        $this->dataProductEmpty['length_class_id'] = '1';
        $this->dataProductEmpty['status'] = '1';
        $this->dataProductEmpty['settign'] = '1';
        $this->dataProductEmpty['stock_status_id'] = '1';
        $this->dataProductEmpty['sort_order'] = '1';
        $this->dataProductEmpty['manufacturer'] = '';
        $this->dataProductEmpty['manufacturer_id'] = '';
        $this->dataProductEmpty['main_category_id'] = '';
        $this->dataProductEmpty['product_category'] = '';
        $this->dataProductEmpty['filter'] = '';
        $this->dataProductEmpty['product_store'] = ['0'];
        $this->dataProductEmpty['download'] = '';
        $this->dataProductEmpty['related'] = '';
        $this->dataProductEmpty['product_related_article_input'] = '';
        $this->dataProductEmpty['option'] = '';
        $this->dataProductEmpty['image'] = '';
        $this->dataProductEmpty['points'] = '0';
        $this->dataProductEmpty['product_reward'] = [["points" => 0]];
        $this->dataProductEmpty['product_layout'] = [''];
        $this->dataProductEmpty['product_attribute'] = [];
        $this->dataProductEmpty['product_special'] = [];
        
    }
    
    public function index(&$settings) {

        if(isset($settings['params']['func'])){
            
            if($settings['params']['func'] == ""){
                
            }
            elseif ($settings['params']['func'] == "") {
            
            }
        }
                
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
