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
                    locationContainer.style.display = "none";
                    autofillLocation(); // this is a temporary workaround

                    
                    // const latitude = position.coords.latitude;
                    // const longitude = position.coords.longitude;
                    // could use OpenCage Geocoder or Nominatim to convert the coordinates to a location name
                    
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

    window.onload = getLocation;
</script>
</body>
</html>