<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
    return;

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"));
while($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

$arComponentParameters = array(
	"PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("T_IBLOCK_DESC_LIST_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "SIZE_IMAGE_WIDTH" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("SIZE_IMAGE_WIDTH"),
            "TYPE" => "STRING",
            "DEFAULT" => "320"
        ),
        "SIZE_IMAGE_HEIGHT" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("SIZE_IMAGE_HEIGHT"),
            "TYPE" => "STRING",
            "DEFAULT" => "320"
        ),
        "CACHE_TIME" => Array("DEFAULT"=>36000000),
	),
);