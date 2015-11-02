<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="product cf">    
            <? if ($arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["NAME"]) : ?>
            <div class="prod-number"><?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["NAME"] ?>: <?= $arResult["DISPLAY_PROPERTIES"]["S_ARTICLE"]["DISPLAY_VALUE"] ?></div>
            <? endif ?>
            <div class="product__top cf">
                <div class="product__images cf">
                    <div class="product__images__main js-main-image-container">
                        <? $i=1;foreach( $arResult['MORE_PHOTO'] as $arPicture ) : ?>
                        <div class="product__images__main__img js-main-image" style="<?= $i==1 ? "display:block" : "" ?>"><img src="<?=  $arPicture["DETAIL_PICTURE"]["src"] ?>" alt=""/></div>                    
                        <? $i++;endforeach ?>
                    </div>
                    <ul class="product__images__add js-products-images">
                        <? $i=1;foreach( $arResult['MORE_PHOTO'] as $arPicture ) : ?>
                        <li class="<?= $i==1 ? "active" : "" ?>">
                            <a href="<?= $arPicture["DETAIL_PICTURE"]["src"] ?>">
                                <img src="<?= $arPicture["PREVIEW"]["src"] ?>" alt=""/>
                            </a>
                        </li>
                         <? $i++;endforeach ?>                       
                    </ul>
                </div>
                <div class="product__info">
                    <? foreach($arResult["PRICES"] as $code=>$arPrice): ?>
                        <? if( $arPrice["VALUE"] ) : ?>
                            <? if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ) : ?>
                            <div class="product__info__price"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></div>
                            <? else: ?>
                             <div class="product__info__price"><?= $arPrice["PRINT_VALUE"] ?></div>
                            <? endif ?>
                        <? endif ?>
                    <? endforeach ?>                   
                    <div class="product__info__cart">
                        <a data-num="<?= $arResult["ID"] ?>" class="button-cart js-button-cart add-item-to-basket" href="#product-lb"><?= $arParams["MESS_BTN_ADD_TO_BASKET"] ?></a>
                    </div>
                    <div class="product__info__compare ajax-compare">
                        <? //echo "<pre>"; var_dump($_SESSION["CATALOG_COMPARE_LIST"][3]); echo "</pre>"; ?>
                        <? if(!isset($_SESSION["CATALOG_COMPARE_LIST"][$arParams["IBLOCK_ID"]]["ITEMS"][$arResult["ID"]])) : ?>
                        <a class="button-compare add-compare" href=""><?= $arParams["MESS_BTN_COMPARE"] ?></a>
                        <? else : ?>
                        <a class="button-compare" href="/compare">Сравнить (<?= count($_SESSION["CATALOG_COMPARE_LIST"][$arParams["IBLOCK_ID"]]["ITEMS"]) ?>) </a>
                        <? endif ?>
                    </div>
                    <div class="product__info__delivery">
                        <? $APPLICATION->IncludeFile("/include/product_info_delivery.php", 
                            Array(), 
                            Array( "MODE"=>"html", "NAME"=>"Доставка" ) );
                        ?> 
                    </div>
                    <div class="product__info__guarantee">
                        <? $APPLICATION->IncludeFile("/include/product_info_guarantee.php", 
                            Array(), 
                            Array( "MODE"=>"html", "NAME"=>"Гарантии" ) );
                        ?> 
                    </div>
                    <div class="hide">
                        <div id="product-lb">
                            <div class="lb">
                                <div class="lb__head">
                                    Добавлено в корзину
                                </div>
                                <div class="lb__body">
                                    <div class="lb__product cf">
                                        <div class="lb__prod__body">
                                            <div class="lb__prod__title"><?= $arResult["NAME"] ?></div>
                                        </div>
                                        <div class="lb__prod__img">
                                            <img src="<?= $arResult["DETAIL_PICTURE"]["POPUP"]["src"] ?>" alt=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="lb__foot">
                                    <a class="button" href="<?= $arParams["BASKET_URL"]?>">Оформить заказ</a>
                                    <div class="lb__foot__right">
                                        <a class="button-forward" href="/catalog/">Продолжить покупки</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cf"></div>
            <div class="product__left">
                <div class="tabs">
                    <ul class="t-nav">
                        <li><a href="#tab-1" class="t-nav_current">Описание</a></li>
                        <li><a href="#tab-2">Технические характеристики</a></li>
                    </ul>
                    <div class="t-pane t-pane_current" id="tab-1">
                        <?=  $arResult["DETAIL_TEXT"] ?>
                    </div>
                    <div class="t-pane" id="tab-2"> 
                        <? //echo "<pre>"; var_dump($prop); echo "</pre>"; ?>                    
                                         
                        <table class="specs-table">
                        <? foreach( $arResult["DISPLAY_PROPERTIES"] as $key => $prop ) : ?>  
                        <? //echo "<pre>"; var_dump($prop); echo "</pre>"; ?>    
                        <? if(( strripos(" " . $key, "S_") === false ) && ( !empty($prop["VALUE"])) ) : ?>
                            <? if( is_array($prop["VALUE"]) ) : ?>
                             <tr>
                                <td><?= $prop["NAME"] ?></td>
                                <td>
                                <? foreach( $prop["VALUE"] as $val) : ?>
                                <?= $val ?> <br/>
                                <? endforeach ?>
                                </td>
                            </tr>
                            <? else: ?>
                            <tr>
                                <td><?= $prop["NAME"] ?></td>
                                <td><?= $prop["VALUE"] ?></td>
                            </tr>
                            <? endif ?>
                        <? endif ?>
                        <? endforeach ?>                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="product__right">   
                <? if ($arResult["PROPERTIES"]["S_BRAND"]["SRC"]) : ?>
                <div class="manufacturer">
                    <div class="manufacturer__title">Производитель</div>
                    <? //echo "<pre>"; var_dump($arResult["PROPERTIES"]["S_BRAND"]); echo "</pre>"; ?>
                    <img src="<?= $arResult["PROPERTIES"]["S_BRAND"]["SRC"] ?>" alt="<?= $arResult["PROPERTIES"]["S_BRAND"]["NAME"] ?>"/>
                </div>
                <? endif ?>
            </div>
        </div>

<script type="text/javascript">
    $('.add-compare').click( function(e){        
        var AddedGoodId = <?= $arResult["ID"] ?>;
        $.get("/ajax/compare.php",
        { 
            action: "ADD_TO_COMPARE_LIST", id: AddedGoodId },
            function(data) {
                $(".ajax-compare").html(data);
            }
        ); 
        e.preventDefault();
    })   
    $('.del-compare').click( function(e){        
        var AddedGoodId = <?= $arResult["ID"] ?>;
        $.get("/ajax/compare.php",
        { 
            action: "DELETE_FROM_COMPARE_LIST", id: AddedGoodId },
            function(data) {
                $(".ajax-compare").html(data);
            }
        ); 
        e.preventDefault();
    })   
</script> 