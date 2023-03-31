<?php \App\Helpers\ViewHelper::render('master/top', []); ?>

<div class="px-8">
    <div class="text-2xl font-light text-gray-900"><?= $title ?? null ?></div>

    <div class="mt-4">
        <strong><?= $result['content'] ?? null ?> (promoId = <?= $promoId ?? null ?>)</strong>

        <div class="font-light text-gray-900 mt-4">
            Available promotId: <a href="/ab-testing.php?promoId=1">promoId=1</a> | <a href="/ab-testing.php?promoId=2">promoId=2</a> | <a href="/ab-testing.php?promoId=3">promoId=3</a>
        </div>

        <div class="mt-4">
            Disable the cache to test the selected design without registering it for the user session.
        </div>

        <div class="mt-4">
            <?php if ($result['cache'] ?? null): ?>
                <div class="text-green-500">Flag cache is enabled.</div>
                <div class="mt-4">
                    <a href="/ab-testing.php?disable=1<?= ! empty($_GET['promoId']) ? '&promoId='.$_GET['promoId'] : '' ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Disable Cache</a>
                </div>
                
            <?php else: ?>
                <div class="text-red-500">Flag cache is disabled</div>
                <div class="mt-4">
                    <a href="/ab-testing.php<?= ! empty($_GET['promoId']) ? '?promoId='.$_GET['promoId'] : '' ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enable Cache</a>
                </div>
            <?php endif ?>

            
        </div>
    </div>
</div>

<?php \App\Helpers\ViewHelper::render('master/bottom', []); ?>
