    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= site_url() ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= site_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= site_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?= site_url() ?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= site_url() ?>assets/dist/js/sidebarmenu.js"></script>
    <!-- Charts js Files -->
    <script src="<?= site_url() ?>assets/libs/flot/excanvas.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot/jquery.flot.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot/jquery.flot.time.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?= site_url() ?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?= site_url() ?>assets/dist/js/pages/chart/chart-page-init.js"></script>
    <script src="<?= site_url() ?>assets/libs/chart/excanvas.js"></script>
    <script src="<?= site_url() ?>assets/libs/chart/jquery.peity.min.js"></script>
    <script src="<?= site_url() ?>assets/libs/chart/matrix.charts.js"></script>
    <script src="<?= site_url() ?>assets/libs/chart/jquery.flot.pie.min.js"></script>
    <script src="<?= site_url() ?>assets/libs/chart/turning-series.js"></script>
    <!--Table Related Script-->
    <!-- <script src="<?= site_url() ?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?= site_url() ?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?= site_url() ?>assets/extra-libs/DataTables/datatables.min.js"></script> -->
    <!--Table Related Script-->
    <script type="text/javascript" language="javascript" src="<?= site_url() ?>assets/custom-libs/advanced-datatable/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?= site_url() ?>assets/custom-libs/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?= site_url() ?>assets/custom-libs/advanced-datatable/js/DT_bootstrap.js"></script>
    <!--Advanced View Hide DataTables Script-->
    <script src="<?= site_url() ?>assets/custom-libs/datatables.min.js"></script>
    <script src="<?= site_url() ?>assets/custom-libs/dropzone/dropzone.js"></script>
    <!-- Export excel -->
    <script type="text/javascript" language="javascript" src="<?= site_url() ?>assets/custom-libs/datatables/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?= site_url() ?>assets/custom-libs/datatables/js/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?= site_url() ?>assets/custom-libs/datatables/js/buttons.html5.min.js"></script>
    <!-- File Upload -->
    <script src="<?= site_url() ?>assets/custom-libs/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#zero_config').DataTable({
                'responsive': true,
                dom: 'Bfltip',
                lengthChange: true, // Show entries
                searching: true, //Search Hide
                paging: true, //pagination hide
                buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible',
                    },
                    className: 'btn btn-info btn-sm mb-3', //button design
                    title: '<?= $pageHeading ?>', //download filename
                    header: true // export Excel file heading visible
                }]
            });
        });
    </script>
    <!--Custom JavaScript -->
    <script src="<?= site_url() ?>assets/dist/js/custom.min.js"></script>
    </body>

    </html>