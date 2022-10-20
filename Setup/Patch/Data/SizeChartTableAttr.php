<?php

declare(strict_types=1);

namespace RLTSquare\SizeChart\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class SizeChartTableAttr
 * @package RLTSquare\SizeChart\Setup\Patch\Data
 */
class SizeChartTableAttr implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * SizeChartTableAttr constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory          $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $isExist = $this->eavSetupFactory->create()->getAttribute(
            Product::ENTITY,
            "size_chart_table_html"
        );
        if (!$isExist) {
            $eavSetup->addAttribute(Product::ENTITY, 'size_chart_table_html', [
                'type' => 'text',
                'label' => 'Size Chart',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'input' => 'textarea',
                'visible' => true,
                'used_in_product_listing' => true,
                'user_defined' => true,
                'required' => false,
                'group' => 'General',
                'is_visible_on_front' => 1
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
