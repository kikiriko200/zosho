<?php
include './config.php';
include './zosho.php';


if($_POST['delpass'] == $pass_del){
  $zosho = new zosho();
  $zosho -> connectdb();
  $zosho -> deleted();
  echo"<script>location.href = '/'</script>";
}else{
  exit('Error!! Password is wrong!!');
};
