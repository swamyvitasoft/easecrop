<footer>
    <?php

    use App\Libraries\Hash;

    if (!empty($loggedInfo['login_id'])) {
    ?>
        <div class="container-fluid fixed-bottom">
            <div class="row text-center">
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/<?= Hash::path('index') ?>" class="btn btn-lg text-primary" role="button" aria-pressed="true"><i class="fa fa-home me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/<?= Hash::path('changepwd') ?>" class="btn btn-lg text-primary" role="button" aria-pressed="true"><i class="fa fa-eye-slash me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>logout" class="btn btn-lg text-primary" role="button" aria-pressed="true"><i class="fa fa-power-off me-1 ms-1"></i></a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</footer>