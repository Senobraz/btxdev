<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

if ($_POST["is_ajax_post"] == "Y") {
    if ($arResult["ERROR"]) {
	$APPLICATION->RestartBuffer();
	$result["msg"] = implode("\n", $arResult["ERROR"]);
	$result["error"] = true;
	echo json_encode($result);
	exit;
    } elseif (strlen($arResult["REDIRECT_URL"]) > 0) {
	$APPLICATION->RestartBuffer();
	$result["msg"] = GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]));
	$result["error"] = false;
	$result["redirect"] = CUtil::JSEscape($arResult["REDIRECT_URL"]);
	echo json_encode($result);
	exit;
    }
}

foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $key => $arProperties) {
    if ($arProperties["CODE"] == "emails") {
	$arProperties["TYPE"] = "HIDDEN";
	$arResult["ORDER_PROP"]["USER_PROPS_N"][$key] = $arProperties;
    }
}


$resDelivery = CSaleDelivery::GetList(
		array(
	    "SORT" => "ASC",
	    "NAME" => "ASC"
		), array(
	    "LID" => SITE_ID,
	    "+<=ORDER_PRICE_FROM" => $arResult["ORDER_PRICE"],
	    "+>=ORDER_PRICE_TO" => $arResult["ORDER_PRICE"],
	    "ACTIVE" => "Y",
		), false, false, array()
);
if ($arDelivery = $resDelivery->Fetch()) {
    do {
	$arResult["DELIVERY"][] = $arDelivery;
    } while ($arDelivery = $resDelivery->Fetch());
} else {
    $arResult["DELIVERY"] = false;
}
?>