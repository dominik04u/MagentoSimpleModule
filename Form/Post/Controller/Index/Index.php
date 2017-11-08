<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 19.10.2017
 * Time: 14:50
 */

namespace Form\Post\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Form\Post\Helper\DataHelper;
use Form\Post\Model\PostFactory;

/**
 * Class Index
 * @package Form\Post\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $scopeConfig;
    protected $helper;
    protected $postFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param DataHelper $helper
     * @param PageFactory $resultPageFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Context $context,
                                DataHelper $helper,
                                PageFactory $resultPageFactory,
                                ScopeConfigInterface $scopeConfig,
                                PostFactory $postFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->helper = $helper;
        $this->postFactory=$postFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        //$this->dumpCollection();
        if ($this->helper->isFormVisible()) {
            $resultPage = $this->resultPageFactory->create();
        } else {
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultPage->setUrl('/');
        }
        return $resultPage;
    }


    public function dumpCollection(){
        $newsModel = $this->postFactory->create();

        // Get news collection
        $newsCollection = $newsModel->getCollection();
        // Load all data of collection
        var_dump($newsCollection->getData());
    }
}