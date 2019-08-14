<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $id = $this->getRequest()->getParam('movie_id');

        $name = $this->getRequest()->getParam('name');
        $description=$this->getRequest()->getParam('description');
        $rating=$this->getRequest()->getParam('rating');
        $director_id =$this->getRequest()->getParam('director_id');

        //edit
        if($id != null)
        {
            $movie = $objectManager->create('Magenest\Movie\Model\Movie')->load($id);
            $movie->setName($name);
            $movie->setDescription($description);
            $movie->setRating($_POST['star']*2);
            $movie->setDirector_id($director_id);
            $movie->save();
        }
        //add
        else
        {
            $movie = $objectManager->create('Magenest\Movie\Model\Movie');
            $movie->setName($name);
            $movie->setDescription($description);
            $movie->setRating($rating);
            $movie->setDirector_id($director_id);
            $movie->save();
        }

        //add or edit actor
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $sql = "DELETE FROM magenest_movie_actor WHERE movie_id ='".$movie->getMovie_id() ."'";
        $connection->query($sql);

        if(isset($_POST['idActor']))
        {
            if($_POST['idActor'] != "")
            {
                foreach ($_POST['idActor'] as $actorID)
                {
                    $sql = "INSERT INTO magenest_movie_actor VALUES ('". $movie->getMovie_id() . "',
                        '". $actorID ."')";
                    $connection->query($sql);
                }
            }
        }



            //SEND EVENT CHANGE RATING = 0

            $parameters =['id'=>$movie->getMovie_id()];

            /*$this->_eventManager->dispatch('save_movie', $parameters);*/

            $this->messageManager->addSuccess(__('Successfully saved the item.'));
            $objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

            $this->_redirect('*/*/');
    }
}