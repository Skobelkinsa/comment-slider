<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="comments">
    <div class="container">
        <h2 class="section__heading"><?=GetMessage("SLIDER_COMMENTS_TITLE")?></h2>
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
<script>
    $(function () {
        $.getScript('<?=$this->GetFolder()."./swiper.min.js"?>', function(){
            new Swiper('.comments .swiper-container', {
                slidesPerView: 3,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.comments .swiper-pagination',
                },
                navigation: {
                    nextEl: '.comments_button--right',
                    prevEl: '.comments_button--left',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 1,
                    }
                },
            });
        });
    });
</script>