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
                use App\Models\PaymentModel;

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
                                            <th class="none">Acre</th>
                                            <th class="none">Fertilizer</th>
                                            <th>Payment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($paymentData as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $row['crop'] ?> </td>
                                                <td><?= $row['acre'] ?> </td>
                                                <td><?= $row['fertilizer'] ?> </td>
                                                <?php
                                                if ($row['payment_type'] == "Credit") {
                                                ?>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-sm rounded text-white payment" value='{"payment_id" :"<?= $row['payment_id'] ?>"}'> <?= $row['amount'] ?> </button>
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td class="text-success">Paid</td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Crop</th>
                                            <th class="none">Acre</th>
                                            <th class="none">Fertilizer</th>
                                            <th>Payment</th>
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
<script>
    $(document).ready(function() {
        $(document).on("click", ".payment", function(e) {
            e.preventDefault();
            if (!confirm('Confirm to Amount Paid?')) {
                return false;
            }
            var data = $(this);
            var values = JSON.parse(data.val());
            var payment_id = values.payment_id;
            $.ajax({
                type: "POST",
                url: "<?= site_url() ?>payment/<?= Hash::path('paid') ?>",
                data: {
                    payment_id: payment_id
                },
                success: function(data) {
                    if ($.trim(data.success)) {
                        alert("Payment Success");
                        window.location.reload();
                    } else {
                        alert("Payment Failure");
                    }
                },
                error: function(data) {
                    alert('network error try again.');
                },
            });

        });
    });
</script>