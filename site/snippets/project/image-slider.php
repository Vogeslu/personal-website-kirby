<?php

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$sliderItems = $page->previewImages()?->toStructure();
$isPreview = isset($preview) && $preview;

if ($sliderItems->count() > 0) :
?>
    <section class="splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul <?= attr(['class' => ['splide__list', $isPreview ? '!h-[30rem] lg:!h-80' : '!h-[40rem] lg:!h-96']]) ?>>
                <?php foreach ($sliderItems as $sliderItem) :
                    $item = $sliderItem->image()->toFile();
                    $focus = $sliderItem->image()->toFile()->focus();
                    $isCover = ($sliderItem->sizing() ?? 'cover') == 'cover';

                    if ($item) :

                        if ($isCover) {
                            $item = $item->resize($isPreview ? 900 : 1500, null, 80);
                        } else {
                            $item = $item->resize(null, null, 80);
                        }
                ?>
                        <li class="splide__slide">
                            <img <?= attr(['src' => $item->url(), 'class' => ['w-full h-full', $isCover ? 'object-cover object-center' : 'object-contain'], 'style' => [$isCover && $focus ? "object-position: $focus" : '']]) ?>>
                        </li>
                <?php endif;
                endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif;
