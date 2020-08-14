<?php

namespace Magenest\Frontend\Block\Product;

use Magento\Framework\View\Element\Template;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct{

    /*protected $_reviewFactory;
    public function __construct(
        \Magento\Review\Model\ReviewFactory $reviewFactory)
    {
        $this->_reviewFactory = $reviewFactory;
    }*/

    public function getRatingSummary($product)
    {

        /*$this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();

        return $ratingSummary;*/

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $reviewFactory = $objectManager->create('Magento\Review\Model\Review');
        $storeId = $storeManager->getStore()->getId();
        $reviewFactory->getEntitySummary($product, $storeId);
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();

        return $ratingSummary;
    }

}