<?php
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$productSlider = CIBlockPriceTools::getSliderForItem($arResult, $arParams['ADD_PICT_PROP'], 'Y' == $arParams['ADD_DETAIL_TO_SLIDER']);
$productSliderCount = count($productSlider);
$arResult['SHOW_SLIDER'] = true;
$arResult['MORE_PHOTO_COUNT'] = count($productSlider);

foreach ($productSlider as $key => &$arItem) {
    $arFileTmp = CFile::ResizeImageGet(
	$arItem["ID"], array("width" => 60, "height" => 45), BX_RESIZE_IMAGE_PROPORTIONAL, true
    );
    $arItem["PREVIEW"] = $arFileTmp;

    $arFileTmp = CFile::ResizeImageGet(
	$arItem["ID"], array("width" => 480, "height" => 360), BX_RESIZE_IMAGE_PROPORTIONAL, true
    );
    $arItem["DETAIL_PICTURE"] = $arFileTmp;
}
$arResult['MORE_PHOTO'] = $productSlider;
?>