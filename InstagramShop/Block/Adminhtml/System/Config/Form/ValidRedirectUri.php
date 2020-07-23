<?php
/**
 *
 * Copyright © 2018 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest_InstagramShop extension
 * NOTICE OF LICENSE
 *
 * @category Magenest
 * @package  Magenest_InstagramShop
 * @author    dangnh@magenest.com
 */

namespace Magenest\InstagramShop\Block\Adminhtml\System\Config\Form;

/**
 * Class ValidRedirectUri
 * @package Magenest\InstagramShop\Block\Adminhtml\System\Config\Form
 */
class ValidRedirectUri extends ReadonlyField
{
    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $redirectUri = $this->_urlBuilder->getUrl(\Magenest\InstagramShop\Model\Client::REDIRECT_URI_PATH);
        $element->setValue($redirectUri);
        return parent::_getElementHtml($element);
    }
}