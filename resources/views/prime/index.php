<?php \App\Helpers\ViewHelper::render('master/top', []); ?>

    <div class=" px-8">
        <span class="text-2xl font-light text-gray-900"><?= $title ?? null ?></span>
        <div class="mt-4 break-all">
        <?= $result['numbers'] ?? null ?>
        </div>
    </div>

<?php \App\Helpers\ViewHelper::render('master/bottom', []); ?>