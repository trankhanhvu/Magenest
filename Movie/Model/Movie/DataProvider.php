<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_UiForm
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Magenest\Movie\Model\Movie;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {


        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $movie = $objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection');

        //get request id
        $request = $objectManager->get('Magento\Framework\App\Request\Http');
        $id = $request->getParam('id');

        $movie->getSelect()->join(
            ['secondTable'=>$movie->getTable('magenest_movie_actor')],
            'main_table.movie_id = secondTable.movie_id',
            ['idActor'=> new \Zend_Db_Expr('group_concat(`secondTable`.actor_id)')])
        ->group('main_table.movie_id');


        $check = null ;
        foreach ($movie as $m)
        {
            $idActorArray = explode(",",$m['idActor']) ;
            $m['idActor'] = $idActorArray;

            if($m['movie_id'] == $id)
            {
                $check = "1";
            }
        }

        if($check == null)
        {
            $movie = $objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection');
            $primaryFieldName = "movie_id";
            $this->collection = $movie;
        }
        else
        {
            $this->collection = $movie;
        }

        /*$this->collection = $employeeCollectionFactory->create();*/
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $movie) {
            $this->_loadedData[$movie->getId()] = $movie->getData();
        }

        return $this->_loadedData;
    }
}