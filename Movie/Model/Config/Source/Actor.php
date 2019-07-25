<?php
namespace Magenest\Movie\Model\Config\Source;
class Actor implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')
            ->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION');
        $actor = $connection->fetchAll("SELECT * FROM magenest_actor");

        /*$actor = $connection->fetchAll("SELECT COUNT(actor_id) as numberrow FROM magenest_actor");*/
        $option[] = ['label' => '','value' => ''];

        foreach ($actor as $a)
        {
            $option[] = [
                'label' => $a['name'],
                'value' => $a['actor_id']
            ];
        }

        return $option;
    }
}