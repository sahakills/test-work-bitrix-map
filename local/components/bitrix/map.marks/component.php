<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($this->StartResultCache())
{
    //проверяем тип инфоблока
    $this->checkIBlockSetup();
    $arResult["ITEMS"] = $this->getElements();
}
$this->IncludeComponentTemplate();