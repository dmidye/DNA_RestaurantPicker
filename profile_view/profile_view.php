<?php include '../view/header.php';

$user = $_SESSION['user']; 
$path = ImageDB::get_profile_image($user->getId()); ?>

<main>
		
	<div><br>
		<h1><?php echo $user->getFirstName() . " " . $user->getLastName();?> </h1>
		<form action="." method="post">
			<input type="hidden" name="action" value="create_account">
			<?php if(!$path) { ?>
					<br><img width="200" height="200" src="/DnA/images/default-profile.png" />
			<?php } else { ?>
					<br><img width="200" height="200" src="/DnA/<?php echo $path; ?>" />
			<?php } ?>
			
		</form>
		<form action="." method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="upload_profile_pic">
			
			<input type="file" name="profile"><br><br>
			<input type="submit" value="Upload"/>
		</form>
	
	</div><br><br>
</main>
<?php include '../view/footer.php'; ?>