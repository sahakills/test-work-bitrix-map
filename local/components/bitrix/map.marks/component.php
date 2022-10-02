<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//проверяем тип инфоблока
$this->checkIBlockSetup();
$arResult["ITEMS"] = $this->getElements();


if ($this->StartResultCache())
{
    $this->IncludeComponentTemplate();
}