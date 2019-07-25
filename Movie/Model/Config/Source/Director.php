<?php
namespace Magenest\Movie\Model\Config\Source;
class Director implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $director = $connection->fetchAll("SELECT * FROM magenest_director");

        $option[] = ['label' => '','value' => ''];

        foreach ($director as $d)
        {
            $option[] = [
                'label' => $d['name'],
                'value' => $d['director_id']
            ];
        }

        return $option;
    }
}