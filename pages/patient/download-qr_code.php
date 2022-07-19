<!DOCTYPE html>
<html lang="en">
<?php include '../header&footer/header.php'; ?>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
    <?php include '../sidebar&navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>QR CODE</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        $patient_id = $_GET['patient_id'];
        $patient_name = $_GET['patient_name'];
        ?>
      <!-- Default box -->
      <div style="width:200px; height:200px">
        <div class="card-body">
            <div id="qrcode" style="width:100px; height:100px; block;margin-left: auto;margin-right: auto;"></div>
            <p>QR CODE OF <b><?php echo $patient_name;?></b></p>
            <button id="download-page-as-image">Download QR as Image</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include '../header&footer/footer.php';  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include '../header&footer/scripts.php'; ?>
</body>
<script type="text/javascript" src="qrcode-js/jquery.min.js"></script>
<script type="text/javascript" src="qrcode-js/qrcode.js"></script>
<script type="text/javascript" src="html2canvas.min.js"></script>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 150,
	height : 150
});

function makeCode () {		
	var elText = "<?php echo $patient_id;?>";
	qrcode.makeCode(elText);
}

makeCode();

    
setUpDownloadPageAsImage();

function setUpDownloadPageAsImage() {
  document.getElementById("download-page-as-image").addEventListener("click", function() {
    html2canvas(document.body).then(function(canvas) {
      console.log(canvas);
      simulateDownloadImageClick(canvas.toDataURL(), 'file-name.png');
    });
  });
}

function simulateDownloadImageClick(uri, filename) {
  var link = document.createElement('a');
  if (typeof link.download !== 'string') {
    window.open(uri);
  } else {
    link.href = uri;
    link.download = filename;
    accountForFirefox(clickLink, link);
  }
}

function clickLink(link) {
  link.click();
}

function accountForFirefox(click) { // wrapper function
  let link = arguments[1];
  document.body.appendChild(link);
  click(link);
  document.body.removeChild(link);
}
</script>
</html>
