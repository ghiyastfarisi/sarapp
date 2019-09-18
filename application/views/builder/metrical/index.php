<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta content="Democi" name="description" />
	<meta content="Moeghifar" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="icon" href="/asset/static/gf-favicon.png">

	<title>Democi - moeghifar</title>
	<?php
		$base_css = array(
			"template/metrical/assets/plugins/bootstrap/css/bootstrap.min.css",
			"template/metrical/assets/plugins/font-awesome/css/font-awesome.min.css",
			"template/metrical/assets/plugins/flag-icon/flag-icon.min.css",
			"template/metrical/assets/plugins/simple-line-icons/css/simple-line-icons.css",
			"template/metrical/assets/plugins/ionicons/css/ionicons.css",
			"template/metrical/assets/plugins/toastr/toastr.min.css",
			"template/metrical/assets/css/app.min.css",
			"template/metrical/assets/css/style.min.css",
		);
		$data['include_css'] = (isset($include_css)) ? array_merge($include_css, $base_css) : $base_css;
		$this->load->view('builder/css', $data);
	?>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="page-sidebar-collapsed">
<?php
	if(!isset($page)) {
		show_404();
	}
	$pageTemplate = 'pages/'.$builder.'/'.$page;
	$this->load->view($pageTemplate);
?>
<?php
	$base_js = array(
		"template/metrical/assets/plugins/jquery/jquery.min.js",
		"template/metrical/assets/plugins/jquery-ui/jquery-ui.js",
		"template/metrical/assets/plugins/popper/popper.js",
		"template/metrical/assets/plugins/feather-icon/feather.min.js",
		"template/metrical/assets/plugins/bootstrap/js/bootstrap.min.js",
		"template/metrical/assets/plugins/pace/pace.min.js",
		"template/metrical/assets/plugins/toastr/toastr.min.js",
		"template/metrical/assets/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js",
		"template/metrical/assets/js/jquery.slimscroll.min.js",
		"template/metrical/assets/js/highlight.min.js",
		"template/metrical/assets/js/app.js",
		"template/metrical/assets/js/custom.js"
	);
	$data['include_js'] = (isset($include_js)) ? array_merge($base_js, $include_js) : $base_js;
	$this->load->view('builder/js',  $data);
?>
</body>
</html>
