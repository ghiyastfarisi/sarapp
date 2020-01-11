<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$writeJs='';
	if(isset($include_js)) {
		if(is_array($include_js)) {
			foreach($include_js as $v) {
				$writeJs.='<script src="'.base_url($this->tools->_path_builder($v)).'"></script>';
			}
		} else {
			$writeJs.='<script src="'.base_url($this->tools->_path_builder($include_js)).'"></script>';
		}
	}
	echo $writeJs;
?>
<?php
	echo '<script>';
	echo 'var GLOBAL_VAR = {}; var BASE_URL = "'.base_url().'";';
	if (isset($passNotif)) {
		echo 'GLOBAL_VAR.notif = "'.$passNotif.'";';
	}
	if (isset($passNotifType)) {
		echo 'GLOBAL_VAR.notif_type = "'.$passNotifType.'";';
	}
	echo '</script>';
?>
<script>
$(document).ready(function() {
	if (GLOBAL_VAR['notif'] !== '') {
		if (GLOBAL_VAR['notif_type'].toString() === 'error') {
			toastr.error(GLOBAL_VAR['notif'], 'Notification');
		} else if (GLOBAL_VAR['notif_type'].toString() === 'success') {
			toastr.success(GLOBAL_VAR['notif'], 'Notification');
		} else {
			toastr.info(GLOBAL_VAR['notif'], 'Notification');
		}
	}
});
</script>