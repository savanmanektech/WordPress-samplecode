<?php 
/*Google Map function*/
/*
EXAMPLE of Google Map function
$address1 = '<div style="width: 200px; height: auto;"><img src="http://wallwallhd.com/wp-content/uploads/2014/04/house-dekstop-HD-wallpaper.jpg" style="width: 75px; height: auto; float: left; margin-right:5px;" /><p>hi this is my test address1</p></div>';
$address2 = '<div style="width: 200px; height: auto;"><img src="http://media-cdn.tripadvisor.com/media/photo-s/02/32/d1/4f/island-house-studios.jpg" style="width: 75px; height: auto; float: left; margin-right:5px;" /><p>hi this is my test address2</p></div>';

$args = array(
            "address"   => array($address1, $address2), //this is optional
            "latitude"  => array("-33.890542", "-32.890542"),    //this is mandatory
            "longitude" => array("151.274856", "151.274856"),    //this is mandatory
            "width"     =>"100%",                               //this is optional
            "height"    =>"300px",                              //this is optional
            "zoom"      =>"7",                                  //this is optional
            "center"    =>"2",                                  //this is optional
            "marker_ico"=>"http://project-demo-server.info/manektech/images/mt-map-icon.png" //this is optional
        );
echo my_map($args)
 */
function my_map($args)
{
        
    if(count($args['latitude'])==count($args['longitude']))
    {
        
        if($args['width']!='')
        {
            $width = "width: ".$args['width']."; ";
        }
        
        if($args['height']!='')
        {
            $height = "height: ".$args['height']."; ";
        }
        
        if($args['center']!='')
        {
            $center = $args['latitude'][$args['center']-1].", ".$args['longitude'][$args['center']-1];
        }
        else 
        {
            $center = $args['latitude'][0].", ".$args['longitude'][0];
        }
        
        if($args['zoom']!='')
        {
            $zoom = $args['zoom'];
        }
        else 
        {
            $zoom = "10";
        }
        
        if($args['marker_ico']!='')
        {
            $marker_ico = "icon: '".$args['marker_ico']."', ";
        }
        for($i=0;$i<count($args['latitude']);$i++)
        {
            $locations.="['".$args['address'][$i]."',".$args['latitude'][$i].", ".$args['longitude'][$i].", ".$i."]";
            if($i<count($args['latitude'])-1)
            {
                $locations.=", ";
            }
        }
?>
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <div id="map" style="<?php echo $width; echo $height; ?> min-height: 250px; min-width: 250px;"></div>
	<script type="text/javascript">
            var locations = [<?php echo $locations; ?>];

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: <?php echo $zoom; ?>,
              center: new google.maps.LatLng(<?php echo $center; ?>),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {  

              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                <?php echo $marker_ico; ?>
                map: map
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        </script> 
<?php
    }
    else
    {
        return "latitude and longitude are not same";
    }
 
}
/*end of Google Map function*/
?>