<?php

/** @var Kirby\Cms\Site $site */

$darkmode = null;

if (isset($_COOKIE['darkmode'])) {
    $darkmode = $_COOKIE['darkmode'] == 'true';
}

?>

<nav id="nav" class="bg-slate-100 dark:bg-slate-900 border-b border-b-slate-200 dark:border-b-slate-800 dark:text-slate-100 flex items-center h-16">
    <div class="container">
        <div class="flex items-center gap-2 relative">
            <a href="<?= $site->url() ?>" class="text-xl font-semibold"><?= $site->title() ?></a>
            <div class="flex-1"></div>
            <div class="flex items-center gap-4 lg:flex-row-reverse">
                <input class="peer absolute pointer-events-none opacity-0" type="checkbox" id="mobile-toggle">
                <label for="mobile-toggle" class="relative h-10 w-10 items-center justify-center rounded hover:bg-black/10 dark:hover:bg-white/5 text-lg cursor-pointer transition-colors hidden lg:flex">
                    <i class="fa-solid fa-bars"></i>
                </label>
                <div class="lg:absolute lg:top-full lg:right-0 lg:w-full lg:pt-4 lg:opacity-0 lg:pointer-events-none peer-checked:lg:opacity-100 peer-checked:lg:pointer-events-auto transition-opacity">
                    <div class="lg:bg-slate-100 dark:lg:bg-slate-900 w-full ml-auto flex items-center gap-1 lg:border lg:border-slate-200 lg:dark:border-slate-800 rounded lg:flex-col lg:p-2 z-20 relative">
                        <?php foreach ($site->navigationPages()->toPages() as $page) : ?>
                            <a <?= attr(['class' => ['lg:w-full flex items-center gap-2 py-2 px-3 rounded hover:bg-black/10 dark:hover:bg-white/5 transition-colors', $page->isActive() ? 'bg-black/15 dark:bg-white/5' : ''], 'href' => $page->url()]) ?>>
                                <i class="<?= $page->iconCategory() . ' ' . $page->iconName() ?> text-secondary dark:text-tertiary"></i>
                                <span>
                                    <?= $page->title() ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <label class="flex items-center justify-between px-2.5 h-8 w-16 bg-slate-300 dark:bg-slate-700 rounded-2xl relative cursor-pointer overflow-hidden text-white" for="darkmode-toggle">
                        <input <?= attr(['checked' => $darkmode, 'type' => 'checkbox', 'class' => 'absolute opacity-0 peer', 'id' => 'darkmode-toggle']) ?>>
                        <div class="h-full w-1/2 aspect-square absolute bg-yellow-400 left-0 peer-checked:bg-slate-800 peer-checked:left-1/2 peer-checked:w-2/3 transition-all transition-none transition-block"></div>
                        <i class="fa-solid fa-sun relative text-zinc-700 dark:text-slate-600"></i>
                        <i class="fa-solid fa-moon relative text-zinc-700 peer-checked:text-white transition-colors transition-none transition-block"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
</nav>