<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

class DirectorName extends \Magento\Ui\Component\Listing\Columns\Column {

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $director = $objectManager->create('Magenest\Movie\Model\Director')->load($item['director_id']);
                $item['director_id'] = $director['name'];

            }
        }

        return $dataSource;
    }
}