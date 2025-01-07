
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/main-2.js"></script>
    		<!--<script src="assets/js/core.min.js"></script>
    		<script src="assets/js/vendor_bundle.min.js"></script>
    		<script src="assets/js/theme.docs.js"></script> -->

			<script>
		$(function(e) {
			$('#example').DataTable();

			var table = $('#example1').DataTable();
			$('').click( function() {
				var data = table.$('input, select').serialize();
				alert(
					"The following data would have been submitted to the server: \n\n"+
					data.substr( 0, 120 )+'...'
				);
				return false;
			});
			$('#example2').DataTable( {
				"scrollY":        "200px",
				"scrollCollapse": true,
				"paging":         false
			});
		} );
        </script>
      <div id="page_js_files">
      <script>
        docAnchor(); docNavSelected();
			</script>
		</div>
		
	</body>
</html>