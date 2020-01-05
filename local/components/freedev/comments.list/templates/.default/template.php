<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
$this->addExternalJS($this->GetFolder()."/swiper.min.js");
$this->addExternalCss($this->GetFolder()."/swiper.css");
/** @var array $arResult */
?>
<div class="comments">
    <div class="container">
        <h2 class="section__heading"><?=Loc::getMessage("SLIDER_COMMENTS_TITLE")?></h2>
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?foreach ($arResult as $item):?>
                    <div class="comments_item swiper-slide">
                        <?if(strlen($item["PREVIEW_PICTURE"]["src"])):?>
                            <img
                                class="comments_item-avatar"
                                src="<?=$item["PREVIEW_PICTURE"]["src"]?>"
                                width="<?=$item["PREVIEW_PICTURE"]["width"]?>"
                                height="<?=$item["PREVIEW_PICTURE"]["height"]?>"
                                alt="<?=$item["NAME"]?>"
                            />
                        <?endif;?>
                        <div class="comments_item-footer">
                            <div class="comments_item-name"><?=$item["NAME"]?></div>
                            <div class="comments_item-desc"><?=$item["PREVIEW_TEXT"]?></div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <!-- Add Arrows -->
        <div class="comments_button comments_button--left"></div>
        <div class="comments_button comments_button--right"></div>
    </div>
</div>