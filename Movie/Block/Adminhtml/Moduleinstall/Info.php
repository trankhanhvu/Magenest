<?php

namespace Magenest\Movie\Block\Adminhtml\Moduleinstall;
use Magento\Framework\View\Element\Template;

class Info extends Template
{
    protected $fullModuleList;

    public function __construct(Template\Context $context, array $data = [],
                                \Magento\Framework\Module\FullModuleList $fullModuleList)
    {
        $this->fullModuleList = $fullModuleList;
        parent::__construct($context, $data);
    }

    public function getNumbermodule()
    {
        //cách 1:
        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(module) as numbermodule FROM setup_module");*/
        
        // cách 2
        $allModules = $this->fullModuleList->getAll();

        return count($allModules);
    }

    public function getModulenotMagento()
    {
        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(module) as numbermodule FROM setup_module WHERE module not like '%Magento%'");*/

        $allModules = $this->fullModuleList->getNames();
        $num = 0;
        foreach ($allModules as $name)
        {
            if(strpos($name, 'Magento') === false)
                $num++;
        }

        return $num;
    }
}