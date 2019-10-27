<?php

class classModCategory extends classMod{
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->json = [
            'success'   => true,
            'errors'    => [],
            'tasks'     => []
        ];
    }
    
    public function index(&$settings){}
    
    public function check_products(&$settings) {}
    
    public function check_pages(&$settings) {}

    public function getBreadcrumbs(&$settings) {
                
        $_breadcrumbs = $settings['docpq']->find($settings['breadcrumbs_find']);
        
        $parent_id = 0;
        $breadcrumbs = [];

        foreach ($_breadcrumbs as $_breadcrumb) {

            $_category = [];

            $breadcrumb = pq($_breadcrumb);

            $breadcrumb_name = trim($breadcrumb->text());

            $breadcrumb_url = $breadcrumb->attr('href');

            $breadcrumb_source_id = $this->getUrlToID($breadcrumb_url);

            $breadcrumbs[$breadcrumb_source_id] = [];


            /*
             * 
             * 
             * 
             */

            $category_description = [];

            foreach ($settings['languages'] as $language) {

                $breadcrumbs[$breadcrumb_source_id]['category_description'][$language['language_id']] = [
                    'name' => $breadcrumb_name,
                    'seo_h1' => $breadcrumb_name,
                    'seo_title' => $breadcrumb_name,
                    'meta_keyword' => $breadcrumb_name,
                    'meta_description' => $breadcrumb_name,
                    'meta_title' => $breadcrumb_name,
                    'page_h1' => $breadcrumb_name,
                    'description' => $breadcrumb_name
                ];
            }
            if ($parent_id == 0) {
                $breadcrumbs[$breadcrumb_source_id]['parent_id'] = 0;
            }

            $breadcrumbs[$breadcrumb_source_id]['filter'] = '';
            $breadcrumbs[$breadcrumb_source_id]['product_store'] = ['0'];
            $breadcrumbs[$breadcrumb_source_id]['keyword'] = '';
            $breadcrumbs[$breadcrumb_source_id]['image'] = '';
            $breadcrumbs[$breadcrumb_source_id]['column'] = '1';
            $breadcrumbs[$breadcrumb_source_id]['sort_order'] = 0;
            $breadcrumbs[$breadcrumb_source_id]['status1'] = '1';
            $breadcrumbs[$breadcrumb_source_id]['image'] = [""];

            $parent_id = $breadcrumbs[$breadcrumb_source_id]['category_id'];
        }
        
        return;
    } 
    
}
