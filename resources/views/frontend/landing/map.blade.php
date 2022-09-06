<!-- map_area_start  -->
<div class="map_area">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.924370889854!2d77.63082841541278!3d12.912582290894655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae152ecf404d0f%3A0x57cc9839f5589dee!2sCatch%20Up%20Bangalore!5e0!3m2!1sen!2sin!4v1662444218938!5m2!1sen!2sin" style="height:600px; width: 100%; position: relative; overflow: hidden; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- <div id="map" style="height: 600px; position: relative; overflow: hidden;">
        
        </div> -->
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
                        lat: 12.912843728922887, 
                        lng: 77.633017097875
                    },
                    zoom: 9,
                    styles: grayStyles,
                    scrollwheel: false
                });
            }
        </script>
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQE999WG25s8_k_e7yEk5XperNPMOsYLk&amp;callback=initMap" defer>
        </script> -->
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