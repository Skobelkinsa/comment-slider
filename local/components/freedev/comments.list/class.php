<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\SystemException,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Diag\Debug,
    Bitrix\Main\Type\DateTime,
    Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
    ShowError(Loc::getMessage("SLIDER_COMMENTS_IBLOCK_MODULE_NONE"));
    return;
}

class Comments extends CBitrixComponent
{
    /**
     * @param $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams){
        try {
            if (!intval($arParams["IBLOCK_ID"])) {
                throw new SystemException(Loc::getMessage("SLIDER_COMMENTS_EXCEPTION", array("PARAMS" => "NEWS_IBLOCK_ID")));
            }
        }catch (SystemException $exception) {
            ShowError($exception->getMessage());
            die();
        }
        return array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SIZE_IMAGE_WIDTH" => $arParams["SIZE_IMAGE_WIDTH"],
            "SIZE_IMAGE_HEIGHT" => $arParams["SIZE_IMAGE_HEIGHT"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ?$arParams["CACHE_TIME"]: 36000000,
        );
    }

    /**
     * @return array|mixed
     * @throws SystemException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     */
    public function executeComponent()
    {
        if($this->startResultCache())
        {
            $this->arResult = self::getComments($this->arParams["IBLOCK_ID"]);
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }

    /**
     * @param $IB_ID
     * @return array
     * @throws SystemException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     */
    public function getComments($IB_ID){
        //Debug::dump($this->arParams);
        $arResult = [];
        if(intval($IB_ID)){
            $dbItem = Iblock\ElementTable::getList(array(
                "select" => array("*", "PREVIEW_PICTURE", "DETAIL_PAGE_URL_RAW" => "IBLOCK.DETAIL_PAGE_URL"),
                "filter" => array("IBLOCK_ID" => $IB_ID, "ACTIVE" => "Y")
            ));
            while ($arItem = $dbItem->fetch()) {
                print_r($this->arParams["SIZE_IMAGE_WIDTH"]);
                $arResult[$arItem["ID"]] = $arItem;
                if(intval($arItem['PREVIEW_PICTURE']))
                    $arResult[$arItem["ID"]]["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>$this->arParams["SIZE_IMAGE_WIDTH"], 'height'=>$this->arParams["SIZE_IMAGE_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            }
        }
        return $arResult;
    }
}