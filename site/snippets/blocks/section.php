<?php if ($block->title()) : ?>
    <h3 class="text-xl font-semibold mb-2"><?= $block->title() ?></h3>
<?php endif; ?>
<div class="text">
    <?= $block->text()->kt() ?>
</div>