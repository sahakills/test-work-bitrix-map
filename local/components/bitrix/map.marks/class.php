<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// Подключаем модуль информационных блоков
if(!CModule::IncludeModule("iblock")) return;

class MapMarks extends CBitrixComponent
{
    private $IBlock = array();

    public function checkIBlockSetup () {
        $this->checkIBlockType();

        $this->checkIBlock();
    }

    private function checkIBlockType() {
        $rsResult = CIBlockType::GetList(
            array(),
            array(
                "=ID" => $this->arParams["IBLOCK_CODE"]
            )
        );
        while ($arIBlockType = $rsResult->Fetch()) {
            $this->arResult["IBLOCK_TYPE_CURRENT"] = $arIBlockType;
        }
        if (empty($this->arResult["IBLOCK_TYPE_CURRENT"])) {
            $this->arResult["IBLOCK_TYPE_CURRENT"]= $this->createIBlockType();
        }
    }

    private function createIBlockType() {
        $oIBlockType = new CIBlockType;
        $arFields = array(
            "ID" => $this->arParams["IBLOCK_CODE"],
            "LANG" => array(
                "ru" => array(
                    "NAME" => "Офисы на карте"
                )
            )
        );
        return $oIBlockType->Add($arFields);

    }

    private function checkIBlock () {
        $rsResult = CIBlock::GetList(
            array(),
            array(
                "CODE" => $this->arParams["IBLOCK_CODE"]
            )
        );
        while ($arIBlock = $rsResult->Fetch()) {
            if ($arIBlock) {
                $this->arResult["IBLOCK_CURRENT"] = $arIBlock["ID"];
            }
        }

        if (empty($this->arResult["IBLOCK_CURRENT"])) {
            $this->arResult["IBLOCK_CURRENT"] = $this->createIBlock();
            $this->createIBlockProperty();
            $this->createElements(5);
        }
    }

    private function createIBlock() {
        $oIBlock = new CIBlock;
        $arFields = array(
            "NAME" => "Офисы на карте",
            "ACTIVE" => "Y",
            "IBLOCK_TYPE_ID" => $this->arParams["IBLOCK_CODE"],
            "SITE_ID" => array(SITE_ID),
            "CODE" => $this->arParams["IBLOCK_CODE"]
        );
        return $oIBlock->Add($arFields);
    }

    private function createIBlockProperty () {
        $arFieldsProperty = array(
            array(
                "NAME" => "Телефон",
                "ACTIVE" => "Y",
                "SORT" => "400",
                "CODE" => "PHONE",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
            ),
            array(
                "NAME" => "Email",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "EMAIL",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
            ),
            array(
                "NAME" => "Координаты",
                "ACTIVE" => "Y",
                "SORT" => "600",
                "CODE" => "MARK",
                "PROPERTY_TYPE" => "S",
                "USER_TYPE" => "map_yandex",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
            ),
            array(
                "NAME" => "Город",
                "ACTIVE" => "Y",
                "SORT" => "700",
                "CODE" => "CITY",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
            )
        );
        foreach ($arFieldsProperty as $arValue) {
            $oProp = new CIBlockProperty;
            $oProp->add($arValue);
        }
    }

    private function createElements ($maxCount) {

        for ($i = 0; $i < $maxCount; $i++) {
            $arNewElement = array(
                "NAME" => "Тестовое имя " . $i,
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
                "PROPERTY_VALUES" => array(
                    "PHONE" => "88005553535-" . $i,
                    "EMAIL" => "mail@mail.ru-" . $i,
                    "MARK" => "55.". $i ."95603557474,55.95603557474",
                    "CITY" => "CITY-". $i
                )
            );
            $oElement = new CIBlockElement;
            $oElement->Add($arNewElement, false, false, true);
        }

    }

    public function getElements() {
        $arResult = array();
        $rsResult = CIBlockElement::GetList(
            array(),
            array(
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $this->arResult["IBLOCK_CURRENT"],
            )
        );
        while ($arElement = $rsResult->GetNextElement()) {
            if ($arElement) {
                $arElement->props = $arElement->GetProperties();
                $arProps["PROPS"] = $arElement->props;
                $arResult[] = array_merge($arElement->fields, $arProps);
            }
        }
        return $arResult;
    }
}