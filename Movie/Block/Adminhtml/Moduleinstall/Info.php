<?php

namespace Magenest\Movie\Block\Adminhtml\Moduleinstall;
use Magento\Framework\View\Element\Template;

class Info extends Template
{
    public function getNumbermodule()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(module) as numbermodule FROM setup_module");

        /*$movie = $connection->fetchAll("SELECT COUNT(movie_id) as numbermovie FROM magenest_movie");*/

        return $number;
    }

    public function getModulenotMagento()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $number = $connection->fetchOne("SELECT COUNT(module) as numbermodule FROM setup_module WHERE module not like '%Magento%'");

        /*$movie = $connection->fetchAll("SELECT COUNT(movie_id) as numbermovie FROM magenest_movie");*/

        return $number;
    }
}