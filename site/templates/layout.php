<?php

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

snippet('layout', slots: true); ?>
<h1 class="text-3xl font-bold mb-4"><?= $page->title() ?></h1>
<?= $page->blocks()->toBlocks() ?>
<?php endsnippet() ?>