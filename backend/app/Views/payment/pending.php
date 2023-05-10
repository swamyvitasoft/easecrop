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
                            <form action="<?= site_url() ?>payment/<?= Hash::path('paid') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control form-control-lg" id="amount" placeholder="Amount" value="<?= $paymentInfo[0]['amount'] ?>" readonly>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'amount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="due_amount" class="form-label">Due Amount</label>
                                    <input type="text" name="due_amount" class="form-control form-control-lg" id="due_amount" placeholder="due_amount" value="<?= $paymentInfo[0]['due_amount'] ?>" readonly>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'due_amount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="amount_paid" class="form-label">Amount</label>
                                    <input type="number" name="amount_paid" class="form-control form-control-lg" id="amount_paid" placeholder="amount paid" value="<?= set_value('amount_paid') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'amount_paid') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="amount_type" class="form-label">Payment Type</label><br>
                                    <input type="radio" class="form-check-input amount_type" name="amount_type" id="amount_type_cash" value="Cash">Cash
                                    <input type="radio" class="form-check-input amount_type" name="amount_type" id="amount_type_online" value="Online" checked>Online
                                </div>
                                <div class="form-group mt-3 details1">
                                    <label for="details" class="form-label">Details</label>
                                    <input type="file" name="details" class="form-control" id="details" placeholder="File Upload" value="<?= set_value('details') ?>">
                                </div>
                                <input type="hidden" name="paid_amount" id="paid_amount" value="<?= $paymentInfo[0]['paid_amount'] ?>">
                                <input type="hidden" name="payment_id" id="payment_id" value="<?= $paymentInfo[0]['payment_id'] ?>">
                                <div class="text-center"><button type="submit" class="btn btn-success btn-lg">Payment</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer1') ?>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".amount_type").click(function() {
            var val = $("input[type='radio']:checked").val();
            if (val == "Credit" || val == "Cash") {
                $('.details1').hide();
            } else {
                $('.details1').show();
            }
        });
    });
</script>