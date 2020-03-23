<!DOCTYPE html>
<html>

<!-- the head section -->
<head >
    <title>DnA - New Jersey</title>
    <link rel="stylesheet" type="text/css"
          href="/DnA/main.css">
		  
	<style>
	</style>
</head>

<!-- the body section -->
<body >
<header>

<div class="topNavAndProfile">
    <nav class="topnav">
		<ul>
			<a class="active" href="/DnA/">Home</a>
			<?php if(isset($_SESSION['user'])) { 
			
					#$path = $_SESSION['profile_path'];
					$path = FALSE;?>
					<a href="/DnA/restaurant_add">Add Restaurant</a>
					<a href="/DnA/decision_help">Decision Helper</a>
					<div class="dropdown">
						<?php if(!$path) { ?>
							<img width="60" height="58" src="/DnA/images/default-profile.png" />
							<?php } else { ?>
							<img width="60" height="58" src="/DnA/<?php echo $path; ?>" />
						<?php } ?>
						<div class="dropdown-content">
							<a href="/DnA/profile_view">View Profile</a>
							<a href="/DnA?logout=true">Logout</a>
				</ul>		
			<?php } else { ?>
			<a href="/DnA/account_create">Create Account</a>
			
			<?php } ?>
    </nav>
	
</div>
	
</header>
<div id="page-container">
   <div id="content-wrap">
		
			 
			  