<!DOCTYPE html>
<html>
<head>
    <title>Geocoding Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVjLkZQ2CVtED6U8SsbaVXenBX9yWv2z0&callback=initMap&libraries=&v=weekly"
            defer
    ></script>
    <!-- jsFiddle will insert css and js -->
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: "Roboto", "sans-serif";
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
</head>

<body>
<script>
    (function(exports) {
        "use strict";

        function initMap() {
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: {
                    lat: -34.397,
                    lng: 150.644
                }
            });
            var geocoder = new google.maps.Geocoder();
            document.getElementById("submit").addEventListener("click", function() {
                geocodeAddress(geocoder, map);
            });
        }

        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById("address").value;
            geocoder.geocode(
                {
                    address: address
                },
                function(results, status) {
                    alert(results[0].geometry.location);
                    if (status === "OK") {
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location
                        });
                    } else {
                        alert(
                            "Geocode was not successful for the following reason: " + status
                        );
                    }
                }
            );
        }

        exports.geocodeAddress = geocodeAddress;
        exports.initMap = initMap;
    })((this.window = this.window || {}));
</script>
<div id="floating-panel">
    <input id="address" type="textbox" value="Sydney, NSW" />
    <input id="submit" type="button" value="Geocode" />
</div>
<div id="map"></div>
</body>
</html>