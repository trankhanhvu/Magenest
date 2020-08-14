<?php
namespace Magenest\Cybergame\Controller\AccountName;

use Magenest\Cybergame\Model\ResourceModel\GamerAccountList\Collection;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action {

    protected $resultJsonFactory;
    protected $gamerFac;
    protected $_request;
    protected $checkoutSession;

    public function __construct(Context $context,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                \Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory $gamerFac,
                                \Magento\Framework\App\RequestInterface $request,
                                \Magento\Checkout\Model\Session $session)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->gamerFac = $gamerFac;
        $this->_request = $request;
        $this->checkoutSession = $session;
        parent::__construct($context);
    }

    public function execute()
    {

        $account_name = $this->_request->getParam('account_name');
        $product_id = $this->_request->getParam('product_id');

        $gamer = $this->gamerFac->create()->addFieldToFilter('account_name',$account_name)
        ->addFieldToFilter('product_id',$product_id);

        $this->checkoutSession->setData('account_name',$account_name);
        $this->checkoutSession->setData('hour',$this->_request->getParam('hour'));

        $result = $this->resultJsonFactory->create();
        $result = $result->setData($gamer);

        return $result;
    }
}
