<?php
 session_start();
 if (!isset($_SESSION['user_id'])){
     header("location:../login/login.php");
 }
date_default_timezone_set("Asia/Manila");

if ($_SESSION['user_type'] == 1){//administrator
    $user_id = $_SESSION['user_id'];
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT first_name, middle_name, last_name, avatar FROM tbl_user WHERE user_id = '$user_id'";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($first_name, $middle_name, $last_name, $avatar);
    $qry->store_result();
    $qry->fetch();
    
    $user_full_name = "$first_name $middle_name $last_name";
    $user_type_name = "Administrator";
}
if ($_SESSION['user_type'] == 2){//doctor
    $user_id = $_SESSION['user_id'];
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT first_name, middle_name, last_name, upload_identity, specialization FROM tbl_doctor WHERE doctor_id = '$user_id'";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($first_name, $middle_name, $last_name, $avatar, $specialization);
    $qry->store_result();
    $qry->fetch();
    
    $user_full_name = "$first_name $middle_name $last_name";
    $user_type_name = "$specialization";
}

if ($_SESSION['user_type'] == 3){//patient
    $user_id = $_SESSION['user_id'];
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT first_name, middle_name, last_name, upload_identity FROM tbl_patient WHERE patient_id = '$user_id'";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($first_name, $middle_name, $last_name, $avatar);
    $qry->store_result();
    $qry->fetch();
    
    $user_full_name = "$first_name $middle_name $last_name";
    $user_type_name = "Patient";
}
    
require_once '../database&config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
$sql="SELECT about_id, app_name, address, contact, info, logo, background_image FROM tbl_about";
$qry=$cn->prepare($sql);
$qry->execute();
$qry->bind_result($about_id, $app_name, $address, $contact, $info, $logo, $background_image);
$qry->store_result();
$qry->fetch();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name;?></title>
<link rel="icon" href="../uploads/<?php echo $logo;?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
    
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    
    <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    
 
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- fullCalendar -->
  <link rel="stylesheet" href="../../plugins/fullcalendar/main.css">
   <style>

    </style> 
    
</head>