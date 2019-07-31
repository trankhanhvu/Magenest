<?php

namespace Magenest\Movie\Block\Adminhtml\About;
use Magento\Framework\View\Element\Template;

class Info extends Template
{
    public function getNumberCustomer()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(entity_id) as numbercustomer FROM customer_entity");

        return $number;
    }

    public function getNumberProduct()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(entity_id) as numberproduct FROM catalog_product_entity");

        return $number;
    }

    public function getNumberOrder()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(entity_id) as numberorder FROM sales_order");

        return $number;
    }

    public function getNumberInvoice()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(entity_id) as numberinvoice FROM sales_invoice");

        return $number;
    }

    public function getNumberCreditmemo()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(entity_id) as numbercredit FROM sales_creditmemo");

        return $number;
    }
}