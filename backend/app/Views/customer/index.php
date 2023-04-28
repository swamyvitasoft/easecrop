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
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($customerInfo as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $row['name'] ?> </td>
                                                <td><?= $row['mobile'] ?> </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer1') ?>
</div>