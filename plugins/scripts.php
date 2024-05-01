<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<!-- DataTables Bootstrap 4 JS -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>

<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>

<!-- DataTables Responsive Bootstrap 4 JS -->
<script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true, // Enable responsive option for mobile compatibility
            "paging": true, // Enable pagination
            "searching": true, // Enable smart searching
            "ordering": false,
        });
    });
</script>

<!-- Your remaining HTML content here -->
