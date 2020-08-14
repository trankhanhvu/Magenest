<?php

namespace Magenest\Movie\Plugin;

class ItemPlugin {
    public function afterGetName(\Magento\Catalog\Model\Product $subject){
        return "This is name";
    }
}
