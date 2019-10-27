<?php
class classModAttribute extends classMod{
    
    public function parsAttributes(&$settings, $selector) {
        
        $productBox = pq($settings['productDOMBox']);

        $attribute_items = $productBox->find($selector['box'] . ' ' . $selector['item']);

        $product_attributes = [];

        foreach ($attribute_items as $attribute_item) {

            $attribute_item = pq($attribute_item);

            $product_attributes[] = [
                'name' => trim($attribute_item->find($selector['name'])->text()),
                'value' => trim($attribute_item->find($selector['value'])->text()),
            ];
        }
        
        return $product_attributes;
        
    }
        
    public function conversion(&$settings, $product_attributes) {
        
        $this->load->model('extension/module/ssv_parser/attribute');
        
        $addAttribute = isset($settings['params']['addAttribute']) && $settings['params']['addAttribute'];
        $addAttributeGroup = isset($settings['params']['addAttributeGroup']) && $settings['params']['addAttributeGroup'];
        
        $product_attributes_new = [];
        
        foreach ($product_attributes as $attribute) {
            
            $row = $this->model_extension_module_ssv_parser_attribute->getAttributeName($attribute['name']);
            
            if($row){
                
                $product_attribute_description = [];
                
                foreach ($settings['languages'] as $key => $value) {
                    
                    $product_attribute_description[$value["language_id"]] = [                        
                        
                        'text' => $attribute['value']
                    ];
                    
                }
                
                $product_attributes_new[] = [
                    'attribute_id' => $row['attribute_id'],
                    'name' => $attribute['name'],
                    'product_attribute_description' => $product_attribute_description];
                
            }elseif($addAttribute){
                
                $product_attribute_description = [];
                
                foreach ($settings['languages'] as $key => $value) {
                    
                    $attribute_description[$value["language_id"]] = [ 
                        'name' => $attribute['name']
                    ];
                    
                }

                $attribute_id = $this->model_extension_module_ssv_parser_attribute->addAttribute(
                        [
                            'attribute_group_id' => $settings['params']['attribute_group_id'],
                            'sort_order' => 0,
                            'attribute_description' => $attribute_description
                        ]);
                
                $product_attribute_description = [];
                
                foreach ($settings['languages'] as $key => $value) {
                    
                    $product_attribute_description[$value["language_id"]] = [
                        'text' => $attribute['value']
                    ];
                    
                }
                
                $product_attributes_new[] = [
                    'attribute_id' => $row['attribute_id'],
                    'name' => $attribute['name'],
                    'product_attribute_description' => $product_attribute_description];
                
            }
            
                
        }
        
        return $product_attributes_new;
        
    }
    
    
}