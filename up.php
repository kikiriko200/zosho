<?php
include './config.php';
include './zosho.php';


if($_POST['uppass'] == $pass_up){
  $zosho = new zosho();
  $zosho -> connectdb();
  $zosho -> upload();
  echo"<script>location.href = '/'</script>";
}else{
  exit('Error!! Password is wrong!!');
};
