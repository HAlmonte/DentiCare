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
        <p>
            <a onclick="history.back()">
                <button class="btn btn-default">Go Back</button>
            </a>
            <button id="download-page-as-image" class="btn btn-default">Download QR as Image</button>
        </p>
      <!-- Default box -->
      <div class="card col-md-6" id="downloadQR" style="width:300px; height:400px">
          <div class="card-header">
            <p>QR CODE OF <b><?php echo $patient_name;?></b></p>
            <p><b><?php echo $app_name;?></b></p>
          </div>
        <div class="card-body">
            <div id="qrcode" style="width:100%; height:100%; block;margin-left: auto;margin-right: auto;"></div>
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
	width : 200,
	height : 200
});

function makeCode () {		
	var elText = "<?php echo $patient_id;?>";
	qrcode.makeCode(elText);
}

makeCode();

    
    setUpDownloadPageAsImage();

function setUpDownloadPageAsImage() {
  document.getElementById("download-page-as-image").addEventListener("click", function() {
    html2canvas(document.getElementById('downloadQR')).then(function(canvas) {
      console.log(canvas);
      simulateDownloadImageClick(canvas.toDataURL(), 'QR Code of<?php echo $patient_name;?>.png');
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
