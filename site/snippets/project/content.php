<?php

$blocks = $page->blocks()->toBlocks();

if ($blocks->count() > 0) :
?>
    <div class="content flex flex-col gap-6 flex-1 min-w-[35rem] lg:min-w-0">
        <?php foreach ($page->blocks()->toBlocks() as $block) : ?>
            <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
                <?php snippet('blocks/' . $block->type(), [
                    'block' => $block
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;
