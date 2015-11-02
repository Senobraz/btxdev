<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


CIBlockPriceTools::getLabel($arResult, $arParams['LABEL_PROP']);

$productSlider = CIBlockPriceTools::getSliderForItem($arResult, $arParams['ADD_PICT_PROP'], 'Y' == $arParams['ADD_DETAIL_TO_SLIDER']);
$productSliderCount = count($productSlider);
$arResult['SHOW_SLIDER'] = true;
$arResult['MORE_PHOTO_COUNT'] = count($productSlider);

foreach ( $productSlider as $key => $arItem )
{	
	$arFileTmp = CFile::ResizeImageGet(
		$arItem["ID"],
			array("width" => 60, "height" => 45),
			//BX_RESIZE_IMAGE_EXACT,
            BX_RESIZE_IMAGE_PROPORTIONAL,
			true				
	);	
	$productSlider[$key]["PREVIEW"] = $arFileTmp;	
    
    $arFileTmp = CFile::ResizeImageGet(
		$arItem["ID"],
			array("width" => 480, "height" => 360),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true				
	);	
    
	$productSlider[$key]["DETAIL_PICTURE"] = $arFileTmp;	
}
$arResult['MORE_PHOTO'] = $productSlider;

$arFileTmp = CFile::ResizeImageGet(
	$arResult["DETAIL_PICTURE"],
		array("width" => 480, "height" => 360),
		BX_RESIZE_IMAGE_EXACT,
		true				
);	

$arResult["DETAIL_PICTURE"]["PREVIEW"] = $arFileTmp;


$arFileTmp = CFile::ResizeImageGet(
	$arResult["DETAIL_PICTURE"],
		array("width" => 108, "height" => 88),
		BX_RESIZE_IMAGE_EXACT,
		true				
);	

$arResult["DETAIL_PICTURE"]["POPUP"] = $arFileTmp;

CModule::IncludeModule("highloadblock");

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity; 

$hlbl = 1; 
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 

$fields = $GLOBALS['USER_FIELD_MANAGER']->GetUserFields('HLBLOCK_'.$hlbl, 0, LANGUAGE_ID);

$main_query = new Entity\Query($entity);
$main_query->setSelect(array('*'));
$main_query->setFilter(array('=UF_NAME' => $arResult["PROPERTIES"]["S_BRAND"]["VALUE"]));

$result = $main_query->exec();
$result = new CDBResult($result);
$row = $result->Fetch();

$arFileTmp = CFile::ResizeImageGet(
	$row["UF_FILE"],
		array("width" => 142, "height" => 30),
		BX_RESIZE_IMAGE_EXACT,
		true				
);

//var_dump($arFileTmp);

$arResult["PROPERTIES"]["S_BRAND"]["SRC"] = $arFileTmp["src"];
$arResult["PROPERTIES"]["S_BRAND"]["NAME"] = $row["UF_NAME"];


?>