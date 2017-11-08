<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 07.11.2017
 * Time: 15:03
 */

namespace Form\Post\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Form\Post\Model\PostFactory;

abstract class Post extends Action
{
    protected $_coreRegistry;

    protected $_resultPageFactory;

    protected $_postFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Form_Post::manage_post');
    }
}