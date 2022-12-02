</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> Beta
    </div>
    <strong>Copyright &copy; 2022 <a href="http://adminlte.io">Aplikasi Loket</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= BASEURL ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASEURL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables id=example-->
<link rel="stylesheet" href="https://code.jquery.com/jquery-3.5.1.js">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js">

<!-- DataTables -->
<script src="<?= BASEURL ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASEURL ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASEURL ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASEURL ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASEURL ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="<?= BASEURL ?>assets/dist/js/demo.js"></script> -->
<!-- page script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "autoWidth": true,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": false,
        });
    });
    //id=example
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }
</script>

<!-- <script script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script> -->

</body>

</html>