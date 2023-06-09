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
                use App\Models\CustomerModel;
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
                            <div class="row mb-3">
                                <div class="col-md-3"><input type="date" class="form-control" name="start" id="start" required></div>
                                <div class="col-md-3"><input type="date" class="form-control" name="end" id="end" required></div>
                                <div class="col-md-1"><input type="button" class="btn btn-warning search" value="Search"></div>
                            </div>
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Ref Name</th>
                                            <th>Ref Mobile</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Pending</th>
                                            <th>Payment Date</th>
                                            <th>History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $customerModel = new CustomerModel();
                                        $paymentModel = new PaymentModel();
                                        $referenceModel = new ReferenceModel();
                                        foreach ($customerInfo as $index => $row) {
                                            $customer = $customerModel->where(['customer_id' => $row['customer_id']])->find();
                                            $payment = $paymentModel->where(['customer_id' => $row['customer_id']])->orderBy('payment_id', 'desc')->find();
                                            $reference = $referenceModel->where(['reference_id' => $payment[0]['reference_id']])->findAll();
                                        ?>
                                            <tr>
                                                <td><?= $customer[0]['name'] ?> </td>
                                                <td><?= $customer[0]['mobile'] ?> </td>
                                                <td><?= $reference[0]['name'] ?> </td>
                                                <td><?= $reference[0]['mobile'] ?> </td>
                                                <td><?= $row['amount'] ?> </td>
                                                <td><?= $row['paid_amount'] ?> </td>
                                                <td><?= $row['due_amount'] ?> </td>
                                                <td><?= date('d-m-Y', strtotime($payment[0]['create_date'])) ?> </td>
                                                <td><a href="<?= site_url() ?>customer/<?= Hash::path('show') ?>/<?= $row['customer_id'] ?>"><i class="fas fa-history"></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Ref Name</th>
                                            <th>Ref Mobile</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Pending</th>
                                            <th>Payment Date</th>
                                            <th>History</th>
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

        $(document).on("click", ".search", function(e) {
            var start = $('#start').val();
            var end = $('#end').val();
            $.redirect("<?= site_url() ?>customer/<?= Hash::path('index') ?>", {
                "start": start,
                "end": end,
            }, "POST");
        });

    });
</script>