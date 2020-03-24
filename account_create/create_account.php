<?php include '../view/header.php';?>

<main>
		
	<div class="form-style-9">
		<h1>Create Account</h1>
		<form action="." method="post">
			<input type="hidden" name="action" value="create_account">
			
			<ul>
			<li>
				<input type="name" name="first_name"  class="field-style field-split align-left" placeholder="First Name" 
						value='<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>'  required>
				<input type="name" name="last_name"  class="field-style field-split align-right" placeholder="Last Name"
						value='<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>'	required>
			</li>	
			
			<li>
				<input type="name" name="email"  class="field-style field-split align-left" placeholder="Email" 
						value='<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>'required>
				<input type="password" name="password"  class="field-style field-split align-right" placeholder="Password"
						value='<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>' required>
				
				<!--Password pattern
				pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
					   
			</li>	
			
			<li>
				<input type="password" name="passwordConf" class="field-style field-split align-right" placeholder="Confirm Password"required>
					   
				

			</li>	
	<label>Password must have: at least one number, at least one capital letter, and 8 or more characters.</label>
			<li>
				
				<input type="submit" value="Create Account">
			</li>
			</ul>
		</form>
		<?php if(isset($flag) && !$flag) { ?>
				<label>A user with that email already exists.</label>
		<?php   $flag = true;
			  }
		
			  if(isset($passwordFlag) && !$passwordFlag) {?>
				<label>Passwords must match.</label>
		<?php   $passwordFlag = true; 
			  } ?>
	
	</div><br><br>
</main>
<?php include '../view/footer.php'; ?>