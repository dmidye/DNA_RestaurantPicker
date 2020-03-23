<?php include '../view/header.php';?>


<main>

		<form action="." method="post" >
			
			<h1>&nbsp;</h1>
		</form>
	<div class="form-style-9">
		<h1>Edit Restaurant Details</h1>
		<label>Edit the general information about the restaurant</label>
		
		<form action="." method="post" >
			<ul>
			<li>
				<input type="name" name="name"  class="field-style field-split align-left" 
					value="<?php echo htmlspecialchars($restaurant->getName()); ?>" placeholder="Name" required>
				<input type="name" name="genre"  class="field-style field-split align-right" 
					value="<?php echo htmlspecialchars($restaurant->getGenre()); ?>" placeholder="Genre" required>
			</li>	
			
			<li>
				<input type="name" name="city"  class="field-style field-split align-left" 
					value="<?php echo htmlspecialchars($restaurant->getCity()); ?>" placeholder="City" required>
				<input type="name" name="state"  class="field-style field-split align-right"
					value="<?php echo htmlspecialchars($restaurant->getState()); ?>"	placeholder="State" required>
			</li>	
			
			<li>
				<input type="name" name="address"  class="field-style field-full" 
					value="<?php echo htmlspecialchars($restaurant->getAddress()); ?>" placeholder="Address" required>
				
			</li>	
			
			<li>
				<input type="time" name="time_closes" class="field-style field-split align-left" 
					value="<?php echo htmlspecialchars($restaurant->getTime_closes()); ?>" placeholder="Time it closes"/>
				<select name="category_id" class="field-style field-split align-right">
			<?php
				echo "cat id: " . $restaurant->getCategoryId();
				foreach($categories as $category) {
					if($category->getId() == $restaurant->getCategoryId()) {?>
						<option selected="selected" value="<?php echo $category->getId(); ?>" 
								title="<?php echo $category->getName(); ?>"><?php echo $category->getName(); ?></option>
					<?php } else {?>
			
						<option value="<?php echo $category->getId(); ?>" 
								title="<?php echo $category->getName(); ?>"><?php echo $category->getName(); ?></option>
			<?php
					}
				}

			?>
			</select>
			</li>	
			
			<li>			
				<input type="url" name="website"  class="field-style field-full" 
					value="<?php echo htmlspecialchars($restaurant->getWebsite()); ?>" placeholder="Website"/>
			</li>
			
			<li>			
				<textarea name="description" class="field-style field-full" 
					 placeholder="Description/Notes"><?php echo htmlspecialchars($restaurant->getDescription());?></textarea>
			</li>
				
			<li>
				
					<input type="hidden" name="action" value="update_restaurant">
					<input type="hidden" name="type" value="details">
					<input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>">
					<input class="field-style field-split align-left" type="submit" value="Update Details">
					<input name="cancel" class="field-style field-split align-right" type="submit" value="Cancel" formnovalidate>
				
			</li>
			</ul>
		</form>
	</div><br><br>

</main>
<?php include '../view/footer.php'; ?>