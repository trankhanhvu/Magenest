<?php
namespace Magenest\Frontend\Controller\Index;

use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManager;

class Account extends \Magento\Framework\App\Action\Action
{
    protected $productFactory;
    protected $imageHelper;
    protected $listProduct;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        StoreManager $storeManager,
        Image $imageHelper
    )
    {
        $this->imageHelper = $imageHelper;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }


    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        if ($name = $this->getRequest()->getParam('name')) {
            $product = $objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection')
                ->addFieldToFilter('name', array('like' => "%" . $name . "%"));


            foreach ($product as $p)
            {
                $productData[] = [
                    'movie_id' => $p->getMovie_id(),
                    'name' => $p->getName(),
                    'description' => $p->getDescription(),
                    'rating' => $p->getRating(),
                    'director_id' => $p->getDirector_id()
                ];
            }


            echo json_encode($productData);
            return;
        }
    }
}