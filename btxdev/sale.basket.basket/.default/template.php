<? if( count($arResult["GRID"]["ROWS"]) > 0 ) : ?>
<table class="order-products">   
		<? //echo "<pre>"; var_dump($arResult); echo "</pre>"; ?>
		<? foreach ($arResult["GRID"]["ROWS"] as $k => $arItem): ?>
		<? //echo "<pre>"; var_dump($arItem); echo "</pre>"; ?>
        <?
            if (isset($arItem["PREVIEW_PICTURE"]) && intval($arItem["PREVIEW_PICTURE"]) > 0)
			{
				$arImage = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
				if ($arImage)
				{
					$arFileTmp = CFile::ResizeImageGet(
						$arImage,
						array("width" => "94", "height" =>"134"),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true
					);

					$arItem["PREVIEW_PICTURE_SRC"] = $arFileTmp["src"];
				}
			}
        ?>
    <tr class="item-<?= $arItem["ID"] ?>">
        <td class="order-products__img">
            <div class="order-products__img__cont">
                <img src="<?= $arItem["PREVIEW_PICTURE_SRC"] ?>" alt=""/>
            </div>
        </td>        
        <td class="order-products__title">
            <?= $arItem["NAME"] ?>
            <? if($arItem["PROPS"]) : ?><br/>
                <? foreach( $arItem["PROPS"] as $prop) : ?>
                <?= $prop["NAME"] ?>: <?= $prop["VALUE"] ?><br/>
                <? endforeach ?>
            <? endif?>
        </td>
        <td class="order-products__cost">          
            <?= $arItem["PRICE_FORMATED"] ?> <span class="rub"></span>
        </td>
        <td class="order-products__quantity">
            <div class="quantity">
                <input data-balance="<?= $arItem["AVAILABLE_QUANTITY"] ?>" data-product="<?= $arItem["ID"] ?>" type="text" class="text-quantity-<?= $arItem["ID"] ?> text-quantity basket-edit-count" value="<?= $arItem["QUANTITY"] ? $arItem["QUANTITY"] : 1 ?>"/>
                <a class="quantity__up" data-num="<?= $arItem["ID"] ?>" href="#"></a>
                <a class="quantity__down" data-num="<?= $arItem["ID"] ?>" href="#"></a>
            </div>
        </td>
        <td class="order-products__sum">
            <span class="ajax-item-sum-<?= $arItem["ID"] ?>"><?= $arItem["SUM"] ?></span> <span class="rub"></span>
        </td>
        <td class="order-products__delete">
            <a href="#" data-product="<?= $arItem["ID"] ?>" class="button-delete delete-item-basket">Убрать</a>
        </td>
    </tr>
    <? endforeach; ?>	
</table>
<div class="order__sum cf">
    <div class="order__sum__left"><a class="button-back" href="/catalog/">Вернуться в каталог</a></div>
    <div class="order__sum__right"><span class="order__sum__title">Итого:</span> <span class="order__sum__value ajax-total-sum"><?= $arResult["allSum_FORMATED"] ?></span></div>
</div>
<? if( ($arParams["PATH_TO_ORDER"]) && ($arParams["PATH_TO_ORDER"] != "order.php")) : ?>
<div class="order__submit">   
    <a class="button" href="<?= $arParams["PATH_TO_ORDER"] ?>">Оформить заказ</a>
</div>
<? endif ?>
<? else: ?>
<? if( !isset($_REQUEST["ORDER_ID"]) ) : ?>
<br>
<br>
<p style="text-align: center"><?= GetMessage("SALE_NO_ITEMS") ?></p>
<? endif ?>
<? endif ?>