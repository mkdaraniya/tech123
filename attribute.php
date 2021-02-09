<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$ATTRIBUTE_GROUP = 'Spezifikationen';
$ATTRIBUTE_CODES = ["anzahl_der_geblaesestufen","art_der_lueftung","ausfuehrung","bemessungsspannung","breite","drehzahl","einbauart","einbauort","farbe","fernbedienung","filterart","filterklasse","fluegelraddurchmesser","foerdervolumen","gewicht","grundfarbe","hoehe","kanalbreite","kanalhoehe","klappenart","laenge","leistungsaufnahme","mit_fernbedienung","mit_heizung","mit_zusatzheizung","montageart","nennleistung","nennstrom","nennweite","oszillation","schutzart_ip","tiefe","werkstoff","werkstoff_des_gehaeuses","zusammenstellung"];
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
foreach ($ATTRIBUTE_CODES as $ATTRIBUTE_CODE) {
    if ($attributeSetId = 43) {
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
