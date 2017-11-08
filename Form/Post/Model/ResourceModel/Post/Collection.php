<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 27.10.2017
 * Time: 10:09
 */

namespace Form\Post\Model\ResourceModel\Post;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct(){
        $this->_init('Form\Post\Model\Post', 'Form\Post\Model\ResourceModel\Post');
    }
}