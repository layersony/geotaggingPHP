<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    .mainBody{
        padding: 10px;
    }
    .mainForm{
        max-width: 600px;
        padding: 10px;
    }
    .personalInfo{
        margin-bottom: 20px;
    }
    .labelInput{
        width: 50%;
    }
    .labelInput label {
       margin-bottom: 3px;
    }
</style>
<body>

<main class="container mainBody">
    <h1>Farmer Filling Form</h1>

    <form action="" class="mainForm">
        <div class="container">
            <h4>Personal Details</h4>
            <div class="row personalInfo">
                
                <div class="labelInput col-6">
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="labelInput col-6">
                    <label for="mobileNo">Mobile Number:</label>
                    <input type="text" id="mobileNo" name="mobileNo" required>
                </div>
                <div class="labelInput col-6">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="labelInput col-6" id="location-container">
                    <label for="location">Location (Place):</label>
                    <input type="text" id="location" name="location" required>
                </div>
                
            </div>
            <hr>
            <h4>Animal Details</h4>
            <div class="row">
                
                <div class="labelInput col-12">
                    <label for="noOfAnimals">No Of Animals:</label>
                    <input type="text" id="noOfAnimals" name="noOfAnimals" required>
                </div>
                <div class="labelInput col-12">
                    <label for="typeOfLiveStock">Type of LiveStock:</label>
                    <input type="text" id="typeOfLiveStock" name="typeOfLiveStock" required>
                </div>
                <div class="labelInput col-12">
                    <label for="ttlValueAnimals">Total Value of Animals:</label>
                    <input type="number" id="ttlValueAnimals" name="ttlValueAnimals" required>
                </div>
            </div>
        </div>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function getLocation() {
        const locationInput = document.getElementById("location");
        const locationContainer = document.getElementById("location-container");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // locationContainer.style.display = "none";
                    autofillLocation(); // this is a temporary workaround

                    
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    // could use OpenCage Geocoder or Nominatim to convert the coordinates to a location name
                    // Key will be hidden (Just for Testing Purposes Only will be deactivated soon)
                    fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}%2C${longitude}&key=f2243577fa5046f9800423398c7d8a50`)
                    .then(response => response.json())
                    .then(resData => {
                        const city = data['results']['components']['city']
                        document.getElementById("location").value = city;
                    })
                    
                },
                (error) => {
                    locationContainer.style.display = "block"; 
                    autofillLocation(); 
                }
            );
        } else {
            console.error("Geolocation is not supported by this browser.");
            autofillLocation();
        }
    }

    function autofillLocation() {
        fetch('/ip_details', { method: 'GET' })
            .then(response => response.json())
            .then(data => {
                const city = data['city'];
                document.getElementById("location").value = city;
            })
            .catch(error => {
                console.error("Error fetching IP-based location:", error);
            });
    }

    // sample opencagedata
    //{
    //   "documentation": "https://opencagedata.com/api",
    //   "licenses": [
    //     {
    //       "name": "see attribution guide",
    //       "url": "https://opencagedata.com/credits"
    //     }
    //   ],
    //   "rate": {
    //     "limit": 2500,
    //     "remaining": 2497,
    //     "reset": 1731369600
    //   },
    //   "results": [
    //     {
    //       "annotations": {
    //         "DMS": {
    //           "lat": "1° 18' 1.76004'' S",
    //           "lng": "36° 47' 2.24052'' E"
    //         },
    //         "MGRS": "37MBU5341156148",
    //         "Maidenhead": "KI88jq47bv",
    //         "Mercator": {
    //           "x": 4094771.216,
    //           "y": -143813.133
    //         },
    //         "OSM": {
    //           "edit_url": "https://www.openstreetmap.org/edit?way=561265502#map=17/-1.30049/36.78396",
    //           "note_url": "https://www.openstreetmap.org/note/new#map=17/-1.30049/36.78396&layers=N",
    //           "url": "https://www.openstreetmap.org/?mlat=-1.30049&mlon=36.78396#map=17/-1.30049/36.78396"
    //         },
    //         "UN_M49": {
    //           "regions": {
    //             "AFRICA": "002",
    //             "EASTERN_AFRICA": "014",
    //             "KE": "404",
    //             "SUB-SAHARAN_AFRICA": "202",
    //             "WORLD": "001"
    //           },
    //           "statistical_groupings": [
    //             "LEDC"
    //           ]
    //         },
    //         "callingcode": 254,
    //         "currency": {
    //           "alternate_symbols": [
    //             "Sh"
    //           ],
    //           "decimal_mark": ".",
    //           "html_entity": "",
    //           "iso_code": "KES",
    //           "iso_numeric": "404",
    //           "name": "Kenyan Shilling",
    //           "smallest_denomination": 50,
    //           "subunit": "Cent",
    //           "subunit_to_unit": 100,
    //           "symbol": "KSh",
    //           "symbol_first": 1,
    //           "thousands_separator": ","
    //         },
    //         "flag": "🇰🇪",
    //         "geohash": "kzf0t5320733d2w7x5ne",
    //         "qibla": 7.29,
    //         "roadinfo": {
    //           "drive_on": "left",
    //           "road": "unnamed road",
    //           "road_type": "residential",
    //           "speed_in": "km/h"
    //         },
    //         "sun": {
    //           "rise": {
    //             "apparent": 1731294780,
    //             "astronomical": 1731290460,
    //             "civil": 1731293460,
    //             "nautical": 1731291960
    //           },
    //           "set": {
    //             "apparent": 1731338460,
    //             "astronomical": 1731342780,
    //             "civil": 1731339780,
    //             "nautical": 1731341280
    //           }
    //         },
    //         "timezone": {
    //           "name": "Africa/Nairobi",
    //           "now_in_dst": 0,
    //           "offset_sec": 10800,
    //           "offset_string": "+0300",
    //           "short_name": "EAT"
    //         },
    //         "what3words": {
    //           "words": "juggled.zaps.leader"
    //         }
    //       },
    //       "bounds": {
    //         "northeast": {
    //           "lat": -1.299805,
    //           "lng": 36.7839757
    //         },
    //         "southwest": {
    //           "lat": -1.3013212,
    //           "lng": 36.7839378
    //         }
    //       },
    //       "components": {
    //         "ISO_3166-1_alpha-2": "KE",
    //         "ISO_3166-1_alpha-3": "KEN",
    //         "ISO_3166-2": [
    //           "KE-30"
    //         ],
    //         "_category": "road",
    //         "_normalized_city": "Nairobi",
    //         "_type": "road",
    //         "city": "Nairobi",
    //         "city_block": "Kilimani sublocation",
    //         "city_district": "Kibra",
    //         "continent": "Africa",
    //         "country": "Kenya",
    //         "country_code": "ke",
    //         "postcode": "44847",
    //         "quarter": "Adam's Arcade",
    //         "road": "unnamed road",
    //         "road_type": "residential",
    //         "state": "Nairobi County",
    //         "suburb": "Woodley/Kenyatta/Golf Course ward"
    //       },
    //       "confidence": 9,
    //       "distance_from_q": {
    //         "meters": 11
    //       },
    //       "formatted": "unnamed road, Nairobi, 44847, Kenya",
    //       "geometry": {
    //         "lat": -1.3004889,
    //         "lng": 36.7839557
    //       }
    //     }
    //   ],
    //   "status": {
    //     "code": 200,
    //     "message": "OK"
    //   },
    //   "stay_informed": {
    //     "blog": "https://blog.opencagedata.com",
    //     "mastodon": "https://en.osm.town/@opencage"
    //   },
    //   "thanks": "For using an OpenCage API",
    //   "timestamp": {
    //     "created_http": "Mon, 11 Nov 2024 07:48:19 GMT",
    //     "created_unix": 1731311299
    //   },
    //   "total_results": 1
    // }

    window.onload = getLocation;
</script>
</body>
</html>
