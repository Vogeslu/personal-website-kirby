<?php

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$pages = $site->breadcrumb();

if ($pages->count() > 1) : ?>
    <div class="mb-4">
        <?php
        $index = 0;
        foreach ($pages as $page) : ?>
            <?php if ($index > 0) : ?><span>/</span><?php endif; ?>
            <a <?= attr([
                    'href' => $page->url(),
                    'class' => [
                        ...($page->isActive() ? ['text-secondary dark:text-tertiary'] : [])
                    ]
                ]) ?>><?= $page->title() ?></a>
        <?php
            $index++;
        endforeach; ?>
    </div>
<?php endif;
