<?php
namespace Magenest\Frontend\Controller\Customer;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    /*protected $cacheTypeList;

    public function __construct(
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList)
    {
        $this->cacheTypeList = $cacheTypeList;
    }*/

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $firstname = $this->getRequest()->getParam('firstname');
        $lastname = $this->getRequest()->getParam('lastname');

        $customer = $this->_objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $customer->setFirstname($firstname);
        $customer->setLastname($lastname);
        /*$customer->setData('firstname',$firstname);
        $customer->setData('$lastname',$firstname);*/
        $customer->save();


        /*return $this->_redirect('frontend/customer/index');*/
    }
}

