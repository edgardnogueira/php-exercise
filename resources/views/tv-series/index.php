<?php \App\Helpers\ViewHelper::render('master/top', []); ?>
<div class=" px-8">
        <span class="text-2xl font-light text-gray-900"><?= $title ?? null ?></span>
        <div class="mt-4">


        <?php if (isset($_GET['filter_datetime'])) { ?>
        <?php echo "Results filtered by (Start date): {$_GET['filter_datetime']}"; ?><br><br>
        <?php } ?>

        <?php if (isset($_GET['serie'])) { ?>
        <?php echo "Results filtered by (Serie title): {$_GET['serie']}"; ?><br><br>
        <?php } ?>

        <hr class=" my-5 ">
        
        <form action="/tv-series.php" method="get" class="w-full max-w-sm">
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        TV Series available
      </label>
    </div>
    <div class="md:w-2/3">
      
      <select name="serie" id="serie" class=" border border-gray-400 rounded p-2 w-full">
            <option value="">All</option>
            <?php foreach ($allSeries as $serie) { ?>
              <option value="<?php echo $serie->title; ?>" <?php echo (isset($_GET['serie']) && $_GET['serie'] == $serie->title) ? 'selected' : ''; ?> ><?php echo $serie->title; ?></option>
            <?php } ?>
        </select>
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
         Start date
      </label>
    </div>
    <div class="md:w-2/3">
    <input type="datetime-local" id="filter-datetime" class="w-full border border-gray-400 rounded p-2"
            name="filter_datetime" value="<?php echo (!empty($_GET['filter_datetime'])) ? $_GET['filter_datetime'] : date('Y-m-d H:i'); ?>">
            
    </div>
  </div>
  <div class=" text-center  mb-6">
  <input type="submit" value="Filter" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </div>
                    
  
</form>
        

        <hr class=" my-5 ">
        <br><br>

        <?php if (! empty($closestShow->title)) { ?>
        <strong>
          Next show: <?php echo "{$closestShow->title} ({$closestShow->gender}) next show time {$closestShow->nextSerieShowTime($beginDate)->format('Y-m-d H:i:s')} on $closestShow->channel" ?>
        </strong>
        <br><br>
        <?php } ?>

        
        <?php if (empty($_GET['serie'])) : ?>
          <?php if (! empty($nextShowsOrderByShowTime)): ?>
          Next show for each serie (order by show time): <br><br>
        
          <?php foreach ($nextShowsOrderByShowTime as $serie): ?>
            <?php echo "{$serie->title} ({$serie->gender}) next show time {$serie->nextSerieShowTime($beginDate)->format('Y-m-d H:i:s')} on {$serie->channel}<br>"; ?>
          <?php endforeach ?>
          <?php endif ?>
        <?php endif; ?>
        

        </div>
    </div>

<?php \App\Helpers\ViewHelper::render('master/bottom', []); ?>