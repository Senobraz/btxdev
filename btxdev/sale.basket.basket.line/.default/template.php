<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<span class="ajax-basket-line">
<? if ( $arResult['NUM_PRODUCTS'] > 0 ) : ?> 
<a href="<?=$arParams['PATH_TO_BASKET']?>" class="cart"><?= $arResult['TOTAL_PRICE'] ?> (<?= $arResult['NUM_PRODUCTS'] ?>)</a>
<? else: ?>
<a href="<?=$arParams['PATH_TO_BASKET']?>" class="cart"><?= GetMessage("TSB1_CART_NO") ?></a>
<? endif ?>
</span>