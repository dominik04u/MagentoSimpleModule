<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 23.10.2017
 * Time: 12:45
 */

namespace Form\Post\Controller\Manage;

use Braintree\Exception;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Form\Post\Helper\DataHelper;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Action\Action;
use Form\Post\Model\PostFactory;

/**
 * Class Contact
 * @package Form\Post\Controller\Manage
 */
class Contact extends Action
{

    protected $customerRepository;
    protected $customerSession;
    protected $customer;
    protected $helper;
    protected $customerFactory;
    protected $postFactory;

    /**
     * Contact constructor.
     * @param Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $customerSession
     * @param Customer $customer
     * @param DataHelper $helper
     * @param CustomerFactory $customerFactory
     */
    public function __construct(Context $context,
                                CustomerRepositoryInterface $customerRepository,
                                Session $customerSession,
                                Customer $customer,
                                DataHelper $helper,
                                CustomerFactory $customerFactory,
                                PostFactory $postFactory)
    {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
        $this->customer = $customer;
        $this->helper = $helper;
        $this->customerFactory = $customerFactory;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            $this->helper->showMessage(0, 'Hello. You are not logged in');
        } else {
            $post = $this->getRequest()->getPost();
            $this->savePost($post);
        }
        $resultPageRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultPageRedirect->setUrl('/formpost');

        return $resultPageRedirect;
    }

    /**
     * @param $post
     */
    protected function savePost($post)
    {
        if ($post) {
            try {
                $this->customer->setData('sent_at', $post['sent_at']);
                $postModel = $this->postFactory->create();
                $postModel->setFirstname($post['firstname']);
                $postModel->setLastname($post['lastname']);
                $postModel->setContent($post['content']);
                $postModel->setSentAt($post['sent_at']);
                $postModel->setCustomerId($this->customerSession->getCustomerId());
                $postModel->save();
                $this->_eventManager->dispatch('form_post_save_form_log', ['text' => 'Post has been sent.']);
            } catch (Exception $e) {
                $this->helper->showMessage(0, $e->getMessage());
            }
            $sent_at = $this->customer->getData('sent_at');
            $this->helper->showMessage(1, 'Hello ' . $post['firstname'] . '. Well done!  ' . $sent_at);
        }
    }
}