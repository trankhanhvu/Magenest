<?php
namespace Magenest\ImportReview\Model\Import;

/*use BlogTreat\CustomImport\Model\Import\CustomImport\RowValidatorInterface as ValidatorInterface;*/
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;

class Reviews extends \Magento\ImportExport\Model\Import\Entity\AbstractEntity
{
    const REVIEW_ID = 'review_id';
    const SKU = 'sku';
    const NICKNAME = 'nickname';
    const TITLE = 'title';
    const DETAIL = 'detail';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';


    const TABLE_ENTITY = 'magenest_movie';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    /*protected $_messageTemplates = [
        ValidatorInterface::ERROR_ID_IS_EMPTY => 'Empty',
    ];*/

    protected $_permanentAttributes = [self::REVIEW_ID];

    /**
     * If we should check column names
     *
     * @var bool
     */
    protected $needColumnCheck = true;

    /**
     * Valid column names
     *
     * @array
     */
    protected $validColumnNames = [
        self::REVIEW_ID,
        self::SKU,
        self::NICKNAME,
        self::TITLE,
        self::DETAIL,
        self::STATUS,
        self::CREATED_AT,
    ];

    /**
     * Need to log in import history
     *
     * @var bool
     */
    protected $logInHistory = true;

    protected $_validators = [];

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_connection;

    protected $_resource;

    /**
     * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
     */
    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\ImportExport\Helper\Data $importExportData,
        \Magento\ImportExport\Model\ResourceModel\Import\Data $importData,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\ImportExport\Model\ResourceModel\Helper $resourceHelper,
        \Magento\Framework\Stdlib\StringUtils $string,
        ProcessingErrorAggregatorInterface $errorAggregator
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->_importExportData = $importExportData;
        $this->_resourceHelper = $resourceHelper;
        $this->_dataSourceModel = $importData;
        $this->_resource = $resource;
        $this->_connection = $resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator = $errorAggregator;
    }

    public function getValidColumnNames() {
        return $this->validColumnNames;
    }

    /**
     * Entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode() {
        return 'reviews_import';
    }

    /**
     * Row validation.
     *
     * @param array $rowData
     * @param int $rowNum
     * @return bool
     */
    public function validateRow(array $rowData, $rowNum) {
        $title = false;
        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }

        $this->_validatedRows[$rowNum] = true;

        if (!isset($rowData[self::SKU]) || empty($rowData[self::SKU])) {
            $this->addRowError('SKU is empty !!!', $rowNum);
            return false;
        }
        else{
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create('Magento\Catalog\Model\Product')->loadByAttribute('sku', $rowData[self::SKU]);
            if($product == false)
            {
                $this->addRowError('SKU is not existed !!!', $rowNum);
                return false;
            }
        }

        if (!isset($rowData[self::STATUS]) || empty($rowData[self::STATUS])) {
            $this->addRowError('Status is empty !!!', $rowNum);
            return false;
        }
        elseif($rowData[self::STATUS] != 'Approved' && $rowData[self::STATUS] != 'Pending' && $rowData[self::STATUS] != 'Not Approved')
        {
            $this->addRowError('Status must be "Approved" or "Pending" or "Not Approved" !!!', $rowNum);
            return false;
        }

        return !$this->getErrorAggregator()->isRowInvalid($rowNum);
    }

    /**
     * Create advanced question data from raw data.
     *
     * @throws \Exception
     * @return bool Result of operation.
     */
    protected function _importData() {
        if (\Magento\ImportExport\Model\Import::BEHAVIOR_DELETE == $this->getBehavior()) {
            $this->deleteEntity();
        } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_REPLACE == $this->getBehavior()) {
            $this->replaceEntity();
        } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_APPEND == $this->getBehavior()) {
            $this->saveEntity();
        }
        return true;
    }

    /**
     * Save question
     *
     * @return $this
     */
    public function saveEntity() {
        $this->saveAndReplaceEntity();
        return $this;
    }

    /**
     * Replace question
     *
     * @return $this
     */
    public function replaceEntity() {
        $this->saveAndReplaceEntity();
        return $this;
    }

    /**
     * Deletes question data from raw data.
     *
     * @return $this
     */
    public function deleteEntity() {
        $ids = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            foreach ($bunch as $rowNum => $rowData) {
                $this->validateRow($rowData, $rowNum);
                if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                    $rowId = $rowData[self::REVIEW_ID];
                    $ids[] = $rowId;
                }
                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                }
            }
        }
        if ($ids) {
            $this->deleteEntityFinish(array_unique($ids),self::TABLE_ENTITY);
        }
        return $this;
    }

    /**
     * Save and replace question
     *
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function saveAndReplaceEntity() {
        $behavior = $this->getBehavior();
        $ids = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            $entityList = [];
            foreach ($bunch as $rowNum => $rowData) {
                if (!$this->validateRow($rowData, $rowNum)) {
/*                    $this->addRowError(ValidatorInterface::ERROR_MESSAGE_IS_EMPTY, $rowNum);*/
                    continue;
                }
                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                    continue;
                }
                $rowId= $rowData[self::REVIEW_ID];
                $ids[] = $rowId;
                $entityList[] = [
                    self::REVIEW_ID => $rowData[self::REVIEW_ID],
                    self::SKU => $rowData[self::SKU],
                    self::NICKNAME => $rowData[self::NICKNAME],
                    self::TITLE => $rowData[self::TITLE],
                    self::DETAIL => $rowData[self::DETAIL],
                    self::STATUS => $rowData[self::STATUS],
                    self::CREATED_AT => $rowData[self::CREATED_AT],
                ];
            }
            if (\Magento\ImportExport\Model\Import::BEHAVIOR_REPLACE == $behavior) {
                if ($ids) {
                    if ($this->deleteEntityFinish(array_unique(  $ids), self::TABLE_ENTITY)) {
                        $this->saveEntityFinish($entityList, self::TABLE_ENTITY);
                    }
                }
            } elseif (\Magento\ImportExport\Model\Import::BEHAVIOR_APPEND == $behavior) {
                $this->saveEntityFinish($entityList, self::TABLE_ENTITY);
            }
        }
        return $this;
    }

    /**
     * Save questionCREATED_AT
     *
     * @param array $priceData
     * @param string $table
     * @return $this
     */
    protected function saveEntityFinish(array $entityData, $table) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        if ($entityData) {
            foreach ($entityData as $data)
            {
                if($data[self::STATUS] == 'Approved')
                    $data[self::STATUS] = 1;
                if($data[self::STATUS] == 'Pending')
                    $data[self::STATUS] = 2;
                if($data[self::STATUS] == 'Not Approved')
                    $data[self::STATUS] = 3;

                $product = $objectManager->create('Magento\Catalog\Model\Product')->loadByAttribute('sku', $data[self::SKU]);
                $product_id = $product->getData('entity_id');

                $review = $objectManager->create('Magento\Review\Model\Review');
/*                $review->setData('review_id', $data[self::REVIEW_ID]);*/
                $review->setData('entity_pk_value',$product_id);
                $review->setData('nickname',$data[self::NICKNAME]);
                $review->setData('title',$data[self::TITLE]);
                $review->setData('detail',$data[self::DETAIL]);
                $review->setData('status_id',$data[self::STATUS]);
                $review->setData('entity_id',1);
                $review->setStores(0);
                $review->setData('created_at',$data[self::CREATED_AT]);
                $review->save();
            }
        }
        return $this;
    }

    protected function deleteEntityFinish(array $ids, $table) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        if($ids)
        {
            foreach ($ids as $id)
            {
                $review = $objectManager->create('Magento\Review\Model\Review')->load($id);
                $review->delete();
            }
            return true;
        }
        else
            return false;
    }
}