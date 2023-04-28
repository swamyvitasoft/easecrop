<?php

use App\Libraries\Hash;
?>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div class="main-wrapper">
    <?= view('common/header1') ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col d-flex no-block align-items-center">
                    <h4 class="page-title"><?= $pageHeading ?></h4>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>drone/<?= Hash::path('index') ?>" class="float-end">Drone List</a>
                </div>
            </div>
            <div class="row">
                <?= csrf_field(); ?>
                <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= site_url() ?>drone/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="drone_number" class="form-label">Drone Number</label>
                                    <input type="text" name="drone_number" class="form-control form-control-lg" id="drone_number" placeholder="Drone Number" value="<?= set_value('drone_number') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'drone_number') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="pilot_operator" class="form-label">Pilot Operator</label>
                                    <input type="text" name="pilot_operator" class="form-control form-control-lg" id="pilot_operator" placeholder="Pilot Operator" value="<?= set_value('pilot_operator') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'pilot_operator') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="mobile" class="form-label">Phone Number</label>
                                    <input type="text" name="mobile" class="form-control form-control-lg" id="mobile" placeholder="Phone Number" value="<?= set_value('mobile') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'mobile') : '' ?></small>
                                </div>
                                <div class="text-center"><button type="submit" class="btn btn-success btn-lg">Register</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer1') ?>
</div>