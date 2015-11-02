<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
global $DB;
/** @global CUser $USER */
global $USER;
/** @global CMain $APPLICATION */
global $APPLICATION;

$action = $_POST['action'] ? htmlspecialchars(strip_tags($_POST['action'])) : "";
$quantity = $_POST['q'] ? (float) htmlspecialchars(strip_tags($_POST['q'])) : 1;
$productID = $_POST['p'] ? htmlspecialchars(strip_tags($_POST['p'])) : "";


/* if( !$USER->IsAuthorized())
  {
  echo json_encode($arResult["msg"] = "нет доступа");
  exit;
  } */

if ($action == "add_to_basket") {
    $arResult = array();

    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
        if (IntVal($productID) > 0) {

            $prop = array();
            $res = CIBlockElement::GetProperty(5, $productID, array("sort" => "asc"), array("CODE" => "SIZE"));
            while ($ob = $res->GetNext()) {
                $prop[] = $ob;
            }

            if ($ID = Add2BasketByProductID($productID, $quantity, array(), $prop)) {
                $arResult["msg"] = "Товар добавлен в корзину.";
            } else {
                $arResult["msg"] = "Ошибка добавления в корзину.";
            }

            $arProduct = CSaleBasket::GetByID($ID);
            $arResult["item"]["SUM"] = $arProduct["PRICE"] * $quantity;
            $arResult["item"]["SUMF"] = CurrencyFormat($arProduct["PRICE"] * $quantity, 'RUB');
        }
    }
}

if ($action == "update_to_basket") {
    $arResult = array();

    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
        if (IntVal($productID) > 0) {
            $arFields = array(
                "QUANTITY" => $quantity,
            );
            CSaleBasket::Update($productID, $arFields);

            //Выводим актуальный элемент корзины
            $arProduct = CSaleBasket::GetByID($productID);
            $arResult["items"][$productID]["SUM"] = $arProduct["PRICE"] * $quantity;
            //$arResult["items"][$productID]["SUM"] =  number_format($arProduct["PRICE"] * $quantity, 2,"."," ");
            $arResult["items"][$productID]["SUMF"] = CurrencyFormat($arProduct["PRICE"] * $quantity, 'RUB');
            //$arResult["items"][$productID]["SUMF"] = number_format($arProduct["PRICE"] * $quantity, 2, ".", " ");
        }
    }
}

if ($action == "delete_to_basket") {
    $arResult = array();

    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
        if (IntVal($productID) > 0) {

            if (CSaleBasket::Delete($productID)) {
                $arResult["msg"] = "Товар удален из корзины.";
            } else {
                $arResult["msg"] = "Ошибка удаления товара";
            }
        }
    }
}

ob_start();

$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default", array(
    "PATH_TO_BASKET" => SITE_DIR . "basket/",
    "PATH_TO_PERSONAL" => SITE_DIR . "basket/order/",
    "SHOW_PERSONAL_LINK" => "N"
        ), false, Array('')
);

$outIncludeComponent = ob_get_contents();
ob_end_clean();
$arResult['basket_line'] = $outIncludeComponent;

ob_start();

$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "json", array(
    "PATH_TO_BASKET" => SITE_DIR . "basket/",
    "PATH_TO_PERSONAL" => SITE_DIR . "basket/order/",
    "SHOW_PERSONAL_LINK" => "N"
        ), false, Array('')
);

$outIncludeComponent = ob_get_contents();
ob_end_clean();

$arResult['basket'] = json_decode($outIncludeComponent);

if (IntVal($arResult['basket']->NUM_PRODUCTS) <= 0) {
    $arResult['render'] = "/basket/";
}

$arResult['product'] = $productID;
$arResult['error'] = false;

// Печатаем массив, содержащий актуальную на текущий момент корзину

echo json_encode($arResult);
?>