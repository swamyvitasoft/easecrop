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
                                            <th>History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $customerModel = new CustomerModel();
                                        $paymentModel = new PaymentModel();
                                        $referenceModel = new ReferenceModel();
                                        foreach ($customerInfo as $index => $row) {
                                            $payment = $paymentModel->select('reference_id,sum(amount) as amount,sum(paid_amount) as paid_amount,sum(due_amount) as due_amount')
                                                ->where(['customer_id' => $row['customer_id']])->groupBy('customer_id')->orderBy('payment_id', 'desc')->first();
                                            $reference = $referenceModel->where(['reference_id' => $payment['reference_id']])->first();
                                        ?>
                                            <tr>
                                                <td><?= $row['name'] ?> </td>
                                                <td><?= $row['mobile'] ?> </td>
                                                <td><?= $reference['name'] ?> </td>
                                                <td><?= $reference['mobile'] ?> </td>
                                                <td><?= $payment['amount'] ?> </td>
                                                <td><?= $payment['paid_amount'] ?> </td>
                                                <td><?= $payment['due_amount'] ?> </td>
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