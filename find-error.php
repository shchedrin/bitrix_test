<?php
/**
 * Created by PhpStorm.
 * User: i.shchedrin
 * Date: 26.01.2019
 * Time: 17:42
 */
use Bitrix\Main;
use Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$request = Context::getCurrent()->getRequest();

$values = $request->getPostList();
if (!empty($values)) {
    $el = new CIBlockElement;
    $props = [
        'ERROR_TEXT' => $values['error-text'],
        'ERROR_CONTEXT' => $values['error-body'],
        'COMMENT' => $values['comment'],
        'URL' => $values['page'],
    ];

    $arLoadProductArray = [
        "IBLOCK_ID"      => 4,
        "PROPERTY_VALUES"=> $props,
        "NAME"           => "Ошибка в тексте",
        "ACTIVE"         => "Y",
    ];

    if($PRODUCT_ID = $el->Add($arLoadProductArray))
        echo "New ID: ".$PRODUCT_ID;
    else
        echo "Error: ".$el->LAST_ERROR;
}
