<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 07.11.2017
 * Time: 09:31
 */

namespace Form\Post\Controller\Adminhtml\Post;

use Form\Post\Model\PostFactory;
use Form\Post\Controller\Adminhtml\Post;

class Index extends Post
{
    public function execute()
    {
        if($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Form_Post::post');
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Posts'));

        return $resultPage;
    }
}