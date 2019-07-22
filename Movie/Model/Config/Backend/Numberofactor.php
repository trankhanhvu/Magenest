<?php
namespace Magenest\Movie\Model\Config\Backend;

class Numberofactor extends \Magento\Framework\App\Config\Value
{
    public function _afterLoad()
    {

        //Get collection without using model

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $sql = "SELECT COUNT(actor_id) as rowactor from magenest_actor";
        $actor = $connection->fetchAll($sql);


        foreach ($actor as $a)
        {
            $this->setValue($a['rowactor']);
        }


    }



}