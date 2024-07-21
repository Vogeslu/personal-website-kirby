<?php

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

snippet('layout', slots: true); ?>
<h1 class="text-3xl font-bold mb-4"><?= $page->title() ?></h1>
<?php
$blocks = $page->blocks()->toBlocks();

if ($blocks->count() > 0) :
?>
    <div class="content flex flex-col gap-6 flex-1">
        <?php foreach ($page->blocks()->toBlocks() as $block) : ?>
            <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
                <?php snippet('blocks/' . $block->type(), [
                    'block' => $block
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; endsnippet() ?>