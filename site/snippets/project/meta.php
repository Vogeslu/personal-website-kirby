<?php

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

use Kirby\Cms\Url;

$blocks = $page->blocks()->toBlocks();
$links = $page->links()->toStructure();

$bigLinks = [];
$iconLinks = [];

foreach ($links as $link) {
    if (!$link->label()->isEmpty()) {
        $bigLinks[] = $link;
    } else {
        $iconLinks[] = $link;
    }
}

?>
<div <?= attr(['class' => ['flex-1 min-w-52 text-sm', $blocks->count() > 0 ? 'max-w-[20rem]' : '', 'lg:max-w-full']]) ?>>
    <dt class="font-semibold mb-1">Kategorien</dt>
    <dd><?= $page->tags() ?></dd>
    <?php if ($page->timespan()->isNotEmpty()) : ?>
        <div class="border-b border-zinc-200 dark:border-slate-800 my-4"></div>
        <dt class="font-semibold mb-1">Zeitraum</dt>
        <dd><?= $page->timespan() ?></dd>
    <?php endif; ?>

    <?php
    $involvedPersons = $page->involvedPersons()->toStructure();
    $personIndex = 0;

    if ($involvedPersons->count() > 0) : ?>
        <div class="border-b border-zinc-200 dark:border-slate-800 my-4"></div>
        <dt class="font-semibold mb-1">Beteiligte Personen</dt>
        <dd>
            <?php foreach ($involvedPersons as $person) :
                $link = $person->link()->toUrl();
            ?>
                <?= $personIndex > 0 ? ', ' : '' ?>
                <a <?= attr(['href' => $link ? $link : null, 'target' => '_blank']) ?>><?= $person->name() ?></a>
            <?php $personIndex++;
            endforeach; ?>
        </dd>
    <?php endif; ?>

    <?php if ($links->count() > 0) : ?>
        <div class="border-b border-zinc-200 dark:border-slate-800 my-4"></div>
    <?php endif; ?>
    <?php foreach ($bigLinks as $link) :
        $url = $link->link()->url();
        $prettifiedLink = Url::short($url);
    ?>
        <dt class="font-semibold mb-1"><?= $link->label() ?></dt>
        <dd class="mb-3">
            <a class="truncate max-w-full block text-primary dark:text-tertiary hover:text-secondary dark:hover:text-slate-200 transition-colors" href="<?= $url ?>" target="_blank"><?= $prettifiedLink ?></a>
        </dd>
    <?php endforeach; ?>
    <?php if (sizeof($iconLinks) > 0) : ?>
        <?php if (sizeof($bigLinks) > 0) : ?>
            <div class="border-b border-zinc-200 dark:border-slate-800 my-4"></div>
        <?php endif; ?>
        <div class="flex gap-2 flex-wrap mb-3">
            <?php foreach ($iconLinks as $link) : ?>
                <a href="<?= $link->link()->url() ?>" target="_blank" class="bg-slate-100 dark:bg-slate-800 rounded-full w-10 h-10 flex items-center justify-center text-lg text-primary dark:text-slate-100 hover:text-secondary dark:hover:text-tertiary transition-colors">
                    <i class="<?= $link->iconCategory() ?> <?= $link->iconName() ?>"></i>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>