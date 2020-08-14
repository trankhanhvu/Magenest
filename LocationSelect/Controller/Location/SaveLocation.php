<?php

namespace Magenest\LocationSelect\Controller\Location;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException;
use Magento\Framework\Stdlib\Cookie\FailureToSendException;

class SaveLocation extends \Magento\Framework\App\Action\Action
{
    protected $_request;
    protected $_cookieManager;
    protected $_cookieMetadataFactory;
    protected $_session;
    protected $sessionManager;

    public function __construct(Context $context,
                                \Magento\Framework\App\RequestInterface $request,
                                \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
                                \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
                                \Magento\Customer\Model\Session $session,
                                \Magento\Framework\Session\SessionManagerInterface $sessionManager)
    {
        $this->_request = $request;
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        $this->_session = $session;
        $this->sessionManager = $sessionManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $city_id = $this->_request->getParam('city_id');
        $district_id = $this->_request->getParam('district_id');
        $ward_id = $this->_request->getParam('ward_id');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getCustomer()->getId();

        if($customerID != null)
        {
            $customerObj = $objectManager->create('Magento\Customer\Model\Customer')->load($customerID);
            $customerObj->setData('city_id',$city_id);
            $customerObj->setData('district_id',$district_id);
            $customerObj->setData('ward_id',$ward_id);
            $customerObj->save();
        }
        else
        {
            /*try{
                $this->_cookieManager->deleteCookie('city_id');
                $this->_cookieManager->deleteCookie('district_id');
                $this->_cookieManager->deleteCookie('ward_id');
            }
            catch (\Exception $e) {
            }*/

            $metadata = $this->_cookieMetadataFactory
                ->createPublicCookieMetadata()
                ->setDuration(600)
                ->setPath($this->sessionManager->getCookiePath())
                ->setDomain($this->sessionManager->getCookieDomain());
            try {
                $this->_cookieManager->setPublicCookie(
                    'city_id',
                    $city_id,
                    $metadata
                );

                $this->_cookieManager->setPublicCookie(
                    'district_id',
                    $district_id,
                    $metadata
                );

                $this->_cookieManager->setPublicCookie(
                    'ward_id',
                    $ward_id,
                    $metadata
                );
            } catch (InputException $e) {
            } catch (CookieSizeLimitReachedException $e) {
            } catch (FailureToSendException $e) {
            }
        }


        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}