<?php

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
            <div class="row justify-content-md-center">
                <?php
                if ($loggedInfo['role'] == "Admin") {
                ?>
                    <div class="col">
                        <a href="<?= site_url() ?>agents/<?= Hash::path('index') ?>">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="mdi mdi-view-dashboard"></i>
                                    </h1>
                                    <h6 class="text-white">Agents</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="<?= site_url() ?>members/<?= Hash::path('index') ?>">
                            <div class="card card-hover">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white">
                                        <i class="mdi mdi-border-outside"></i>
                                    </h1>
                                    <h6 class="text-white">Participated</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <a href="<?= site_url() ?>topics/<?= Hash::path('index') ?>">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-chart-areaspline"></i>
                                </h1>
                                <h6 class="text-white">Topics</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>survey/<?= Hash::path('index') ?>">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-collage"></i>
                                </h1>
                                <h6 class="text-white">Survey</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            if (!empty(session()->getFlashdata('fail'))) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
            <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif ?>
            <!-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->
        </div>
    </div>
    <?= view('common/footer') ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    var xValues = [<?php 
    foreach ($topic as $row){
        echo $row[0].",";
    }
     ?>];
    var yValues = [5, 9, 2, 4];
    var zValues = [5, 4, 4, 4];
    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                    data: yValues
                },
                {
                    data: zValues
                }
            ]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Compare two Persons {<?= $loggedInfo['role'] ?>}"
            }
        }
    });
</script>