<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 19.10.2017
 * Time: 14:52
 */

namespace Form\Post\Block;

use \Magento\Backend\Block\Template\Context;
use \Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Form\Post\Model\PostFactory;

/**
 * Class Formpost
 * @package Form\Post\Block
 */
class Post extends Template
{

    protected $customerSession;
    protected $postFactory;
    /**
     * Formpost constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context,
                                Session $customerSession,
                                PostFactory $postFactory,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->customerSession=$customerSession;
        $this->postFactory=$postFactory;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return '/formpost/manage/contact';
    }

    /**
     * @return int
     */
    public function getPostCounter()
    {
        $customerId=$this->customerSession->getCustomer()->getId();
        $postCollection=$this->getPosts();
        $postCounter=0;
        foreach ($postCollection as $post) {
            if ($post->getCustomerId() == $customerId) {
                $postCounter++;
            }
        }
        return $postCounter;
    }

    /**
     * @return mixed
     */
    public function getPosts(){
        $collection = $this->postFactory->create()->getCollection();
        return $collection;
    }

}