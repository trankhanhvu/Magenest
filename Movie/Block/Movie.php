<?php
namespace Magenest\Movie\Block;
use Magento\Framework\View\Element\Template;
class Movie extends Template
{
    public function getMovieInformation()
    {
        //Get collection by join

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $movie = $objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection');

        $movie->getSelect()->join(
            ['secondTable'=>$movie->getTable('magenest_director')],
            'main_table.director_id = secondTable.director_id',
            ['nameMovie'=>'main_table.name','nameDirector'=>'secondTable.name'])
        ->join(
            ['thirdTable'=>$movie->getTable('magenest_movie_actor')],
            'main_table.movie_id = thirdTable.movie_id',
            array('*'))
        ->join(
            ['fourthTable'=>$movie->getTable('magenest_actor')],
            'thirdTable.actor_id = fourthTable.actor_id',
            ['nameActor'=> new \Zend_Db_Expr('group_concat(`fourthTable`.name)')])
        ->group('main_table.movie_id','thirdTable.actor_id');


        //Get collection without using model

        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $sql = "SELECT magenest_movie.name as nameMovie, magenest_director.name as nameDirector, magenest_actor.name as nameActor
                    FROM magenest_movie,magenest_director,magenest_movie_actor,magenest_actor
                    WHERE magenest_movie.movie_id =  magenest_movie_actor.movie_id
                    AND  magenest_movie.director_id = magenest_director.director_id
                    AND magenest_movie_actor.actor_id = magenest_actor.actor_id";
        $movie = $connection->fetchAll($sql);*/

        return $movie;
    }

    public function testFunction(){
        return "test 1";
    }

    public function testFunction2(){
        return "test 2";
    }

    public function testCreateBlock()
    {
        $block = $this->getLayout()->createBlock("Magenest\Movie\Block\Movie2");
        return $block;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this ->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA );
        return $mediaUrl;
    }
}
