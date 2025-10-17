<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');

  /* MAP GRID */
  $grid_class = get_field('grid_class');

  $grid_intro = get_field('grid_intro');
  $grid_intro_wrapper = get_field('grid_intro_wrapper');
  $grid_intro_class = get_field('grid_intro_class');
  $grid_title = get_field('grid_title');
  $grid_title_class = get_field('grid_title_class');
  $grid_title_size = ''; if(get_field('grid_title_size') != 'default') { $grid_title_size = '-'.get_field('grid_title_size'); }
  $grid_title_font = get_field('grid_title_font');
  $grid_title_color = get_field('grid_title_color');
  $grid_text = get_field('grid_text');
  $grid_text_class = get_field('grid_text_class');
  $grid_text_font = get_field('grid_text_font');
  $grid_text_color = get_field('grid_text_color');
  $map_grid_class = get_field('map_grid_class');
  $grid_items = get_field('map_grid_items');
  
?>
<section <?php if($section_id) { echo 'id="'.$section_id.'" '; } ?>class="map-grid-section<?php if($section_class) { echo ' '.$section_class; } ?>">

  <div id="contact-map" class="<?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>"> 
    <div class="map-grid-content<?php if($grid_class) { echo ' '.$grid_class; } ?>">
    <?php $count = 0; 
    if( have_rows('map_grid_items') ):

      // Loop through rows.
      while( have_rows('map_grid_items') ) : the_row();
      $count++;
      $grid_item_class = get_sub_field('grid_item_class');
      $grid_item_title = get_sub_field('grid_item_title');
      $latitude = get_sub_field('latitude');
      $longitude = get_sub_field('longitude');
      $address = get_sub_field('map_grid_address');
      $city = get_sub_field('map_grid_city');
      $state = get_sub_field('map_grid_state');
      $zip = get_sub_field('map_grid_zip');
      $zoom = get_field('map_zoom', 'option');
      $map_icon = get_field('map_icon','option');
    ?>
    <div class="map-grid-item">
      <div class="map-grid-item-content tcenter marb2">
        <?php if($grid_item_title) { ?>
          <h2 class="section-title-small font-headline tprimary marb1"><?php echo $grid_item_title; ?></h2>
        <?php } ?>
        <p><?php echo $address. '<br>'.$city.', '.$state.' '.$zip; ?></p>
      </div>
    <?php if($latitude && $longitude) { ?>
      <div class="gmap-holder fadein">
      <!-- Map Vars -->
        <input type="hidden" id="comlng<?php echo $count; ?>" value="<?php echo $longitude; ?>" />
        <input type="hidden" id="comlat<?php echo $count; ?>" value="<?php echo $latitude; ?>" />
        <input type="hidden" id="comaddress<?php echo $count; ?>" value="<?php echo $address; ?>" />
        <input type="hidden" id="comcity<?php echo $count; ?>" value="<?php echo $city; ?>" />
        <input type="hidden" id="comstate<?php echo $count; ?>" value="<?php echo $state; ?>" />
        <input type="hidden" id="comzip<?php echo $count; ?>" value="<?php echo $zip; ?>" />
        <input type="hidden" id="comzoom" value="<?php echo $zoom; ?>" />
        <input type="hidden" id="comicon" value="<?php echo $map_icon; ?>" />
        <div class="googledirections-map bgsurrogate-superlight">
          <div class="map-views map-views-<?php echo $count; ?>">Satellite View</div>
          <div class="map-views2 map-views2-<?php echo $count; ?>">Map View</div>
          <div id="map_canvas_<?php echo $count; ?>" class="map-canvas" style="height: 100%; width: 100%;"></div>
          <div class="cd-zoom-in cd-zoom-in-<?php echo $count; ?>"></div>
          <div class="cd-zoom-out cd-zoom-out-<?php echo $count; ?>"></div>
        </div>
        <div class="googlemaps-loader"></div>
      </div>
      <?php } ?>
    </div>
      <script>
        ///* Map Vars *///
        var comlat<?php echo $count; ?> = $("#comlat<?php echo $count; ?>").val();
        var comlng<?php echo $count; ?> = $("#comlng<?php echo $count; ?>").val();
        var comaddress<?php echo $count; ?> = $("#comaddress<?php echo $count; ?>").val();
        var comcity<?php echo $count; ?> = $("#comcity<?php echo $count; ?>").val();
        var comstate<?php echo $count; ?> = $("#comstate<?php echo $count; ?>").val();
        var comzip<?php echo $count; ?> = $("#comzip<?php echo $count; ?>").val();
        var comzoom = Number($("#comzoom").val());
        var comicon = $("#comicon").val();
    
        (function() {
          var CONTACT_GMAP = {
              init: function() {
                this.acfOptionsEndPoint = '/wp-json/acf/v2/options/';
                this.baseURL = window.location.origin;
                this.getOptions();
              },

              getOptions: function() {
                var self = this;

                // Get ACF Options
                $.ajax({
                    type: 'GET',
                    contentType: 'application/json; charset=utf-8',
                    datatype: 'json',
                    url: self.acfOptionsEndPoint,
                    success: function(data) {
                      self.acfOptions = data.acf;
                      // Get Settings
                      $.ajax({
                          type: 'GET',
                          contentType: 'application/json; charset=utf-8',
                          datatype: 'json',
                          url: self.baseURL + '/wp-json/',
                          success: function(data) {
                            self.settings = data;
                            self.setConstants();
                            self.initMaps();
                          },
                      });
                    },
                });
              },

              setConstants: function() {
                this.maps = {};
                this.icon_home = comicon;
                this.title = this.settings.name;

                // Map 1 coordinates
                this.map<?php echo $count; ?> = {
                    commLat: comlat<?php echo $count; ?>,
                    commLng: comlng<?php echo $count; ?>,
                    centerLat: comlat<?php echo $count; ?>,
                    centerLng: comlng<?php echo $count; ?>,
                    mapzoom: comzoom,
                    address: comaddress<?php echo $count; ?>,
                    city: comcity<?php echo $count; ?> ,
                    state: comstate<?php echo $count; ?>,
                    zip: comzip<?php echo $count; ?>
                };

                // Map Colors
                this.highwayColor = this.acfOptions.freewayhighway_color;
                this.mainBigRoadColor = this.acfOptions.main_big_road_color;
                this.smallRoadColor = this.acfOptions.small_road_color;
                this.waterColor = this.acfOptions.water_color;
                this.landscapeColor = this.acfOptions.landscape_color;
                this.landAreaColor = this.acfOptions.land_area_color_overlay || '';
                this.parkColor = this.acfOptions.park_color;
              },

              getMapOptions: function(coords) {
                return {
                    center: new google.maps.LatLng(coords.commLat, coords.commLng),
                    mapTypeControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    navigationControl: false,
                    navigationControlOptions: {
                      style: google.maps.NavigationControlStyle.NORMAL,
                    },
                    zoomControl: false,
                    scrollwheel: false,
                    streetViewControl: false,
                    zoom: coords.mapzoom,
                    panControl: false,
                    fullscreenControl: false,
                    disableDefaultUI: true,
                    styles: [
                            {
                                stylers: [
                                    { hue: this.landAreaColor },
                                    { lightness: 0 },
                                    { saturation: -90 },
                                ],
                            },
                            {
                                featureType: 'road.highway',
                                elementType: 'geometry',
                                stylers: [
                                    { color: this.highwayColor },
                                    { lightness: 0 },
                                    { saturation: 0 },
                                    { visibility: 'simplified' },
                                ],
                            },
                            {
                                featureType: 'road.arterial',
                                elementType: 'geometry',
                                stylers: [
                                    { color: this.mainBigRoadColor },
                                    { lightness: 0 },
                                    { saturation: 0 },
                                    { visibility: 'simplified' },
                                ],
                            },
                            {
                                featureType: 'road.local',
                                elementType: 'geometry',
                                stylers: [
                                    { color: this.smallRoadColor },
                                    { lightness: 0 },
                                    { saturation: 0 },
                                    { visibility: 'simplified' },
                                ],
                            },
                            {
                                featureType: 'water',
                                elementType: 'geometry',
                                stylers: [
                                    { color: this.waterColor },
                                    { lightness: 0 },
                                    { saturation: 0 },
                                    { visibility: 'simplified' },
                                ],
                            },
                            {
                                featureType: 'poi.park',
                                elementType: 'geometry',
                                stylers: [{ color: this.parkColor }]
                            },
                            {
                                featureType: 'poi',
                                elementType: 'labels',
                                stylers: [{ visibility: 'off' }]
                            },
                            {
                                featureType: 'transit',
                                elementType: 'labels.icon',
                                stylers: [{ visibility: 'off' }]
                            },
                            {
                                featureType: "transit.station.airport",
                                elementType: "geometry",
                                stylers: [{ color: this.parkColor }]
                            },
                            {
                                featureType: "landscape",
                                elementType: "all",
                                stylers: [
                                    {
                                        visibility: "off"
                                    }
                                ]
                            }
                        ],
                };
              },

              initMaps: function() {
                var self = this;
                
                // Initialize first map
                this.initMap('map_canvas_<?php echo $count; ?>', this.map<?php echo $count; ?>, '');
                
                // Initialize second map if coordinates exist
                /* if (this.map2.commLat && this.map2.commLng) {
                    this.initMap('map_canvas_2', this.map2, '_2');
                } */
              },

              initMap: function(canvasId, coords, suffix) {
                var self = this;
                var options = this.getMapOptions(coords);

                self.maps[canvasId] = new google.maps.Map(
                    document.getElementById(canvasId),
                    options
                );

                // Add marker
                var latLng = new google.maps.LatLng(coords.commLat, coords.commLng);
                var image = new google.maps.MarkerImage(
                    self.icon_home,
                    null,
                    null,
                    new google.maps.Point(38, 91),
                    new google.maps.Size(76, 91)
                );

                var marker = new google.maps.Marker({
                    map: self.maps[canvasId],
                    title: self.title,
                    position: latLng,
                    zIndex: 9999,
                    optimized: false,
                    icon: image
                });

                // Add map type toggle
                $(document).ready(function() {
                    $('.map-views-<?php echo $count; ?>' + suffix).on('click', function() {
                      $('.map-views2-<?php echo $count; ?>' + suffix).show();
                      $(this).hide();
                      self.maps[canvasId].setMapTypeId(google.maps.MapTypeId.HYBRID);
                    });
                    $('.map-views2-<?php echo $count; ?>' + suffix).on('click', function() {
                      $('.map-views-<?php echo $count; ?>' + suffix).show();
                      $(this).hide();
                      self.maps[canvasId].setMapTypeId(google.maps.MapTypeId.ROADMAP);
                    });

                    // Add zoom controls
                    $('.cd-zoom-in-<?php echo $count; ?>' + suffix).on('click', function() {
                      self.maps[canvasId].setZoom(self.maps[canvasId].getZoom() + 1);
                    });
                    $('.cd-zoom-out-<?php echo $count; ?>' + suffix).on('click', function() {
                      self.maps[canvasId].setZoom(self.maps[canvasId].getZoom() - 1);
                    });
                });
              }
          };

          CONTACT_GMAP.init();
        })();
      </script>
      <?php endwhile; endif; ?>
    </div>
  </div>

</section>