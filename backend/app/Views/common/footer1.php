<footer>
    <?php

    use App\Libraries\Hash;

    if (!empty($loggedInfo['login_id'])) {
        $role = session()->get('role');
    ?>
        <div class="container-fluid fixed-bottom">
            <div class="row text-center shadow p-1 bg-white rounded">
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/<?= Hash::path('index') ?>" class="btn btn-lg text-primary shadow-lg" role="button" aria-pressed="true"><i class="fa fa-home me-1 ms-1"></i></a>
                </div>
                <?php
                if ($role == "Admin") {
                ?>
                    <div class="col">
                        <a href="<?= site_url() ?>dashboard/<?= Hash::path('recheck') ?>" class="btn btn-lg text-primary shadow-lg" role="button" aria-pressed="true"><i class="mdi mdi-view-dashboard"></i></a>
                    </div>
                <?php
                }
                ?>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/<?= Hash::path('calendar') ?>" class="btn btn-lg text-primary shadow-lg" role="button" aria-pressed="true"><i class="fa fa-calendar me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/<?= Hash::path('changepwd') ?>" class="btn btn-lg text-primary shadow-lg" role="button" aria-pressed="true"><i class="fa fa-eye-slash me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>logout" class="btn btn-lg text-primary shadow-lg" role="button" aria-pressed="true"><i class="fa fa-power-off me-1 ms-1"></i></a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</footer>