<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовое задание");
?>
<?php

    $APPLICATION->IncludeComponent(
        "bitrix:map.marks",
        "",
        array(
            "IBLOCK_CODE" => "mapmarks",
            "MAP_API_KEY" => "bb3baacb-4f22-4984-9992-9a45cd2309c4"
        )
    );

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
