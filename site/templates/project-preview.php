<div class="fixed flex left-0 top-0 w-screen h-full bg-black/50 z-50 max-h-full overflow-y-auto">
    <div class="flex-grow">
        <div class="p-8 lg:p-4">
            <div class="bg-slate-100 dark:bg-slate-900 rounded p-8 container max-w-[60rem]">
                <div class="flex items-start justify-between mb-4 lg:flex-col lg:gap-3">
                    <h1 class="text-3xl font-bold"><?= $page->title() ?></h1>
                    <div class="flex gap-2">
                        <a href="<?= $page->url() ?>" class="py-2 px-4 rounded bg-zinc-200 dark:bg-slate-800 hover:bg-zinc-300 dark:hover:bg-slate-700 transition-colors border-zinc-200 gap-2 flex items-center">
                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                            <span>Öffnen</span>
                        </a>
                        <span class="close py-2 px-4 rounded bg-zinc-200 dark:bg-slate-800 hover:bg-zinc-300 dark:hover:bg-slate-700 transition-colors border-zinc-200 gap-2 flex items-center cursor-pointer">
                            <i class="fa-solid fa-times"></i>
                            <span>Schließen</span>
                        </span>
                    </div>
                </div>
                <?php snippet('project/image-slider', ['preview' => true]); ?>
                <div class="flex flex-wrap mt-4 gap-8 lg:flex-col">
                    <?php snippet('project/content'); ?>
                    <?php snippet('project/meta'); ?>
                </div>
            </div>
        </div>
    </div>
</div>