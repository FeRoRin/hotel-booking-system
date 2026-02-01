
<body>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
			<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<!-- <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div>/.row -->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-bed color-blue"></em>
							<div class="large"><?php include 'counters/room-count.php'?></div>
							<div class="text-muted">Total Rooms</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-bookmark color-orange"></em>
							<div class="large"><?php include 'counters/reserve-count.php'?></div>
							<div class="text-muted">Today Reservations</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"><?php include 'counters/reservation-rooms-count.php'?></div>
							<div class="text-muted">Rooms Booked Today</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-red"></em>
							<div class="large"><?php include 'counters/available-rooms-count.php'?></div>
							<div class="text-muted">Available Rooms Today</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			<hr>

			<div class="row">

				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check-square-o color-magg"></em>
							<div class="large"><?php include 'counters/checkedin-count.php'?></div>
							<div class="text-muted">Today Checked In</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check-circle color-green"></em>
							<div class="large"><?php include 'counters/checkedout-count.php'?></div>
							<div class="text-muted">Today Checked out</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa fa-building color-orange"></em>
							<div class="large"><?php include 'counters/month_rooms-count.php'?></div>
							<div class="text-muted">Total Rooms Booked of this month</div>
						</div>
					</div>
				</div>
				
				
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-reorder color-blue"></em>
							<div class="large"><?php include 'counters/booking-month-count.php'?></div>
							<div class="text-muted">Total Bookings of this month</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			<hr>

			<div class="row">


				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa fa-users color-magg"></em>
							<div class="large"><?php include 'counters/number_guests_today.php'?></div>
							<div class="text-muted">Today Guests</div>
						</div>
					</div>
				</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-spinner color-red"></em>
							<div class="large"><?php include 'counters/bookedroom-count.php'?></div>
							<div class="text-muted">Cancelled Bookings of this month</div>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-leaf color-purp"></em>
							<div class="large"><?php include 'counters/vuemer_count.php'?></div>
							<div class="text-muted">Sea view / Vue mer</div>
						</div>
					</div>
				</div>

			</div>

			
		</div>
		
	</div>	<!--/.main-->
	

		
</body>
</html>