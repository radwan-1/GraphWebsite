<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'db';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$oldYearData = '';
	$newYearData = '';

	//query to get data from the table
	$sql = "SELECT * FROM `datasets` ";
    $result = mysqli_query($mysqli, $sql);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result)) {

		$oldYearData = $oldYearData . '"'. $row['oldYearData'].'",';
		$newYearData = $newYearData . '"'. $row['newYearData'] .'",';
	}

	$oldYearData = trim($oldYearData,",");
	$newYearData = trim($newYearData,",");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Grido</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

		<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">


		<!-- Google Font -->
		<link rel="stylesheet"
				href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		
		<title>Grido</title>
	</head>

	<body class="hold-transition skin-green sidebar-mini">	   
		<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

		<!-- Logo -->
		<a href="index2.html" class="logo">
			<img src="./dist/img/logo.png"/>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			
				<!-- User Account Menu -->
				<li class="dropdown user user-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<!-- The user image in the navbar-->
					<img src="dist/img/Radwan.jpg" class="user-image" alt="User Image">
					<!-- hidden-xs hides the username on small devices so only the image appears. -->
					<span class="hidden-xs">Radwan Abdoh</span>
				</a>
				<ul class="dropdown-menu">
					<!-- The user image in the menu -->
					<li class="user-header">
					<img src="dist/img/Radwan.jpg" class="img-circle" alt="User Image">

					<p>
						Radwan Abdoh - Web Developer
						<small>Member since 2019</small>
					</p>
					</li>
					<!-- Menu Body -->
					<li class="user-body">
					<div class="row">
						<div class="col-xs-4 text-center">
						<a href="#">Report</a>
						</div>
						<div class="col-xs-4 text-center">
						<a href="#">Progress</a>
						</div>
					</div>
					<!-- /.row -->
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Profile</a>
					</div>
					<div class="pull-right">
						<a href="#" class="btn btn-default btn-flat">Sign out</a>
					</div>
					</li>
				</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
				<li>
				<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
			</div>
		</nav>
		</header>

		<div class="mainPanel">
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/Radwan.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>Radwan Abdoh</p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
			</div>

			<!-- search form (Optional) -->
			<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
			</form>
			<!-- /.search form -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Report</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Excel</span></a></li>
			<li><a href="#"><i class="fa fa-link"></i> <span>Graph Status</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Report Status</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
				<li><a href="#">Record History</a></li>
				<li><a href="#">Record Edited</a></li>
				</ul>
			</li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			Total Station
			</h1>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">

			<div class="containerChart">	
			<canvas id="chart" style="color: black; background: #ecf0f5; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
						datasets: 
						[{
							label: '2018',
							data: [<?php echo $oldYearData; ?>],
							backgroundColor: '#DD4B39',
							borderColor:'#DD4B39',
							borderWidth: 3
						},

						{
						label: '2019',
							data: [<?php echo $newYearData; ?>],
							backgroundColor: '#F39C12',
							borderColor:'#F39C12',
							borderWidth: 3	
						}]
					},
				
					options: {
						scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
						tooltips:{mode: 'index'},
						legend:{display: true, position: 'bottom', labels: {fontColor: 'black', fontSize: 16}}
					}
				});
			</script>
			</div>
			

		</section>
		<!-- /.content -->
		</div>
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->


		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">Recent Activity</h3>
			<ul class="control-sidebar-menu">
				<li>
				<a href="javascript:;">
					<i class="menu-icon fa fa-bolt bg-red"></i>

					<div class="menu-info">
					<h4 class="control-sidebar-subheading">Scooter Charged</h4>

					<p>29th Since 07/21/2019</p>
					</div>
				</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->

			<h3 class="control-sidebar-heading">Tasks Progress</h3>
			<ul class="control-sidebar-menu">
				<li>
				<a href="javascript:;">
					<h4 class="control-sidebar-subheading">
					Stational Report of Charged Vehicle
					<span class="pull-right-container">
						<span class="label label-danger pull-right">70%</span>
						</span>
					</h4>

					<div class="progress progress-xxs">
					<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
					</div>
				</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
				<h3 class="control-sidebar-heading">General Settings</h3>

				<div class="form-group">
				<label class="control-sidebar-subheading">
					Report panel usage
					<input type="checkbox" class="pull-right" checked>
				</label>

				<p>
					Some information about this general settings option
				</p>
				</div>
				<!-- /.form-group -->
			</form>
			</div>
			<!-- /.tab-pane -->
		</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<!-- REQUIRED JS SCRIPTS -->

		<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

				
	</body>
</html>