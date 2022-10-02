<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// Подключаем модуль информационных блоков
if(!CModule::IncludeModule("iblock")) return;
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=". $arParams["MAP_API_KEY"] ."&lang=ru_RU");

$arResult["ITEMS"] = $this->overrideItems();
if ($this->StartResultCache())
{
    $this->IncludeComponentTemplate();
}