<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php
    $APPLICATION->IncludeComponent(
        "bitrix:map.marks.render",
        "",
        array(
            "ITEMS" => $arResult["ITEMS"],
            "MAP_API_KEY" => $arParams["MAP_API_KEY"]
        ),
        $component
    );
?>