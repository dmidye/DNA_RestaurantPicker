<?php include '../view/header.php';?>

<main>
		<form action="." method="post" >
			<input type="hidden" name="action" value="list_restaurants">
			<h1>&nbsp;</h1>
		</form>
	<div class="form-style-9">
		<h1>Add Restaurant</h1>
		<label>Enter your ratings for each category</label>
		<form action="." method="post" >
			<input type="hidden" name="action" value="add_restaurant">
			<input type="hidden" name="name" value="<?php echo $name ?>">
			<input type="hidden" name="genre" value="<?php echo $genre ?>">
			<input type="hidden" name="city" value="<?php echo $city ?>">
			<input type="hidden" name="state" value="<?php echo $state ?>">
			<input type="hidden" name="time" value="<?php echo $time ?>">
			<input type="hidden" name="website" value="<?php echo $website ?>">
			<input type="hidden" name="description" value="<?php echo $description ?>">
			<input type="hidden" name="address" value="<?php echo $address ?>">
			<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
			<input type="hidden" name="filename" value="<?php echo $filename ?>">
			
			<ul>
			<li>
				<input type='number' step='0.1' max="10.00" name="q_taste"  
				class="field-style field-split align-left" placeholder="Taste Rating" required>
				<input type='number' step='0.1' max="10.00" name="q_fresh"  
				class="field-style field-split align-right" placeholder="Freshness Rating" required>
			</li>	
			
			<li>
				<input type='number' step='0.1' max="10.00" name="quantity"  
				class="field-style field-split align-left" placeholder="Quantity Rating" required>
				<input type='number' step='1.00' max="999999.99" name="amount_spent"  
				class="field-style field-split align-right" placeholder="Amount Spent" required>
			</li>	
			
			<li>
				<input type='number' step='0.01' max="1.00" name="go_back_rating"  
				class="field-style field-split align-left" placeholder="Go Back Rating" required>
			</li>	

			<li>
				<input type="submit" value="Add Restaurant">
			</li>
			</ul>
		</form>
	</div>
</main>
<?php include '../view/footer.php'; ?>