<?php include '../view/header.php';?>


<main>
		<form action="." method="post" >
			<input type="hidden" name="action" value="list_restaurants">
			<h1>&nbsp;</h1>
		</form>
	<div class="form-style-9">
		<h1>Edit Restaurant Ratings</h1>
		<label>Enter your ratings for each category</label>
		<form action="." method="post" >
			
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
				<input type="hidden" name="action" value="update_restaurant">
				<input type="hidden" name="type" value="ratings">
				<input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>";>
				<input class="field-style field-split align-left" type="submit" value="Update Ratings">
				<input name="cancel" class="field-style field-split align-right" type="submit" value="Cancel" formnovalidate>
			</li>
			</ul>
		</form>
	</div>

</main>
<?php include '../view/footer.php'; ?>