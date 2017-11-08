<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 06.11.2017
 * Time: 15:48
 */

namespace Form\Post\Model;

use \Psr\Log\LoggerInterface;

class Cron
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger=$logger;
    }

    public function logHello()
    {
        $this->logger->info('Hello from Cron job!');
        return $this;
    }
}