<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 31.10.2017
 * Time: 09:53
 */

namespace Form\Post\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;

class LogSavePost implements ObserverInterface
{
    protected $_logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->_logger->info('Post has been sent');
    }

}