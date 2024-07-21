<?php
if (param('preview') == '1') {
    snippet('../templates/project-preview');
} else {
    snippet('layout', slots: true);

    /**
     * @var Kirby\Cms\App $kirby
     * @var Kirby\Cms\Page $page
     * @var Kirby\Cms\Site $site
     */

    snippet('breadcrumbs');
?>
    <h1 class="text-3xl font-bold mb-4"><?= $page->title() ?></h1>
    <?php snippet('project/image-slider'); ?>
    <div class="flex flex-wrap mt-4 gap-8 lg:flex-col">
        <?php snippet('project/content'); ?>
        <?php snippet('project/meta'); ?>
    </div>


<?php endsnippet();
} ?>