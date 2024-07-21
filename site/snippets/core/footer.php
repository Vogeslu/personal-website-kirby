<?php

/** @var Kirby\Cms\Site $site */ ?>

<footer class="container">
    <div class="flex items-center justify-between border-t border-t-zinc-200 dark:border-t-slate-800 py-4 lg:flex-col lg:justify-start lg:gap-4">
        <div class="lg:w-full">
            <span class="block mb-1"><?= $site->footerCopyrightText() ?></span>
            <span class="text-sm">Built with <i class="fa-solid fa-heart text-red-600"></i>,
                <a target="_blank" href="https://getkirby.com/">Kirby CMS</a>,
                <a target="_blank" href="https://tailwindcss.com/">Tailwind CSS</a> &
                <a target="_blank" href="https://fontawesome.com/">fontawesome</a>
            </span>
        </div>
        <div class="flex flex-wrap gap-3 lg:w-full">
            <?php foreach ($site->footerPages()->toPages() as $page) : ?>
                <a <?= attr(['href' => $page->url()]) ?>><?= $page->title() ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>