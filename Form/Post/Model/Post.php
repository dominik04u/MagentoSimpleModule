<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 27.10.2017
 * Time: 09:53
 */

namespace Form\Post\Model;


use Form\Post\Model\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Post
 * @package Form\Post\Model
 */
class Post extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Form\Post\Model\ResourceModel\Post');
    }
}