<?php

use App\Models\CustomerModel;

$customerModel = new CustomerModel();

use App\Libraries\Hash;
?>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <?= view('common/header1') ?>
    <div class="page-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="container-fluid">
            <div class="row text-center">
                <?php
                if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
            <div class="row justify-content-md-center">
                <?php
                if ($loggedInfo['role'] == "Admin") {
                ?>
                    <div class="col">
                        <a href="<?= site_url() ?>drone/<?= Hash::path('index') ?>">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white">
                                        <?= $drone ?>
                                    </h1>
                                    <h6 class="text-white">Drone</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
                <div class="col">
                    <a href="<?= site_url() ?>customer/<?= Hash::path('index') ?>">
                        <div class="card card-hover">
                            <div class="box bg-primary text-center">
                                <h1 class="font-light text-white">
                                    <?= $customer ?>
                                </h1>
                                <h6 class="text-white">Customer</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <a href="<?= site_url() ?>customer/<?= Hash::path('cash') ?>">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <?= $cash ?>
                                </h1>
                                <h6 class="text-white">Paid Amount</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>customer/<?= Hash::path('credit') ?>">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <?= $credit ?>
                                </h1>
                                <h6 class="text-white">Due Amount</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            if ($loggedInfo['role'] == "Drone") {
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <a href="<?= site_url() ?>payment/<?= Hash::path('index') ?>">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <?= $payment ?>
                                    </h1>
                                    <h6 class="text-white">Payment</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <?= $payment ?>
                                </h1>
                                <h6 class="text-white">Payment</h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="12" class="bg-success text-white">Today Service</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($todayInfo as $key1 => $row1) {
                        $customer1 = $customerModel->where(['customer_id' => $row1['customer_id']])->find();
                    ?>
                        <tr>
                            <td><?= $customer1[0]['name'] ?></td>
                            <td><?= $customer1[0]['mobile'] ?></td>
                            <td><?= $row1['crop_place'] ?></td>
                            <td><?= $row1['acre'] ?> Acre</td>
                            <td><?= $row1['service'] ?></td>
                            <td><?= $row1['crop'] ?></td>
                            <td><?= $row1['crop_age'] ?> Months</td>
                            <td><?= $row1['fertilizer'] ?></td>
                            <td><?= $row1['estimated_fps'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row1['estimated_date'])) ?></td>
                            <td><?= date("d-m-Y", strtotime($row1['create_date'])) ?></td>
                            <td><?= $row1['amount'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="12" class="bg-warning text-white">Tomorrow Service</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($tomorrowInfo as $key2 => $row2) {
                        $customer2 = $customerModel->where(['customer_id' => $row2['customer_id']])->find();
                    ?>
                        <tr>
                            <td><?= $customer2[0]['name'] ?></td>
                            <td><?= $customer2[0]['mobile'] ?></td>
                            <td><?= $row2['crop_place'] ?></td>
                            <td><?= $row2['acre'] ?> Acre</td>
                            <td><?= $row2['service'] ?></td>
                            <td><?= $row2['crop'] ?></td>
                            <td><?= $row2['crop_age'] ?> months</td>
                            <td><?= $row2['fertilizer'] ?></td>
                            <td><?= $row2['estimated_fps'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row2['estimated_date'])) ?></td>
                            <td><?= date("d-m-Y", strtotime($row2['create_date'])) ?></td>
                            <td><?= $row2['amount'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?= view('common/footer1') ?>
</div>