<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 26.10.2017
 * Time: 11:10
 */

namespace Form\Post\Test\Unit;

use Form\Post\Helper;
use \Magento\Framework\Message\ManagerInterface;
use \Magento\Framework\App\Helper\Context;
use \Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class DataHelperTest
 * @package Form\Post\Test\Unit
 */
class DataHelperTest extends \PHPUnit\Framework\TestCase
{

    protected $helper;
    protected $context;
    protected $manager;
    protected $scopeConfig;

    public function setUp()
    {

        $this->manager = $this->createMock(ManagerInterface::class);

        $this->context = $this->createMock(Context::class);

        $this->scopeConfig = $this->getMockBuilder(ScopeConfigInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue', 'isSetFlag'])
            ->getMock();
        $this->scopeConfig->method('getValue')
            ->willReturn(true);


        $this->context->method('getScopeConfig')->willReturn($this->scopeConfig);

        $this->helper = new Helper\DataHelper($this->context, $this->manager, $this->scopeConfig);
    }

    public function testIsFormVisible()
    {
        $this->assertTrue($this->helper->isFormVisible());
    }

    public function testShowMessage()
    {
        $this->manager->expects($this->any())
            ->method('addErrorMessage')
            ->with($this->helper->showMessage(1,"message"))
            ->willReturnSelf();
    }
}