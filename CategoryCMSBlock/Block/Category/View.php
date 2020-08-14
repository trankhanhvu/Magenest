<?php
namespace Magenest\CategoryCMSBlock\Block\Category;

class View extends \Magento\Catalog\Block\Category\View
{
    public function getCmsBlockHtml2()
    {
        if (!$this->getData('cms_block_html')) {
            $html = $this->getLayout()->createBlock(
                \Magento\Cms\Block\Block::class
            )->setBlockId(
                $this->getCurrentCategory()->getDataByKey('landing_page2')
            )->toHtml();
            $this->setData('cms_block_html', $html);
        }
        return $this->getData('cms_block_html');
    }
}