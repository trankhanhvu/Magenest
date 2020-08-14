<?php

namespace Magenest\Cybergame\Observer;

use Magenest\Cybergame\Model\ResourceModel\GamerAccountList;
use Magento\Framework\Event\ObserverInterface;

class BuyHourAccount implements ObserverInterface
{
    protected $gamerFac;
    protected $request;
    protected $checkoutSession;
    protected $gamerCol;

    public function __construct(\Magenest\Cybergame\Model\GamerAccountListFactory $gamerAccountListFactory,
                                \Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory $gamerCol,
                                \Magento\Checkout\Model\Session $session,
                                \Magento\Framework\App\RequestInterface $request)
    {
        $this->gamerFac = $gamerAccountListFactory;
        $this->checkoutSession = $session;
        $this->request = $request;
        $this->gamerCol = $gamerCol;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $gamerModel         = $this->gamerCol->create();
        $gamer = $gamerModel->addFieldToFilter('account_name',$this->checkoutSession->getData('account_name'));

        if(empty($gamer->getData()))
        {
            $account = $this->gamerFac->create();
            $account->setData('product_id',$this->checkoutSession->getData('last_added_product_id'));
            $account->setData('account_name',$this->checkoutSession->getData('account_name'));
            $account->setData('hour',$this->checkoutSession->getData('hour'));
            $account->setData('password',1);
            $account->save();
        }
        else
        {
            $account = $this->gamerCol->create()->addFieldToFilter('account_name',$this->checkoutSession->getData('account_name'))
            ->addFieldToFilter('product_id',$this->checkoutSession->getData('last_added_product_id'));
            $account->setDataToAll('hour',$this->checkoutSession->getData('hour')+$account->getFirstItem()->getData('hour'));
            $account->save();
        }
    }
}