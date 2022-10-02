<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Data\Cache;

$sCacheDir = '/' . SITE_ID . $this->GetRelativePath();
$oCache    = Cache::createInstance();
$sCacheId = md5(json_encode(array_merge($arParams, array(SITE_ID), array_merge($this->arResult["IBLOCK_TYPE_CURRENT"] , $this->arResult["IBLOCK_TYPE_CURRENT"]))));
if($oCache->startDataCache($this->arParams["CACHE_TIME"], $sCacheId, $sCacheDir)) {
    //проверяем тип инфоблока
    $this->checkIBlockSetup();
    $arResult["ITEMS"] = $this->getElements();

} else{
    $arCacheVars = $oCache->GetVars();
    $this->arResult = $arCacheVars["arResult"];
    $this->SetTemplateCachedData($arCacheVars["templateCachedData"]);
}


if ($this->StartResultCache())
{
    $this->IncludeComponentTemplate();
}