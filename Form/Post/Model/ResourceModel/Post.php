<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 27.10.2017
 * Time: 10:06
 */

namespace Form\Post\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_example_post','post_id');
    }

}
