<?php //include "../includes/db.php" 
?>
<?php ///include "function.php" 
?>
<?php ob_start(); ?>
<?php session_start(); ?>

<?php

// if(!isset($_SESSION['user_role'])){

//         header("Location: ../index.php");

// }



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EAQUA -Admin</title>
  <style>
    p {
      color: black;

    }

    body,
    html {
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    pre {
      -webkit-touch-callout: text;
      -webkit-user-select: text;
      -khtml-user-select: text;
      -moz-user-select: text;
      -ms-user-select: text;
      user-select: text;
    }
  </style>
  <script language=JavaScript>
    var message = "Right Click Disabled";

    function rtclickcheck(keyp) {
      if (navigator.appName == "Netscape" && keyp.which == 3) {
        alert(message);
        return false;
      }

      if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) {
        alert(message);
        return false;
      }
    }

    document.onmousedown = rtclickcheck;
  </script>
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!--
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=4yg6e7e69jnnpl4y6turariev0ywxer0geo2u5juj9hmn4jf"></script>
-->
  <script src="js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="js/tinymce/tinymce.min.js"></script>
  <script src="js/scripts.js"></script>


</head>

<body>