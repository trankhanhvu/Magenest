<?php
namespace Magenest\Cybergame\Controller\Adminhtml\GamerAccountList;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(Context $context, PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->_setActiveMenu('Magenest_Cybergame::room_extra_option');
        $resultPage->getConfig()->getTitle()->prepend(__('Room Extra Option'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Cybergame::room_extra_option');
    }
}