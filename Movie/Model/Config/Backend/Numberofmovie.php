<?php
namespace Magenest\Movie\Model\Config\Backend;

class Numberofmovie extends \Magento\Framework\App\Config\Value
{
    public function _afterLoad()
    {

        //Get collection without using model

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $sql = "SELECT COUNT(movie_id) as rowmovie from magenest_movie";
        $movie = $connection->fetchAll($sql);


        foreach ($movie as $m)
        {
            $this->setValue($m['rowmovie']);
        }


    }



}