<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Data\Cache;


//проверяем тип инфоблока
$this->checkIBlockSetup();
$arResult["ITEMS"] = $this->getElements();

if ($this->StartResultCache())
{
    $this->IncludeComponentTemplate();
}