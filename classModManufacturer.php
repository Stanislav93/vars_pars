<?php

class classModManufacturer extends classMod{
        
    private $MManufacturer;


    public $dataManufactureEmpty = [];
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->json = [
            'success'   => true,
            'errors'    => [],
            'tasks'     => []
        ];
        
        $this->load->model('localisation/language');
        
        $this->load->model('catalog/manufacturer');
        $this->MManufacturer = $this->model_catalog_manufacturer;
        
        $this->dataManufactureEmpty["name"] = "";
        $this->dataManufactureEmpty["manufacturer_description"] = [];
        
        $this->load->model('localisation/language');
        foreach ($this->model_localisation_language->getLanguages() as $value) {
            $this->dataManufactureEmpty["manufacturer_description"][$value['language_id']] = [
                'meta_h1' => "",
                'meta_title' => "",
                'meta_description' => "",
                'meta_keyword' => "",
                'description' => "",
                'description_bottom' => ""
            ];
        }
        
        
        $this->dataManufactureEmpty["manufacturer_store"] = ['0'];
        $this->dataManufactureEmpty["keyword"] = "";
        $this->dataManufactureEmpty["image"] = "";
        $this->dataManufactureEmpty["noindex"] = "1";
        $this->dataManufactureEmpty["sort_order"] = "0";
        $this->dataManufactureEmpty["product_related_input"] = "";
        $this->dataManufactureEmpty["article_related_input"] = "";
        $this->dataManufactureEmpty["manufacturer_layout"] = [""];
    }
    
    public function index(&$settings) {}
    
    public function isAdd($dataManufacture) {
        
        if($row = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer WHERE `name` = '".$this->db->escape($dataManufacture['name'])."'")->row){
            return $row['manufacturer_id'];
        } else {
            
            return $this->MManufacturer->addManufacturer($dataManufacture)['manufacturer_id'];
            
        }
        
    }
    
    
}
