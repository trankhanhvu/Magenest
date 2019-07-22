<?php
namespace Magenest\Movie\Model\Config\Source;
class Movie implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $movie = $connection->fetchAll("SELECT * FROM magenest_movie");

        /*$movie = $connection->fetchAll("SELECT COUNT(movie_id) as numbermovie FROM magenest_movie");*/

        $option[] = ['label' => '','value' => ''];

        foreach ($movie as $m)
        {
            $option[] = [
                'label' => $m['name'],
                'value' => $m['movie_id']
            ];
        }

        return $option;
    }
}