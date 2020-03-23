<?php include '../view/header.php';?>


<div class="gmap">
<div id="map"></div>
</div>
<main><br>

	<div class="details">
		<h1><?php echo $restaurant->getName() . " - " . $restaurant->getCity() . ", " . $restaurant->getState();?></h1>

		<label><?php echo $restaurant->getDescription(); ?> </label>
		<br>
		<h2>&nbsp;&nbsp;&nbsp;DnA Score - <?php echo $restaurant->getDna(); ?> </h2><br><br>

	</div>

	<div class="update">
	<?php $website = $restaurant->getWebsite(); 
	if($website != "") {?>
		<p class="website_link"><a href="<?php echo $restaurant->getWebsite();?>" target="_blank">Visit <?php echo $restaurant->getName();?>'s website</a></p>
	<?php } ?>
		<br><br>
		<form action="." method="post" >
			<input type="hidden" name="action" value="edit_restaurant">
			<input type="hidden" name="type" value="details">
			<input type="hidden" name="restaurant_id" value="<?php echo $restaurant->getId();?>"/>
			<input type="submit" value="Edit Details"/>
		</form>
		<form action="." method="post" >
			<input type="hidden" name="type" value="ratings">
			<input type="hidden" name="action" value="edit_restaurant">
			<input type="hidden" name="restaurant_id" value="<?php echo $restaurant->getId();?>"/>
			<input type="submit" value="Edit Ratings"/>
		</form>
	</div>
	
	<div>
		<?php 
		$images = RestaurantDB::get_restaurant_menu($restaurant->getId());
		foreach($images as $image) { ?>
			<img width="70%" height="800" align="middle" src="../<?php echo $image['path'];?>" />
		<?php } 
		?>
	</div>
<div>
      <input id="address" type="hidden" value="<?php echo $restaurant->getAddress();?>">
</div>
	
<script>
	function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        //document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        //});
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX9o2qXhZIuAoteO4HmJkWUYajEo96lDo&callback=initMap">
</script>
</main>

<?php include '../view/footer.php'; ?>