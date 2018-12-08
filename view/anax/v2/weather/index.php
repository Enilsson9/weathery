<h1>Get weather from IP</h1>

<div class="jumbotron">
    <?php if (isset($_GET["ip"])) : ?>
        <table class="table table-striped">
            <?php if ($currentIp !== null) : ?>
            <h1><?= $weather['timezone'] ?></h1>

            <div id="map" class="map"></div>

            <h3>Weather from <?= $chosenDate ?> </h3>

            <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                  <th scope="row">Summary</th>
                  <td><?= $weather['currently']['summary'] ?></td>
                </tr>

                <tr>
                  <th scope="row">Temperature (Fahrenheit)</th>
                  <td><?= $weather['currently']['temperature'] ?></td>
                </tr>
            </tbody>
        </table>

            <?php elseif ($currentIp === null) : ?>
                <div class="alert alert-danger" role="alert">
                     Your IP address is not valid
                </div>
            <?php endif; ?>

        <a href="weather"><button class="btn btn-primary btn-lg btn-block">Go back</button></a>

        <script>
            // Initialize and add the map
            function initMap() {
                // The location of Uluru
                var uluru = {lat: <?= $details["latitude"] ?>, lng: <?= $details["longitude"] ?>};
                // The map, centered at Uluru
                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 10, center: uluru});
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({position: uluru, map: map});
            }
        </script>


        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMIN51gXuOHEQeNwXi7EJ8Ukm9Y8l1Rrc&callback=initMap">
        </script>

    <?php endif; ?>
    <?php if (!isset($_GET["ip"])) : ?>
        <form class="form-signin" method="get" action="">
            <div class="alert alert-primary" role="alert">
              Get current weather, future weather (up to 7 days) or previous weather (up to 30 days ago).
            </div>

            <div class="form-group">
                    <input class="form-control"  type="text" name="ip" value="<?= $currentIp ?>" placeholder="Your IP address here" required>

                    <input class ="form-control" type="date" name="date" value="<?= $today?>" min="<?= $oneMonthAgo ?>" max="<?= $oneWeekLater ?>" required>

            </div>
            <button class="btn btn-primary btn-lg btn-block"  type="submit">Check weather</button>
        </form>

    <?php endif; ?>
</div>
