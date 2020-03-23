<?php include '../view/header.php';?>

<main>
		
	<div class="form-style-9">
		<h1>Add Restaurant</h1>
		<label>Up first is the general information about the restaurant</label>
		<form action="." method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="continue_add">
			
			<ul>
			<li>
				<input type="name" name="name"  class="field-style field-split align-left" placeholder="Name" required>
				<input type="name" name="genre"  class="field-style field-split align-right" placeholder="Genre" required>
			</li>	
			
			<li>
				<input type="name" name="city"  class="field-style field-split align-left" placeholder="City" required>
				<input type="name" name="state"  class="field-style field-split align-right" placeholder="State"required>
			</li>	
			
			<li>
				<input type="name" name="address"  class="field-style field-full" placeholder="Address" required>
			</li>	
			
			<li>
				<input type="time" name="time_closes" class="field-style field-split align-left" placeholder="Time it closes"/>
				<select name="category_id" class="field-style field-split align-right">
			<?php

				foreach($categories as $category) {

			?>
					<option value="<?php echo $category->getId(); ?>" title="<?php echo $category->getName(); ?>"><?php echo $category->getName(); ?></option>
			<?php

				}

			?>
			</select>
			</li>	
			
			<li>			
				<input type="url" name="website"  class="field-style field-full" placeholder="Website"/>
			</li>
			
			<li>			
				<textarea name="description" class="field-style field-full" placeholder="Description/Notes"></textarea>
			</li>
			<label>Upload Restaurant Logo: </label>
			<input type="file" name="logo"><br><br>
			<li>
				
				<input type="submit" value="On to the fun stuff">
			</li>
			</ul>
		</form>
		
	
	</div><br><br>
</main>
<?php include '../view/footer.php'; ?>