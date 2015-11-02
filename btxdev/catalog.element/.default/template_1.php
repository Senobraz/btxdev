<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<? //echo "<pre>";  print_r($arResult); echo "</pre>" ?>
<div class="product cf">
	<div class="product__images">
		<div class="product__images__add">
			<div class="js-product-add-images">
				<? foreach( $arResult['MORE_PHOTO'] as $arPicture ) : ?>
				<div class="product__images__add__img" data-main-image="<?= $arPicture["SRC"] ?>" data-full-image="<?= $arPicture["SRC"] ?>">
					<div class="product__images__add__img__cont">
						<img src="<?= $arPicture["PREVIEW"]["src"] ?>" alt=""/>
					</div>
				</div>
				<? endforeach ?>				
			</div>
		</div>
		<div class="product__images__main-container">
			<div class="product__images__main js-main-image" data-zoom-image="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>">
				<div class="product__images__main__cont">
					<img src="<?= $arResult["DETAIL_PICTURE"]["PREVIEW"]["src"] ?>" alt=""/>
				</div>
			</div>
		</div>
	</div>
	<div class="product__info">		
		<p><span class="product__info__title"><?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["NAME"] ?>: <?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["DISPLAY_VALUE"] ?></span></p>
		<? if( $arResult["PREVIEW_TEXT"] ) : ?>
		<p><span class="product__info__title">состав</span> <br>
			<?= $arResult["PREVIEW_TEXT"] ?></p>
		<? endif ?>
		<p><span class="product__info__title">Размер</span></p>
		<?if( count( $arResult["OFFERS"] ) > 0 ) : ?>	
		<div class="product__info__cols">
			<?
				$print_discount_value =  "";
				$print_value =  "";		
				$discount_value =  "";
				$price_value =  "";
			?>
			<? $i=1; foreach( $arResult["OFFERS"] as $offer ) : ?>
			<?				
				$PRICE_CODE = $arParams["PRICE_CODE"][0];
				
				if( $i == 1 )
				{
					$print_discount_value =  $offer["PRICES"][$PRICE_CODE]["PRINT_DISCOUNT_VALUE"];
					$print_value =  $offer["PRICES"][$PRICE_CODE]["PRINT_VALUE"];		
					$discount_value =  $offer["PRICES"][$PRICE_CODE]["DISCOUNT_VALUE"];
					$price_value =  $offer["PRICES"][$PRICE_CODE]["VALUE"];
                    $offer_first_id = $offer["ID"];
                    $offer_size_value = $offer["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"];
				}
			?>
			<div class="product__info__cols__col">
				<span class="radio">
                    <input class="radio-size-offer" value="<?= $offer["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"] ?>" data-num="<?= $offer["ID"] ?>" 
                           data-price="<?= $offer["PRICES"][$PRICE_CODE]["PRINT_DISCOUNT_VALUE"] ?>" 
                           data-price-old="<?= $offer["PRICES"][$PRICE_CODE]["PRINT_VALUE"] ?>" type="radio" <?= $i == 1 ? "checked" : "" ?> name="size" id="size-<?=$i?>"/>
					<label for="size-<?= $i ?>"><?= $offer["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"] ?></label>
				</span>
			</div>
			<? $i++; endforeach ?>			
		</div>
		<? endif; ?>
		<div class="product__info__order cf">
			<div class="product__info__price">
				<p class="product__info__title">Цена</p>
                
                <? if( $price_value > $discount_value ) : ?>
                <div class="product__info__price__value">
                    <span class="product__info__price__value_sale"><span class="price__value_print"><?=  $print_discount_value ?></span> <span class="rub">Р</span></span>
                    <span class="old-price "><span class="price__value_print_old"><?= $print_value ?></span> <span class="rub">Р</span></span>
                </div>
                <? else: ?>
                <div class="product__info__price__value">
                    <span class="price__value_print"><?= $print_value ?></span> <span class="rub">Р</span>
                </div>
                <? endif ?>            
            </div>
			<div class="product__info__count">
				<p class="product__info__title">кол-во</p>
				<input type="text" value="1" class="text-quantity"/>
			</div>
			<div class="product__info__cart">
				<a data-num="<?= $offer_first_id ?>" class="add-item-to-basket button button_cart js-button-cart" href="#product-lb">купить</a>
			</div>
		</div>
		<? if($arResult["DISPLAY_PROPERTIES"]) : ?>
		<? foreach( $arResult["DISPLAY_PROPERTIES"] as $key => $arProperties ) : ?>
		<p><span class="product__info__title"><?= $arProperties["NAME"] ?>: <?= $arProperties["DISPLAY_VALUE"] ?></span></p>
		<? endforeach ?>
		<? endif ?>
        <? if( $arResult["DETAIL_TEXT"] ) : ?>
		<div class="spoiler js-product-spoiler">
			<div class="spoiler__container">
				<div class="product__info__description spoiler__container__text">
					<?= $arResult["DETAIL_TEXT"] ?>
				</div>
			</div>
		</div>
        <? endif ?>
		<div class="hide">
			<div id="product-lb">
				<div class="lb">
					<div class="lb__head">
						Товар добавлен в корзину
					</div>
					<div class="lb__body">
						<div class="lb__product cf">
							<div class="lb__prod__img">
								<img src="<?= $arResult["DETAIL_PICTURE"]["POPUP"]["src"] ?>" alt=""/>
							</div>
							<div class="lb__prod__body">
								<p class="lb__prod__title"><?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["NAME"] ?>: <?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["DISPLAY_VALUE"] ?></p>
								<div class="lb__prod__descr"><?= $arResult["NAME"] ?></div>
								<div class="lb__prod__body__prop cf">
									<div class="lb__prod__body__prop__title">Размер</div>
                                    <div class="lb__prod__body__prop__value"><span class="size_pop_up"><?= $offer_size_value ?></span></div>
								</div>
								<div class="lb__prod__body__prop cf">
									<div class="lb__prod__body__prop__title">цена </div>
                                    <div class="lb__prod__body__prop__value"><span class="price_pop_up"><?= $price_value > $discount_value ? $print_discount_value : $print_value ?></span> <span class="rub">Р</span></div>
								</div>
								<div class="lb__prod__body__prop cf">
									<div class="lb__prod__body__prop__title">кол-во</div>
                                    <div class="lb__prod__body__prop__value"><span class="quantity_pop_up">1</span></div>
								</div>
								<div class="lb__prod__body__prop lb__prod__body__prop_sum cf">
									<div class="lb__prod__body__prop__title">итого</div>
                                    <div class="lb__prod__body__prop__value"><span class="total_pop_up">1 590</span> <span class="rub">Р</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="lb__foot cf">
						<div class="lb__foot__left">
							<a class="button-forward" href="/catalog/">Продолжить покупки</a>
						</div>
						<div class="float-right"><a class="button" href="/basket/">оформить заказ</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>