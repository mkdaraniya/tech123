<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$ATTRIBUTE_CODE = 'manufacturer';
$ATTRIBUTE_GROUP = 'Product Details';

use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get(Magento\Framework\App\State::class);
$state->setAreaCode('adminhtml');

/* Attribute assign logic */
$eavSetup = $objectManager->create(\Magento\Eav\Setup\EavSetup::class);
$config = $objectManager->get(\Magento\Catalog\Model\Config::class);
$attributeManagement = $objectManager->get(\Magento\Eav\Api\AttributeManagementInterface::class);

$entityTypeId = $eavSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
$attributeSetIds = $eavSetup->getAllAttributeSetIds($entityTypeId);

foreach ($attributeSetIds as $attributeSetId) {
    if ($attributeSetId) {
        $group_id = $config->getAttributeGroupId($attributeSetId, $ATTRIBUTE_GROUP);
        $attributeManagement->assign(
            'catalog_product',
            $attributeSetId,
            $group_id,
            $ATTRIBUTE_CODE,
            999
       );
    }
}

echo "done";