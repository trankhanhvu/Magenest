<?php

namespace Magenest\Cybergame\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\Product;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;

class ListCybergame extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $extraOptionFac;

    protected $productFac;

    public function __construct(Context $context, PostHelper $postDataHelper, Resolver $layerResolver, CategoryRepositoryInterface $categoryRepository, Data $urlHelper,
                                \Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\CollectionFactory $extraOptionFactory,
                                \Magento\Catalog\Model\ProductFactory $productFactory,
                                array $data = [])
    {
        $this->extraOptionFac = $extraOptionFactory;
        $this->productFac = $productFactory;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function getCyberRoomById()
    {
        $id = $this->getRequest()->getParams();
        $room = $this->extraOptionFac->create()->addFieldToFilter('product_id',$id);
        return $room;
    }

    public function getProductPrice2()
    {
        $id = $this->getRequest()->getParams();
        $price = $this->productFac->create()->load($id)->getPrice();
        return $price;
    }
}