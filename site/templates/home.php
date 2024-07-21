<?php snippet('layout', slots: true);

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$items = $page->items()->toStructure();
$additionalLinks = $page->additionalLinks()->toStructure();
?>

<div class="flex-1 flex items-center justify-center">
    <div class="w-full max-w-[38rem]">
        <h1 class="text-5xl font-bold mb-2 lg:text-3xl"><?= $page->bigTitle() ?></h1>
        <p class="text-2xl font-medium lg:text-xl"><?= $page->subTitle() ?></p>
        <div class="my-8 flex flex-col gap-2">
            <?php foreach ($items as $item) : ?>
                <div class="flex items-center gap-2 text-lg with-links">
                    <div class="w-8 h-8 flex items-center justify-center text-xl">
                        <i <?= attr(['class' => [$item->iconCategory(), $item->iconName()]]) ?>></i>
                    </div>
                    <div class="flex-1">
                        <?= $item->text()->kt() ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h2 class="text-2xl font-bold mb-3 lg:text-xl">Weitere Links</h2>
        <div class="flex items-center flex-wrap gap-4 lg:flex-col lg:items-start">
            <?php foreach ($additionalLinks as $item) : ?>
                <a class="flex items-center gap-2 text-lg hover:text-secondary dark:hover:text-tertiary transition-colors" href="<?= $item->link()->toUrl() ?>" target="_blank">
                    <i <?= attr(['class' => ['text-xl', $item->iconCategory(), $item->iconName()]]) ?>></i>
                    <span><?= $item->label() ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php endsnippet(); ?>