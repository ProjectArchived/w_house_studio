</main><!-- End #main -->

<!-- ======= Footer ======= -->
<!-- <footer id="footer" class="footer">
  <div class="copyright"> -->
    <!-- &copy; Copyright <strong><span>W Project</span></strong>. All Rights Reserved -->
  <!-- </div>
  <div class="credits"> -->
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
  <!-- </div> -->
<!-- </footer>End Footer -->


<!-- table filter -->
<script type="text/javascript" src="filter-table/js/mdb.min.js"></script> <!--  Your custom scripts (optional) -->
<script type="text/javascript" src="filter-table/js/addons/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#filter').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>

<script type="text/javascript">
function confirm_action() {
  return confirm('Would you like to continue?');
}
</script>

<!-- table filter -->
<script type="text/javascript" src="filter-table/js/mdb.min.js"></script> <!--  Your custom scripts (optional) -->
    <script type="text/javascript" src="filter-table/js/addons/datatables.min.js"></script>
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#filter').DataTable();
        //     $('.dataTables_length').addClass('bs-select');
        // });

        $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
  
</script>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


<!-- Decimal Number -->

<!-- <script type="text/javascript">
	var fnf = document.getElementById("amount");
	fnf.addEventListener('keyup', function(evt){
	    var n = parseInt(this.value.replace(/\D/g,''),10);
	    fnf.value = n.toLocaleString();
	}, false);
</script> -->

<script type="text/javascript">
  $('input.number').keyup(function(event) {

// skip for arrow keys
if(event.which >= 37 && event.which <= 40) return;

// format number
$(this).val(function(index, value) {
  return value
  .replace(/\D/g, "")
  .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  ;
});
});
</script>

<script type="text/javascript">
        /* table row link */
        $('tr[data-href]').on("click", function() {
            document.location = $(this).data('href');
        });
</script>


<script type="text/javascript">
function hideSection() {
  var x = document.getElementById("hideBox");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>


</body>

</html>
