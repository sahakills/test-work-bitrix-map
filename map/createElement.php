<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовое задание: Create elements");

//создание элементов
$IBLOCK_ID = 0;
$maxCount = 5;
for ($i = 0; $i < $maxCount; $i++) {
    $arNewElement = array(
        "NAME" => "Тестовое имя " . $i,
        "ACTIVE" => "Y",
        "IBLOCK_ID" => $IBLOCK_ID,
        "PROPERTY_VALUES" => array(
            "PHONE" => "88005553535-" . $i,
            "EMAIL" => "mail@mail.ru-" . $i,
            "MARK" => "55.". $i ."95603557474,55.95603557474",
            "CITY" => "CITY-". $i
        )
    );
    $oElement = new CIBlockElement;
    $rsResult =  $oElement->Add($arNewElement, false, false, true);
}