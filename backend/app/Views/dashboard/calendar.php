<?php

use App\Libraries\Hash;
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?= site_url() ?>assets/custom-libs/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="<?= site_url() ?>assets/custom-libs/fullcalendar/bootstrap.css" />
    <script src='<?= site_url() ?>assets/custom-libs/fullcalendar/moment.min.js'></script>
    <script src='<?= site_url() ?>assets/custom-libs/fullcalendar/jquery.min.js'></script>
    <script src="<?= site_url() ?>assets/custom-libs/fullcalendar/jquery-ui.custom.min.js"></script>
    <script src='<?= site_url() ?>assets/custom-libs/fullcalendar/fullcalendar.min.js'></script>
    <style>
        body .fc {
            font-size: 2em;
        }
    </style>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: "<?php echo base_url(); ?>dashboard/load",
                selectable: true,
                selectHelper: true,
                eventClick: function(info) {
                    var date = new Date(info.start);
                    var dd = date.getDate();
                    var mm = date.getMonth() + 1;
                    var yyyy = date.getFullYear();
                    var estimated_date = dd + "-" + mm + "-" + yyyy;
                    var call = '<a href="tel:' + info.mobile + '" class="btn btn-success btn-lg mt-3 w-100">Call</a>';
                    $('#name').html(info.title);
                    $('#mobile').html(info.mobile);
                    $('#crop_place').html(info.crop_place);
                    $('#acre').html(info.acre);
                    $('#service').html(info.service);
                    $('#crop').html(info.crop);
                    $('#crop_age').html(info.crop_age);
                    $('#fertilizer').html(info.fertilizer);
                    $('#estimated_date').html(estimated_date);
                    $('#estimated_fps').html(info.estimated_fps);
                    $('#call').html(call);
                },
                editable: true,
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid mt-3">
        <a href="<?= site_url() ?>dashboard/<?= Hash::path('index') ?>" class="btn btn-primary btn-lg mt-3 w-100">Home</a>
        <table class="table table-condensed">
            <tr>
                <th>Customer Name</th>
                <td><span id="name" class="h4"></span></td>
                <th>Customer Mobile</th>
                <td><span id="mobile" class="h4"></span></td>
            </tr>
            <tr>
                <th>Crop Place</th>
                <td><span id="crop_place" class="h4"></span></td>
                <th>Acre</th>
                <td><span id="acre" class="h4"></span></td>
            </tr>
            <tr>
                <th>Crop</th>
                <td><span id="crop" class="h4"></span></td>
                <th>Crop Age</th>
                <td><span id="crop_age" class="h4"></span></td>
            </tr>
            <tr>
                <th>Service</th>
                <td><span id="service" class="h4"></span></td>
                <th>Fertilizer / Pesticides / Seeds</th>
                <td><span id="fertilizer" class="h4"></span></td>
            </tr>
            <tr>
                <th>Next Estimated F/P/S</th>
                <td><span id="estimated_fps" class="h4"></span></td>
                <th>Next Estimated Date</th>
                <td><span id="estimated_date" class="h4"></span></td>
            </tr>
        </table>
        <span id="call" class="mb-5"></span>
        <div id="calendar" class="mt-5"></div>
    </div>
</body>

</html>