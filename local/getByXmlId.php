<?php
/**
 * Created by PhpStorm.
 * User: i.shchedrin
 * Date: 27.01.2019
 * Time: 23:36
 */
use Bitrix\Main\Context;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$request = Context::getCurrent()->getRequest();

$xmlId = $request->getQuery('XML_ID');
$result = [];
if (\Bitrix\Main\Loader::includeModule('catalog'))
{
    $res = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => 3,
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            'XML_ID' => $xmlId,
        ],
        false,
        false,
        [
            'ID',
            'IBLOCK_ID',
            'NAME',
            'DETAIL_PICTURE',
            'PROPERTY_*',
            '*',
        ]
        );
    while($ob = $res->GetNextElement()) {

        if (empty($ob)) {
            echo 'Товар не найден';
        }
        else {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();

            $mxResult = CCatalogSku::GetProductInfo(
                $arFields['ID']
            );

            $res = CIBlockElement::GetByID($mxResult['ID']);
            if($ar_res = $res->GetNext()) {
                $result = [
                    'NAME' => $arFields['NAME'],
                    'ARTNUMBER' => $arProps['ARTNUMBER']['VALUE'],
                    'SIZES_CLOTHES' => $arProps['SIZES_CLOTHES']['VALUE'],
                    'COLOR_REF' => $arProps['COLOR_REF']['VALUE'],
                    'PICTURE' => CFile::GetFileArray($ar_res['DETAIL_PICTURE'])['SRC']
                ];
            }
        }
    }
}

echo json_encode($result);