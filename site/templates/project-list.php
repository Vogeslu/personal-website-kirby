<?php snippet('layout', slots: true);

/**
 * @var Kirby\Cms\App $kirby
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Site $site
 */

$projects = $page->children();
$categoryOrder = $page->categoryOrder()->split();

$categoriesWithProjects = [];

foreach ($categoryOrder as $category) {
    $categoriesWithProjects[$category] = [];
}

foreach ($projects as $project) {
    $firstCategory = $project->categories()->split()[0];

    if (isset($categoriesWithProjects[$firstCategory]))
        $categoriesWithProjects[$firstCategory][] = $project;
}
?>

<h1 class="text-3xl font-bold mb-4"><?= $page->title() ?></h1>

<?php foreach ($categoriesWithProjects as $category => $projects) : ?>
    <h2 class="text-xl font-semibold pb-2 mb-8 border-b border-b-zinc-200 dark:border-b-slate-800"><?= $category ?></h2>

    <div class="grid grid-cols-2 gap-2 mb-8 lg:grid-cols-1">
        <?php foreach ($projects as $project) :
            $previewImage = $project->showImageCover()->toBool() ? $project->previewImages()?->toStructure()?->first()?->image()->toFile()->resize(700) : null;
        ?>
            <div hx-get="<?= $project->url(['params' => ['preview' => true]]) ?>" hx-target="#project-preview" hx-swap="innerHTML" <?= attr(['class' => ['bg-slate-100 dark:bg-slate-800 border border-zinc-200 dark:border-zinc-700 rounded-lg cursor-pointer overflow-hidden relative hover:-translate-y-2 transition-transform flex flex-col', $previewImage != null ? 'pt-16' : '']]) ?>>

                <?php if ($previewImage != null) : ?>
                    <div class="image h-52 bg-cover bg-center absolute left-0 top-0 w-full" style="background-image: url('<?= $previewImage->url() ?>')"></div>
                <?php endif; ?>
                <div <?= attr(['class' => ['p-4 relative z-10 bg-gradient-to-b from-transparent to-slate-100 dark:to-slate-800 to-50% flex flex-col flex-1', ...($previewImage != null ? ['pt-32'] : [])]]) ?>>
                    <b class="flex text-lg mb-4 flex-1 items-end"><?= $project->title() ?></b>
                    <?php if ($project->shortDescription()->isNotEmpty()) : ?>
                        <div class="mb-4"><?= $project->shortDescription()->kt() ?></div>
                    <?php endif; ?>
                    <div class="flex gap-2 flex-wrap text-sm">
                        <?php if ($project->timespan()->isNotEmpty()) : ?>
                            <span class="font-semibold inline-block mr-2"><?= $project->timespan() ?></span>
                        <?php endif;
                        foreach ($project->tags()->split() as $tag) : ?>
                            <span class="text-secondary dark:text-slate-400"><?= $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<div id="project-preview"></div>

<?php endsnippet(); ?>