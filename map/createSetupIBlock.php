<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовое задание: Создание структуры из инфоблоков");


$IBLOCK_CODE = "mapmarks";

$IBLOCK_TYPE_CURRENT = 0;
$IBLOCK_CURRENT = 0;
//соданием тип инфлоблока
$rsResultIBlockType = CIBlockType::GetList(
    array(),
    array(
        "=ID" => $IBLOCK_CODE
    )
);
while ($arIBlockType = $rsResultIBlockType->Fetch()) {
    $IBLOCK_TYPE_CURRENT = $arIBlockType;
}
if ($IBLOCK_TYPE_CURRENT == 0) {
    $IBLOCK_TYPE_CURRENT = createIBlockType($IBLOCK_CODE);
}

//создаем инфоблок
$rsResultIBlock = CIBlock::GetList(
    array(),
    array(
        "CODE" => $IBLOCK_CODE
    )
);
while ($arIBlock = $rsResultIBlock->Fetch()) {
    if ($arIBlock) {
        $IBLOCK_CURRENT = $arIBlock["ID"];
    }
}

if ($IBLOCK_CURRENT == 0) {
    $IBLOCK_CURRENT = createIBlock($IBLOCK_CODE);
    createIBlockProperty($IBLOCK_CURRENT);
}


function createIBlockType($IBLOCK_CODE) {
    $oIBlockType = new CIBlockType;
    $arFields = array(
        "ID" => $IBLOCK_CODE,
        "LANG" => array(
            "ru" => array(
                "NAME" => "Офисы на карте"
            )
        )
    );
    return $oIBlockType->Add($arFields);
}

function createIBlock($IBLOCK_CODE) {
    $oIBlock = new CIBlock;
    $arFields = array(
        "NAME" => "Офисы на карте",
        "ACTIVE" => "Y",
        "IBLOCK_TYPE_ID" => $IBLOCK_CODE,
        "SITE_ID" => array(SITE_ID),
        "CODE" => $IBLOCK_CODE
    );
    return $oIBlock->Add($arFields);
}

function createIBlockProperty ($IBLOCK_CURRENT) {
    $arFieldsProperty = array(
        array(
            "NAME" => "Телефон",
            "ACTIVE" => "Y",
            "SORT" => "400",
            "CODE" => "PHONE",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $IBLOCK_CURRENT,
        ),
        array(
            "NAME" => "Email",
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "EMAIL",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $IBLOCK_CURRENT,
        ),
        array(
            "NAME" => "Координаты",
            "ACTIVE" => "Y",
            "SORT" => "600",
            "CODE" => "MARK",
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "map_yandex",
            "IBLOCK_ID" => $IBLOCK_CURRENT,
        ),
        array(
            "NAME" => "Город",
            "ACTIVE" => "Y",
            "SORT" => "700",
            "CODE" => "CITY",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $IBLOCK_CURRENT,
        )
    );
    foreach ($arFieldsProperty as $arValue) {
        $oProp = new CIBlockProperty;
        $oProp->add($arValue);
    }
}