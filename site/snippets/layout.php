<?php

/** @var Kirby\Cms\Page $page
 *  @var Kirby\Cms\Site $site
 *  @var Kirby\Cms\App $kirby */

use Kirby\Filesystem\F;
use Kirby\Http\Cookie;

if (json_decode(env('REQUIRES_LOGIN')) && !$kirby->user()) {
	go('/panel');
}

$darkmode = null;

if (isset($_COOKIE['darkmode'])) {
	$darkmode = $_COOKIE['darkmode'] == 'true';
}
?>

<!DOCTYPE html>
<html <?= attr(['lang' => $kirby->language()?->code(), 'class' => [is_null($darkmode) ? '' : ($darkmode ? 'dark' : 'light')]]) ?>>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php snippet('seo/head') ?>

	<link rel="icon" href="/favicon.svg" />
	<link rel="mask-icon" href="/favicon.svg" color="#000000" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	<meta name="theme-color" content="#000000">

	<?= vite([
		'src/styles/index.css', 'src/index.ts'
	]) ?>
</head>

<body class="min-h-screen antialiased overflow-x-clip dark:bg-slate-950 dark:text-slate-100">
	<div class="min-h-screen" data-taxi>
		<div class="flex flex-col min-h-screen" data-taxi-view>
			<?php snippet('core/skip-nav') ?>
			<?php snippet('core/nav') ?>
			<main id="main" class="container flex-grow py-8 flex flex-col">
				<?= $slot ?>
			</main>
			<?php snippet('core/footer') ?>
		</div>
	</div>
	<?php snippet('seo/schemas') ?>
</body>

</html>