<?php include '../view/header.php'; ?>
<main>
	<br>
	<h1>Restaurant List</h1>
	<table>
		<tr>
			<th>Name</th>
			<th>Genre</th>
			<th>Website</th>
			<th>Closes</th>
			<th>City</th>
			<th>State</th>
			<th>Quality Coefficient</th>
			<th>Satisfaction Coefficient</th>
			<th>Go Back Rating</th>
			<th>Sat/Price</th>
			<th>DnA</th>
		</tr>
		
		<tr>
			<?php foreach ($restaurants as $restaurant) : ?>
			<tr>
				<td><?php echo $restaurant->getName(); ?></td>
				<td><?php echo $restaurant->getGenre(); ?></td>
				<td><?php echo $restaurant->getWebsite(); ?></td>
				<td><?php echo $restaurant->getTime_closes(); ?></td>
				<td><?php echo $restaurant->getCity(); ?></td>
				<td><?php echo $restaurant->getState(); ?></td>
				<td><?php echo $restaurant->getQuality(); ?></td>
				<td><?php echo $restaurant->getSatisfaction(); ?></td>
				<td><?php echo $restaurant->getGo_back_rating(); ?></td>
				<td><?php echo $restaurant->getSat_per_price(); ?></td>
				<td><?php echo $restaurant->getDna(); ?></td>
			</tr>
		<?php endforeach; ?>
		</tr>
	</table>
	<br>
	<a href="add_technician.php">Add Restaurant</a>

</main>
<?php include '../view/footer.php'; ?>