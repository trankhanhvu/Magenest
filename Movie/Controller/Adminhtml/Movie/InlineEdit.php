<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('inlineEdit triggered!');

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    /** load your model to update the data */
                    $model = $this->_objectManager->create('Magenest\Movie\Model\Movie')->load($entityId);
                    try {
                        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
                            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
                        $director = $connection->fetchOne("SELECT director_id FROM magenest_director WHERE  name ='". $postItems[$entityId]['nameDirector'] ."'");

                        $model->setData('name',$postItems[$entityId]['nameMovie']);
                        $model->setData('description',$postItems[$entityId]['description']);
                        $model->setData('director_id',$director);
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}