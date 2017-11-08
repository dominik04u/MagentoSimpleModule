<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 23.10.2017
 * Time: 14:26
 */

namespace Form\Post\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }


    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.12', '<')) {
            /** @var CustomerSetup $customerSetup */
            $setup->startSetup();
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);


            $attributesInfo = [
                'sent_at' => [
                    'label' => 'Sent At',
                    'type' => 'datetime',
                    'input' => 'date',
                    'position' => 1000,
                    'visible' => true,
                    'required' => false,
                    'system' => 0,
                    'user_defined' => true,
                    'position' => 1000,
                    'sort_order' => 1000
                ]
            ];

            $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
            $attributeSetId = $customerEntity->getDefaultAttributeSetId();

            /** @var $attributeSet AttributeSet */
            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

            foreach ($attributesInfo as $attributeCode => $attributeParams) {
                $customerSetup->addAttribute(Customer::ENTITY, $attributeCode, $attributeParams);
            }

            $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'sent_at')
                ->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' =>  ['adminhtml_customer', 'customer_account_edit', 'customer_account_create'] ,
                ]);

            $attribute->save();
            $setup->endSetup();
        }
    }
}