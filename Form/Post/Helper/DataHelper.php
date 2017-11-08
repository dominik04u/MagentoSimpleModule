<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 25.10.2017
 * Time: 13:57
 */

namespace Form\Post\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\ScopeInterface;

class DataHelper extends AbstractHelper
{
    const XML_PATH_ENABLED='form_post/general/enable_in_frontend'; // section/group/value

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * DataHelper constructor.
     * @param Context $context
     * @param ManagerInterface $manager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Context $context, ManagerInterface $manager, ScopeConfigInterface $scopeConfig)
    {
        $this->messageManager = $manager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @param $flag
     * @param $message
     */
    public function showMessage($flag, $message)
    {
        if ($flag == 0) {
            $this->messageManager->addErrorMessage($message);
        } else {
            $this->messageManager->addSuccessMessage($message);
        }

    }

    /**
     * @return bool
     */
    public function isFormVisible()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}