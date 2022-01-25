<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="tab-content">
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		$inc=1;
		while($row=mysqli_fetch_assoc($sql)){
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
			
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Address:</label>
					<div class="col-md-10">
						<textarea name="text_'.decode_text($row["name"]).'" class="form-control" id="-editor'.$inc++.'">'.decode_text($information["text_".$row["name"]]).'</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Footer:</label>
					<div class="col-md-10">
						<textarea name="footer_'.decode_text($row["name"]).'" class="form-control" id="-editor'.$inc++.'">'.decode_text($information["footer_".$row["name"]]).'</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">İş saatları:</label>
					<div class="col-md-10">
						<input type="text" name="opening_hours_'.decode_text($row["name"]).'" class="form-control" id="-editor'.$inc++.'" value="'.decode_text($information["opening_hours_".$row["name"]]).'" />
					</div>
				</div>
				';
			
			echo '</div>';				
		}
		?>
		<div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Email:</label>
				<div class="col-md-10"><input name="email" class="form-control" type="text" value="<?php echo decode_text($information["email"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Facebook:</label>
				<div class="col-md-10"><input name="facebook" class="form-control" type="text" value="<?php echo decode_text($information["facebook"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Twitter:</label>
				<div class="col-md-10"><input name="twitter" class="form-control" type="text" value="<?php echo decode_text($information["twitter"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Google+:</label>
				<div class="col-md-10"><input name="google" class="form-control" type="text" value="<?php echo decode_text($information["google"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">LinkedIn:</label>
				<div class="col-md-10"><input name="linkedin" class="form-control" type="text" value="<?php echo decode_text($information["linkedin"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Youtube:</label>
				<div class="col-md-10"><input name="youtube" class="form-control" type="text" value="<?php echo decode_text($information["youtube"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Instagram:</label>
				<div class="col-md-10"><input name="instagram" class="form-control" type="text" value="<?php echo decode_text($information["instagram"])?>" /></div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Mobil:</label>
				<div class="col-md-10"><input name="mobile" class="form-control" type="text" value="<?php echo decode_text($information["mobile"])?>" /></div>
			</div>
			
				
			<div class="clear">
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Telefon:</label>
					<div class="col-md-10"><input name="phone" class="form-control" type="text" value="<?php echo decode_text($information["phone"])?>" /></div>
				</div>
				
				<div class="form-group row hide">
					<label for="example-text-input" class="col-md-2 col-form-label">Google Map:</label>
					<div class="col-md-10">
						<div id="map-canvas" style="width:100%;height:300px;background:#ccc;"></div>
						<input name="google_map" id="google_map" type="hidden" value="<?=decode_text($information["google_map"])?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Fax:</label>
					<div class="col-md-10"><input name="fax" class="form-control" type="text" value="<?php echo decode_text($information["fax"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Skype:</label>
					<div class="col-md-10"><input name="skype" class="form-control" type="text" value="<?php echo decode_text($information["skype"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Vkontakte:</label>
					<div class="col-md-10"><input name="vkontakte" class="form-control" type="text" value="<?php echo decode_text($information["vkontakte"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Digg:</label>
					<div class="col-md-10"><input name="digg" class="form-control" type="text" value="<?php echo decode_text($information["digg"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Flickr:</label>
					<div class="col-md-10"><input name="flickr" class="form-control" type="text" value="<?php echo decode_text($information["flickr"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Dribbble:</label>
					<div class="col-md-10"><input name="dribbble" class="form-control" type="text" value="<?php echo decode_text($information["dribbble"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Vimeo:</label>
					<div class="col-md-10"><input name="vimeo" class="form-control" type="text" value="<?php echo decode_text($information["vimeo"])?>" /></div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Myspace:</label>
					<div class="col-md-10"><input name="myspace" class="form-control" type="text" value="<?php echo decode_text($information["myspace"])?>" /></div>
				</div>
			</div>
			
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>


<script src="https://maps.googleapis.com/maps/api/js?sensor=false?key=AIzaSyBDmAebQkDuDE0j3IdJIrVHIEFRXnlC-KU"></script>
<script type="text/javascript">
var map;
var markers = [];
function addMarker(location) {
	//Evvelki mark olunmuwlarin hamisini silir
	while (markers.length > 0) {
		markers.pop().setMap(null);
	}
	markers.length = 0;
	//
	// Iwareni xeriteye qoyur
	var marker = new google.maps.Marker({
    position: location,
    title: "A",
    map: map,
	draggable:true
    });
	//
	// Sag duymeni sigarken silmeyi ucundur...
    google.maps.event.addListener(marker, 'rightclick', function(event) {
		marker.setMap(null);
		document.getElementById('google_map').value='';
    });
	// Arraya elave edirki, lazim olsa sile bilek..
    markers.push(marker);
}
function initialize() {
    var startLoc = new google.maps.LatLng(40.447992135544304, 49.85664367675781);
    var mapOptions = {
        zoom: 13,
        center: startLoc,
        mapTypeId: google.maps.MapTypeId.TRAFFIC
    };
    map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	var google_map=$("#google_map").val();
	if(google_map=='') google_map='(40.40983633607086, 49.86763000488281)';
	
	google_map=google_map.replace('(','');	google_map=google_map.replace(')','');		google_map=google_map.split(', ');
	var selected_marker = new google.maps.LatLng(google_map[0], google_map[1]);
	
	map.setCenter(new google.maps.LatLng(google_map[0], google_map[1]));
	google.maps.event.trigger(map, 'resize');
	
	var marker = new google.maps.Marker({
	  position: selected_marker,
	  map: map,
	  title: '',
	  draggable:true
	});
	markers.push(marker);
	
    google.maps.event.addListener(map, 'click', function(event) {
		document.getElementById('google_map').value=event.latLng;
        addMarker(event.latLng);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>