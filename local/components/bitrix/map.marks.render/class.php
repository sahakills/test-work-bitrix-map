<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("https://code.jquery.com/jquery-3.6.1.min.js");

class MapMarksRender extends CBitrixComponent
{
    public function overrideItems () {
        $arResult = array();
        if (!empty($this->arParams["ITEMS"])) {
            foreach ($this->arParams["ITEMS"] as $arValue) {
                $arElement = array();
                foreach ($arValue["PROPS"] as $sKey => $arProp) {
                    if (!empty($arProp["VALUE"])) {
                        $arCurProp = array();
                        $arCurProp["VALUE"] = $arProp["VALUE"];
                        $arCurProp["NAME"] = $arProp["NAME"];
                        $arElement[$sKey] =  $arCurProp;
                    }
                }
                $arElement["NAME"]["NAME"] = "Название организации";
                $arElement["NAME"]["VALUE"] = $arValue["NAME"];

                $arResult[] = $arElement;
            }
        }
        return $arResult;
    }
}