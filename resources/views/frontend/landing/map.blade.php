<!-- map_area_start  -->
<div class="map_area">
        <div id="map" style="height: 600px; position: relative; overflow: hidden;">
        
        </div>
        <script>
            function initMap() {
                var uluru = {
                    lat: -25.363,
                    lng: 131.044
                };
                var grayStyles = [{
                        featureType: "all",
                        stylers: [{
                                saturation: -90
                            },
                            {
                                lightness: 50
                            }
                        ]
                    },
                    {
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#ccdee9'
                        }]
                    }
                ];
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -31.197,
                        lng: 150.744
                    },
                    zoom: 9,
                    styles: grayStyles,
                    scrollwheel: false
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">
        </script>
        <div class="location_information black_bg wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
            <h3>Dandiya 2022</h3>
            <div class="info_wrap">
                <div class="single_info">
                    <span>Venue:</span>
                    <p>Catch Up
                        Bangalore-560102</p>
                </div>
                <div class="single_info">
                    <span>Phone:</span>
                    <p>+91 6364 594 648</p>
                </div>
                <div class="single_info">
                    <span>Email:</span>
                    <p>info@eksafar.club</p>
                </div>
            </div>
        </div>
    </div>
    <!-- map_area_end  -->