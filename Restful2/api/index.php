<?php
require_once 'Routes.php';

$result = new Routes();

if($_POST){
	echo post_to_url("http://www.mirestful.es/users", $_POST);
} else{
?>
ADD RECORD.
<form action="" method="post">
<input type="text" name="name" placeholder="Name" /><br>
<input type="text" name="email" placeholder="Email" /><br>
<input type="hidden" name="_METHOD" value="POST" />
<input type="submit" value="A D D" />
</form>
<?php
}
function post_to_url($_url, $_data) {
   $mfields = '';
   foreach($_data as $key => $val) { 
      $mfields .= $key . '=' . $val . '&'; 
   }
   $mfields = rtrim($mfields, '&');
   $pst = curl_init();

   curl_setopt($pst, CURLOPT_URL, $_url);
   curl_setopt($pst, CURLOPT_POST, count($_data));
   curl_setopt($pst, CURLOPT_POSTFIELDS, $mfields);
   curl_setopt($pst, CURLOPT_RETURNTRANSFER, 1);

   $res = curl_exec($pst);

   curl_close($pst);
   return $res;
}