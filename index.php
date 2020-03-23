<?php 
require('model/database_oo.php');
require('model/restaurant_db_oo.php');
require('model/restaurant.php');
require('model/user_db_oo.php');
require('model/user.php');
require('model/image_db_oo.php');


session_start();
//echo session_id();
$logout = filter_input(INPUT_POST, 'logout');

if(isset($logout) || isset($_GET['logout'])) {
	$_SESSION = array();
	session_destroy();
	$name = session_name();
	$expire = strtotime('-1 year');
	$params = session_get_cookie_params();
	$path = $params['path'];
	$domain = $params['domain'];
	$secure = $params['secure'];
	$httponly = $params['httponly'];
	setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
}
if(!isset($email) && !isset($password)) {
	$email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
}


if(isset($_SESSION['email']) && isset($_SESSION['password'])) {
	$user = UserDB::log_user_in($_SESSION['email'], $_SESSION['password']);
	if($user != FALSE) {
		$_SESSION['user'] = $user;
		$path = ImageDB::get_profile_image($user->getId());
		$top_five_dna = RestaurantDB::get_top_five_dna_restaurants($user->getId());
		$top_five_go_back = RestaurantDB::get_top_five_go_back_restaurants($user->getId());
		$_SESSION['top_5_dna'] = $top_five_dna;
		$_SESSION['top_5_go_back'] = $top_five_go_back;
		$_SESSION['profile_path'] = $path;
	}
}

include 'view/header.php';

?>
<main>

<div>
	<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { 
		$genres = RestaurantDB::get_genre_occurences($_SESSION['user']->getId()); 
		//I left the top 5 stuff here because it's cool and I might want to use it again
		$top_five_dna = RestaurantDB::get_top_five_dna_restaurants($_SESSION['user'] ->getId());
		$top_five_go_back = RestaurantDB::get_top_five_go_back_restaurants($_SESSION['user'] ->getId());
		$_SESSION['top_5_dna'] = $top_five_dna;
		$_SESSION['top_5_go_back'] = $top_five_go_back;
		if(empty($top_five_go_back)) { ?>
			<br><br><h2>Click Add Restaurant to start keeping track of where you've eaten!</h2>
		<?php }
		if(isset($_SESSION['top_5_dna']) && $_SESSION['top_5_dna'] != false) { ?>
		<br>
			<!--Load the AJAX API-->
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">

			  // Load the Visualization API and the corechart package.
			  google.charts.load('current', {'packages':['corechart']});

			  // Set a callback to run when the Google Visualization API is loaded.
			  google.charts.setOnLoadCallback(drawChart);

			  // Callback that creates and populates a data table,
			  // instantiates the pie chart, passes in the data and
			  // draws it.
			  function drawChart() {

				// Create the data table.
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Genre');
				data.addColumn('number', 'Visits');
				data.addRows([
					<?php 
						$count = 1;
						foreach($genres as $genre) {
							if($count == count($genres)) {
								echo "['".$genre[0]."',".$genre['c']."]";
							} else {
								echo "['".$genre[0]."',".$genre['c']."],";
							}
							$count = $count + 1;
						}
					?>
				]);
				// Set chart options
				var options = {'title':'Genres Visited',
							   'width':400,
							   'height':300};

				// Instantiate and draw our chart, passing in some options.
				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>
			<!--Div that will hold the pie chart-->
			<div id="chart_div"></div>
			<?php  
			}
		} else { ?>
			<br><br><h2>Login to see your personalized restaurant picker</h2>
			<div class="form-style-9">
				<form action="." method="post">
					
					<ul>
						 <li>
							<input class="field-style field-split align-left" type="email" name="email" placeholder="Enter email" required>
							<input class="field-style field-split align-right" type="password" name="password" placeholder="Enter password" required>
						</li>
						<li>
							<input type="submit" value="Login">
						</li>
					<ul>
				</form>
			</div>
		<?php } 
		if(isset($user) && !$user) { ?>
			<label>Could not login. Check entries and try again.</label>
		<?php } ?>
	  </ol>
	</figure>
  
</div>
</main>

<?php include 'view/footer.php'; ?>