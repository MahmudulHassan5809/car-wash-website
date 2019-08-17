    <!-- Footer -->
    <footer class="page-footer font-small bg-dark">

      <!-- Copyright -->
      <div class="footer-copyright text-center text-white form-control-lg">© <?php echo date("Y"); ?> Copyright:
        <a href="index.php">Car Service & Wash</a>
      </div>
      <!-- Copyright -->

    </footer>
  <!-- Footer -->


    <!-- JQuery -->
  	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

  	<!-- Bootstrap tooltips -->
  	<script type="text/javascript" src="js/popper.min.js"></script>

  	<!-- Bootstrap core JavaScript -->
  	<script type="text/javascript" src="js/bootstrap.min.js"></script>

  	<!-- MDB core JavaScript -->
  	<script type="text/javascript" src="js/mdb.min.js"></script>

    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/datatables.min.js"></script>


    <script type="text/javascript" src="js/summernote.js"></script>

    <script type="text/javascript" src="js/custom.js"></script>


    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Company Total Summary'],
          ['Total Providers', <?php echo $service->totalServiceProvider(); ?>],
          ['Total Services',     <?php echo $service->totalServices();  ?>],
          ['Total Users',  <?php echo $service->totalUsers();  ?>],
          ['Total Requests', <?php echo $request->totalRequests();  ?>],

          ]);

        var options = {
            pieSliceText: 'percentage',
            title: 'Application View',
            backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
        }
    </script>


  </body>

</html>
