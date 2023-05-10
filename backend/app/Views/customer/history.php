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
                <?php

                use App\Libraries\Hash;
                use App\Models\HistoryModel;
                use App\Models\PaymentModel;
                use App\Models\ReferenceModel;

                if (!empty(session()->getFlashdata('fail'))) : ?>
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
                                            <th>Crop</th>
                                            <th>Acre</th>
                                            <th>Fertilizer</th>
                                            <th>Amount</th>
                                            <th>Pending</th>
                                            <th>Paid</th>
                                            <th></th>
                                            <th class="none">Reference</th>
                                            <th class="none">Payment Hostory</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $referenceModel = new ReferenceModel();
                                        $historyModel = new HistoryModel();
                                        foreach ($paymentData as $index => $row) {
                                            $reference = $referenceModel->where(['reference_id' => $row['reference_id']])->findAll();
                                            $history = $historyModel->where(['payment_id' => $row['payment_id']])->findAll();
                                        ?>
                                            <tr>
                                                <td><?= $row['crop'] ?> </td>
                                                <td><?= $row['acre'] ?> </td>
                                                <td><?= $row['fertilizer'] ?> </td>
                                                <td><?= $row['amount'] ?> </td>
                                                <td><?= $row['due_amount'] ?> </td>
                                                <td><?= $row['paid_amount'] ?> </td>
                                                <?php
                                                if ($row['due_amount'] == 0) {
                                                ?>
                                                    <td class="text-success">Payment Successfully</td>
                                                    <?php
                                                } else {
                                                    if ($loggedInfo['role'] == "Admin") {
                                                    ?><td>
                                                            <button type="button" class="btn btn-warning btn-sm rounded text-white" value='{"payment_id" :"<?= $row['payment_id'] ?>"}'> PayNow </button>
                                                        </td>
                                                    <?php
                                                    } else if ($loggedInfo['role'] == "Drone") {
                                                    ?><td>
                                                            <button type="button" class="btn btn-warning btn-sm rounded text-white pending" value='{"payment_id" :"<?= $row['payment_id'] ?>"}'> PayNow </button>
                                                        </td>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>Mobile</td>
                                                        </tr>
                                                        <?php
                                                        foreach ($reference as $index1 => $row1) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $row1['name'] ?> </td>
                                                                <td><?= $row1['mobile'] ?> </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>Type</td>
                                                            <td>Amount</td>
                                                            <td>Details</td>
                                                            <td>Date</td>
                                                        </tr>
                                                        <?php
                                                        foreach ($history as $index2 => $row2) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $row2['amount_type'] ?> </td>
                                                                <td><?= $row2['amount_paid'] ?> </td>
                                                                <td><a href="<?= site_url() ?>uploads/<?= $row2['details'] ?>" target="_new"><img src="<?= site_url() ?>uploads/<?= $row2['details'] ?>" alt="<?= $row2['details'] ?>" style="width:50px;"></a> </td>
                                                                <td><?= $row2['create_date'] ?> </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Crop</th>
                                            <th>Acre</th>
                                            <th>Fertilizer</th>
                                            <th>Amount</th>
                                            <th>Pending</th>
                                            <th>Paid</th>
                                            <th></th>
                                            <th class="none">Reference</th>
                                            <th class="none">Payment Hostory</th>
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
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= site_url() ?>assets/custom-libs/jquery.redirect.js"></script>

<script>
    jQuery(function($) {

        $(document).on("click", ".pending", function(e) {
            var data = $(this);
            var values = JSON.parse(data.val());
            var payment_id = values.payment_id;
            $.redirect("<?= site_url() ?>payment/<?= Hash::path('pending') ?>", {
                "payment_id": payment_id
            }, "POST");
        });

    });
</script>