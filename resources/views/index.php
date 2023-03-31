<?php \App\Helpers\ViewHelper::render('master/top', []); ?>
          
            <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">

                <?php foreach ($exerciseList as $exercise) { ?>
                <!-- Value card -->
                <a href="/<?= $exercise['url'] ?>" target="_blank">
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                    <span class="text-xl text-center font-semibold"><?= $exercise['title'] ?></span>
                </div>
                </a>
                <?php } ?>


            </div>
      
<?php \App\Helpers\ViewHelper::render('master/bottom', []); ?>


