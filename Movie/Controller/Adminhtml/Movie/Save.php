<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $name = $this->getRequest()->getParam('name');
        $description=$this->getRequest()->getParam('description');
        $rating=$this->getRequest()->getParam('rating');
        $director_id =$this->getRequest()->getParam('director_id');


            $movie = $objectManager->create('Magenest\Movie\Model\Movie');
            $movie->setName($name);
            $movie->setDescription($description);
            $movie->setRating($rating);
            $movie->setDirector_id($director_id);
            $movie->save();

            //SEND EVENT CHANGE RATING = 0

            $parameters =['id'=>$movie->getMovie_id()];

            $this->_eventManager->dispatch('save_movie', $parameters);



            $this->messageManager->addSuccess(__('Successfully saved the item.'));
            $objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

            $this->_redirect('*/*/');


    }
}