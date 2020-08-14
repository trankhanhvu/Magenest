<?php

namespace Magenest\Movie\Plugin;

class ProductListPlugin {


    public function aferGetProductPrice($subject, $result, $product)
    {
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
        $logger->info($result);

        return $result*10;
    }

}