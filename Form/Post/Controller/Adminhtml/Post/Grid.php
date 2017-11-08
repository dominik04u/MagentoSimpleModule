<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 07.11.2017
 * Time: 15:07
 */

namespace Form\Post\Controller\Adminhtml\Post;

use Form\Post\Controller\Adminhtml\Post;

class Grid extends Post
{
    public function execute() {
        return $this->_resultPageFactory->create();
    }
}