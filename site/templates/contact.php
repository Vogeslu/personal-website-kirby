<?php snippet('layout', slots: true);

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$additionalLinks = $page->additionalLinks()->toStructure();
?>

<div class="flex-1 flex items-center justify-center">
    <div class="w-full max-w-[34rem]">
        <h1 class="text-5xl font-bold mb-8 lg:text-3xl"><?= $page->title() ?></h1>
        <p class="text-lg font-medium mb-8"><?= $page->subTitle() ?></p>
        <div class="flex items-center flex-wrap gap-4">
            <?php foreach ($additionalLinks as $item) : ?>
                <a class="flex items-center gap-2 text-lg hover:text-secondary dark:hover:text-tertiary transition-colors" href="<?= $item->link()->toUrl() ?>">
                    <i <?= attr(['class' => ['text-xl', $item->iconCategory(), $item->iconName()]]) ?>></i>
                    <span><?= $item->label() ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php endsnippet(); ?>