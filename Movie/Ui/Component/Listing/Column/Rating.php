<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

class Rating extends \Magento\Ui\Component\Listing\Columns\Column {

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

                if($item['rating'] == 0)
                {
                    $item['rating'] = html_entity_decode( "<strong style='color: red'>Zero star !!!</strong>");
                }
                else
                {
                    $rating = "<div class='field-summary-rating'><div class='rating-box'>";
                    $rating = $rating . "<div class='rating' style='width:" . $item['rating']*10 ."%;'>";
                    $rating = $rating . "</div></div></div>";

                    $item['rating'] = html_entity_decode($rating);
                }


            }
        }

        return $dataSource;
    }
}