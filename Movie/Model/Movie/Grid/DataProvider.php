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
namespace Magenest\Movie\Model\Movie\Grid;

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

        $movie->getSelect()->join(
            ['secondTable'=>$movie->getTable('magenest_director')],
            'main_table.director_id = secondTable.director_id',
            ['nameMovie'=>'main_table.name','nameDirector'=>'secondTable.name']);

        $this->collection = $movie;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

}