<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 07.11.2017
 * Time: 09:26
 */

namespace Form\Post\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Post extends Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Form_Post';
        $this->_headerText = __('Customer Posts');
        $this->_addButtonLabel = __('Add Post');
        parent::_construct();
    }
}