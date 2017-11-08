<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 31.10.2017
 * Time: 12:35
 */

namespace Form\Post\Plugin;

use \Magento\Catalog\Model\Product;

/**
 * Class PriceChanger
 * @package Form\Post\Plugin
 */
class PriceChanger
{
    /**
     * @param Product $product
     * @param $result
     * @return float
     */
    public function afterGetPrice(Product $product, $result){
        return $result*1.20;
    }
}