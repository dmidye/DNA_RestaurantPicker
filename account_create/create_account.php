<?php include '../view/header.php';?>

<main>
		
	<div class="form-style-9">
		<h1>Create Account</h1>
		<form action="." method="post">
			<input type="hidden" name="action" value="create_account">
			
			<ul>
			<li>
				<input type="name" name="first_name"  class="field-style field-split align-left" placeholder="First Name" required>
				<input type="name" name="last_name"  class="field-style field-split align-right" placeholder="Last Name" required>
			</li>	
			
			<li>
				<input type="name" name="email"  class="field-style field-split align-left" placeholder="Email" required>
				<input type="password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
					   class="field-style field-split align-right" placeholder="Password"required>
				<label>Password must have: at least one number, at least one capital letter, and 8 or more characters.</label>
			</li>	
	
			<li>
				
				<input type="submit" value="Create Account">
			</li>
			</ul>
		</form>
		<?php if(!$flag) { ?>
			<label>A user with that email already exists.</label>
		<?php } ?>
	
	</div><br><br>
</main>
<?php include '../view/footer.php'; ?>