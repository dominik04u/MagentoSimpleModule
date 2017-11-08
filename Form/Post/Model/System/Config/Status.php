<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 07.11.2017
 * Time: 15:12
 */

namespace Form\Post\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface {
    const ENABLED = 1;
    const DISABLED = 0;

    public function toOptionArray() {
        $options = [
            self::ENABLED => __('Enabled'),
            self::DISABLED => __('Disabled')
        ];

        return $options;
    }
}