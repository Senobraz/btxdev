<?require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
 
$APPLICATION->IncludeComponent("bitrix:catalog.compare.list","ajax",
Array(
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "3",
    "DETAIL_URL" => "",
    "COMPARE_URL" => "/compare.php",
    "NAME" => "CATALOG_COMPARE_LIST",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
    )
);