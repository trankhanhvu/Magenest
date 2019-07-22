<?php
namespace Magenest\Movie\Model\Config\Source;
class Showhide implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => 'show',
                'label' => __('Show')
            ],
            [
                'value' => 'hide',
                'label' => __('Hide')
            ],
        ];
    }
}