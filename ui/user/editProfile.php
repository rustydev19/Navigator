<?php
	require_once "../../framework/User.php";
	require_once "../../framework/Vehicle.php";
	require_once "../../framework/Job.php";
	require_once "../../framework/Driver.php";
	$mUser = new User();

	
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		<title>FindGaddi</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="../../res/reset.css" type="text/css" media="screen">
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="../../res/style.css" type="text/css" media="screen">
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="../../res/invalid.css" type="text/css" media="screen">	
  
		<!-- jQuery -->
		<script type="text/javascript" src="../../res/jquery-1.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="../../res/simpla.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="../../res/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="../../res/jquery_002.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="../../res/jquery.htm"></script>
		<script type="text/javascript" src="../../res/jquery.js"></script>
</head>
  
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
	<?php include('../sidebar.php');?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box column-left">				
				<div class="content-box-header">					
					<h3 style="cursor: s-resize;"> Update Password</h3>					
				</div> <!-- End .content-box-header -->				
				<div class="content-box-content">					
					<div style="display: block;" class="tab-content default-tab">					
						<form action="action.php?action=change" method="POST">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							
								<p>
									<label>Current Password</label>
									<input class="text-input medium-input" id="old" name="old" type="password">
								</p>
								
								<p>
									<label>New Password</label>
										<input class="text-input medium-input" id="new" name="new" type="password">
								</p>
								
								<p>
									<label>Re-type Password</label>
										<input class="text-input medium-input" id="retype" name="retype" type="password"> <span id="notify" class="input-notification error png_bg">Passwords do not match.</span>
								</p>
								<p>
									<input class="button" value="Update Password" type="submit">
								</p>
							</fieldset>
						</form>
					</div> <!-- End #tab3 -->					
				</div> <!-- End .content-box-content -->				
			</div> <!-- End .content-box -->

			<div class="content-box column-right">
				
				<div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->
					
					<h3 style="cursor: s-resize;">Update Contact Details</h3>
					
				</div> <!-- End .content-box-header -->
				
				<div style="display: block;" class="content-box-content">
					
					<div style="display: block;" class="tab-content default-tab">
					
						<form action="action.php?action=update" method="POST">
							
							<fieldset>
							
								<p>
									<label>Office Phone</label>
									<input class="text-input medium-input" id="phone_o" name="phone_o" type="text">
								</p>
								
								<p>
									<label>Mobile</label>
										<input class="text-input medium-input" id="phone_m" name="phone_m" type="text">
								</p>
								
								<p>
									<label>Email</label>
										<input class="text-input medium-input" id="email" name="email" type="email">
								</p>
								<p>
									<input class="button" value="Update Details" type="submit">
								</p>
							</fieldset>
						</form>
						
					</div> <!-- End #tab3 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			<div class="clear"></div>
			
			
			<!-- Start Notifications - ->
			
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="../../res/cross_grey_small.png" title="Close this notification" alt="close"></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur 
adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="../../res/cross_grey_small.png" title="Close this notification" alt="close"></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur 
adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="../../res/cross_grey_small.png" title="Close this notification" alt="close"></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur 
adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="../../res/cross_grey_small.png" title="Close this notification" alt="close"></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur 
adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div> -->
			
			<!-- End Notifications -->
			
<?php include("../footer.php")?>
			
		</div> <!-- End #main-content -->
		
	</div>
 </body></html>