
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="">
        
        
          <!-- LINE CHART -->
          <div class="box box-success" style="width: 100%;">
            <div class="box-header with-border">
              <h3 class="box-title">WEEKLY GRAPH</h3>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-charts" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        
        

      </div>
      <!-- /.row -->
          <div class="box box-success" style="width: 100%;">
            <div class="box-header with-border">
              <h3 class="box-title">MONTHLY GRAPH</h3>

            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>

           <div class="box box-success" style="width: 100%;">
            <div class="box-header with-border">
              <h3 class="box-title">ANNUALLY GRAPH</h3>

            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart2" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved. -->
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/board/bower_components/morris.js/morris.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/board/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/board/dist/js/demo.js"></script>
<!-- page script -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/morris.js/morris.css">
<script>
  $(function () {
    "use strict";

   
    //BAR CHART
      var bar = new Morris.Bar({
        element: 'bar-chart',
        data: <?php echo $data;?>,
        xkey: 'month',
        ykeys: ['qty', 'gross', 'profit'],
        labels: ['Sold', 'Sale', 'Profit']
        });

      var bar = new Morris.Bar({
        element: 'bar-charts',
        data: <?php echo $datas;?>,
        xkey: 'week',
        ykeys: ['profit'],
        labels: ['Profit']
        });

      var bar = new Morris.Bar({
        element: 'bar-chart2',
        data: <?php echo $data2;?>,
        xkey: 'annual',
        ykeys: ['qty', 'gross', 'profit'],
        labels: ['Sold', 'Sale', 'Profit']
        });

  });
</script>




</body>
</html>

