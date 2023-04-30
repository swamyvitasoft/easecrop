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
                            <form action="<?= site_url() ?>payment/<?= Hash::path('paymentAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="cmobile" class="form-label">Customer Mobile</label>
                                    <input type="text" name="cmobile" class="form-control form-control-lg cmobile" id="cmobile" placeholder="Customer Mobile" value="<?= set_value('cmobile') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'cmobile') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="cname" class="form-label">Customer Name</label>
                                    <input type="text" name="cname" class="form-control form-control-lg" id="cname" placeholder="Customer Name" value="<?= set_value('cname') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'cname') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="rmobile" class="form-label">Reference Mobile</label>
                                    <input type="text" name="rmobile" class="form-control form-control-lg rmobile" id="rmobile" placeholder="Reference Mobile" value="<?= set_value('rmobile') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'rmobile') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="rname" class="form-label">Reference Name</label>
                                    <input type="text" name="rname" class="form-control form-control-lg" id="rname" placeholder="Reference Name" value="<?= set_value('rname') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'rname') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="crop_place" class="form-label">Crop Place</label>
                                    <input type="text" name="crop_place" class="form-control form-control-lg" id="crop_place" placeholder="Crop Place" value="<?= set_value('crop_place') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'crop_place') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="acre" class="form-label">Acre</label>
                                    <input type="number" name="acre" class="form-control form-control-lg" id="acre" placeholder="Acre" value="<?= set_value('acre') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'acre') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="service" class="form-label">Service</label>
                                    <select name="service" class="form-control form-control-lg" id="service">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Spray">Spray</option>
                                        <option value="Spread">Spread</option>
                                        <option value="Seeding">Seeding</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'service') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="crop" class="form-label">Crop</label>
                                    <input type="text" name="crop" class="form-control form-control-lg" id="crop" placeholder="Crop" value="<?= set_value('crop') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'crop') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="crop_age" class="form-label">Crop Age</label>
                                    <input type="number" name="crop_age" class="form-control form-control-lg" id="crop_age" placeholder="Crop Age" value="<?= set_value('crop_age') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'crop_age') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="fertilizer" class="form-label">Fertilizer / Pesticides / Seeds</label>
                                    <select name="fertilizer" class="form-control form-control-lg" id="fertilizer">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Fertilizer">Fertilizer</option>
                                        <option value="Pesticides">Pesticides</option>
                                        <option value="Seeds">Seeds</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'fertilizer') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="estimated_date" class="form-label">Next Estimated Date</label>
                                    <input type="date" name="estimated_date" class="form-control form-control-lg" id="estimated_date" placeholder="Estimated Date" value="<?= set_value('estimated_date') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'estimated_date') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="estimated_fps" class="form-label">Next Estimated F/P/S</label>
                                    <input type="text" name="estimated_fps" class="form-control form-control-lg" id="estimated_fps" placeholder="Estimated F/P/S" value="<?= set_value('estimated_fps') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'estimated_fps') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" name="amount" class="form-control form-control-lg" id="amount" placeholder="Amount" value="<?= set_value('amount') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'amount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="payment_type" class="form-label">Payment Type</label><br>
                                    <input type="radio" class="form-check-input" name="payment_type" id="payment_type_cash" value="Cash" checked>Cash
                                    <input type="radio" class="form-check-input" name="payment_type" id="payment_type_credit" value="Credit">Credit
                                </div>
                                <input type="hidden" name="customer_id" id="customer_id" value="">
                                <input type="hidden" name="reference_id" id="reference_id" value="">
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
        $(document).on("blur", ".cmobile", function(e) {
            e.preventDefault();
            var cmobile = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= site_url() ?>customer/<?= Hash::path('view') ?>",
                data: {
                    mobile: cmobile
                },
                success: function(data) {
                    if ($.trim(data.customer_id) == '') {} else {
                        $("#customer_id").val(data.customer_id);
                        $("#cname").val(data.name);
                        $("#cmobile").val(data.mobile);
                        $("#cname").attr('readonly', 'true');
                        $("#cmobile").attr('readonly', 'true');
                    }
                },
                error: function(data) {
                    alert('network error try again.');
                },
            });
        });
        $(document).on("blur", ".rmobile", function(e) {
            e.preventDefault();
            var rmobile = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= site_url() ?>customer/<?= Hash::path('view') ?>",
                data: {
                    mobile: rmobile
                },
                success: function(data) {
                    if ($.trim(data.customer_id) == '') {} else {
                        $("#reference_id").val(data.customer_id);
                        $("#rname").val(data.name);
                        $("#rmobile").val(data.mobile);
                        $("#rname").attr('readonly', 'true');
                        $("#rmobile").attr('readonly', 'true');
                    }
                },
                error: function(data) {
                    alert('network error try again.');
                },
            });
        });
    });
</script>