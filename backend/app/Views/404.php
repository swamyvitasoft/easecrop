<?php

use App\Libraries\Hash;
?>
<?= view('common/top') ?>
<h1 class="text-center">File Not Found</h1>
<a href="<?= site_url() ?>dashboard/<?= Hash::path('index') ?>" class="btn btn-success m-5">return Dashboard</a>
<?= view('common/bottom') ?>