<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeMagenestTextfield implements ObserverInterface
{
    protected $_scopeConfig;
    protected $_configWriter;
    protected $cacheTypeList;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList)
    {
        $this->_configWriter = $configWriter;
        $this->_scopeConfig = $scopeConfig;
        $this->cacheTypeList = $cacheTypeList;
    }


    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $textfield = $this->_scopeConfig->getValue('movie/movieinfo/textfield', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($textfield == 'Ping')
        {
            $this->_configWriter->save('movie/movieinfo/textfield',  'Pong','default',0);
            $this->cacheTypeList->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER);
        }

    }
}