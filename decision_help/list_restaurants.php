<?php include '../view/header.php'; ?>
<main>


	<div class="sidenav">

		<?php foreach($categories as $category) { ?>
		  <a href="/DnA/decision_help/?category_id=<?php echo $category->getId()?>"><?php echo $category->getName();?></a>
		<?php } ?>
	</div>
	
	<div class="list">
		<figure  style="margin-top:15px;">
		<!--<figcaption style="font-size:35px;">Top 5 DnA</figcaption>-->
		  <ol>
		
		<?php if($restaurants != false) {
				foreach($restaurants as $restaurant) {  
					$image_path = RestaurantDB::get_restaurant_logo($restaurant->getId());
					if(!isset($image_path['path'])) {
						$image_path['path'] = "images/dna.png";
					}
				?>
				
				<li><a href="/DnA/show_restaurant?restaurant_id=<?php echo $restaurant->getId()?>">
				  <img width="60" height="60" src="../<?php echo $image_path['path'];?>" />
				  <h3><?php echo $restaurant->getName();?></h3>
				  <p><?php echo $restaurant->getDescription();?></p>
				</li>
		</a>
		<?php   }  
			}       ?>
		  </ol>
		</figure>
	</div>

</main>
<?php include '../view/footer.php'; ?>