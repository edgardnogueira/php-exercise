<?php \App\Helpers\ViewHelper::render('master/top', []); ?>

<div class="px-8">
    <span class="text-2xl font-light text-gray-900"><?= $title ?? null ?></span>
    <div class="mt-4 break-all">
        <div class="my-4">
            <div>Random ASCII array from comma (",") to pipe ("|"):</div>
            <div><?= $result['originalArray'] ?? null ?></div>
        </div>

        <div class="my-4">
            <div>Random ASCII array without one element:</div>
            <div><?= $result['randomArrayAfterRemovedItem'] ?? null ?></div>
        </div>

        <div class="my-4">
            <div>The removed element:</div>
            <div><?= $result['removedItem'] ?? null ?></div>
        </div>
    </div>
</div>

<?php \App\Helpers\ViewHelper::render('master/bottom', []); ?>
