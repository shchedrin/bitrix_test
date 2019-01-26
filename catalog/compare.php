<?php
/**
 * Created by PhpStorm.
 * User: i.shchedrin
 * Date: 26.01.2019
 * Time: 19:46
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\". Сравнение товаров");

$APPLICATION->IncludeComponent (
    "bitrix:catalog.compare.result",
    "",
    Array(
        "AJAX_MODE" => "Y",
        "NAME" => "CATALOG_COMPARE_LIST",
        "IBLOCK_TYPE" => "offers",
        "IBLOCK_ID" => "3",
        "FIELD_CODE" => array(),
        "PROPERTY_CODE" => array(),
        "OFFERS_FIELD_CODE" => array(),
        "OFFERS_PROPERTY_CODE" => array(),
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "PRICE_CODE" => array(),
        "USE_PRICE_COUNT" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "DISPLAY_ELEMENT_SELECT_BOX" => "Y",
        "ELEMENT_SORT_FIELD_BOX" => "name",
        "ELEMENT_SORT_ORDER_BOX" => "asc",
        "ELEMENT_SORT_FIELD_BOX2" => "id",
        "ELEMENT_SORT_ORDER_BOX2" => "desc",
        "HIDE_NOT_AVAILABLE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "TEMPLATE_THEME" => "blue",
    )
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
