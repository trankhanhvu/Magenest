<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;

class Oddeven extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, OrderRepositoryInterface $orderRepository, SearchCriteriaBuilder $criteria, array $components = [], array $data = [])
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item)
            {
                // Odd
                if($item['entity_id']%2 == 0)
                {
                    $odd = "<div class='grid-severity-critical'><span>Odd</span></div>";
                    $item['odd/even1'] = html_entity_decode($odd);
                }
                //Even
                else
                {
                    $even = "<div class='grid-severity-notice'><span>Even</span></div>";
                    $item['odd/even1'] = html_entity_decode($even);
                }
            }
        }

        return $dataSource;
    }
}