<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["PAY_SYSTEM"]) : ?>
<div class="orderf__row">
    <p class="text-small">способы оплаты</p>
    <? foreach($arResult["PAY_SYSTEM"] as $arPaySystem) : ?>
    <div class="">
        <div class="radio">            
            <input type="radio"
				id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
				name="PAY_SYSTEM_ID"
				value="<?=$arPaySystem["ID"]?>"
				<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
				onclick=""
            />            
            <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>">
                <?=$arPaySystem["PSA_NAME"] ?> <br>
                <span><?=$arPaySystem["DESCRIPTION"] ?></span>
            </label>
        </div>
    </div>
    <? endforeach ?>	   
</div>
<? endif ?>