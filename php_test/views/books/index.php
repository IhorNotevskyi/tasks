<h1 class="text-center"><?= Lang::getLang('lng.books') ?></h1><br>
<?php $i = 1;
    foreach ($data['books'] as $books) : ?>
        <p><?= $i++ ?>.&ensp;"<?= $books['book'] ?>"&ensp;&mdash;&ensp;<?= str_replace(',', ', ', $books['authors']); ?></p>
<?php endforeach; ?>