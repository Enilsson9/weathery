<h1>Get weather from IP</h1>

<div class="jumbotron">
    <?php if (isset($_GET["ip"])) : ?>
        <h2><?= $weather[0]["timezone"]?></h2>
        <div id="map" class="map"></div>
        <table class="table table-striped">
            <?php if ($currentIp !== null) : ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Temperature (F)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($weather as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $key ?></th>
                    <td><?= gmdate("Y-m-d", $value["currently"]["time"]) ?></td>
                    <td><?= $value["currently"]["summary"] ?></td>
                    <td><?= $value["currently"]["temperature"] ?></td>
                </tr>
                <?php endforeach; ?>
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
              Get current weather with future weather (up to 7 days) or with previous weather (up to 30 days ago).
            </div>

            <input class="form-control"  type="text" name="ip" value="<?= $currentIp ?>" placeholder="Your IP address here" required>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="time" id="exampleRadios1" value="past" checked>
              <label class="form-check-label" for="exampleRadios1">
                Past (30 days ago)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="time" id="exampleRadios2" value="future">
              <label class="form-check-label" for="exampleRadios2">
                Future (7 days ahead)
              </label>
            </div>

            <button class="btn btn-primary btn-lg btn-block"  type="submit">Check weather</button>
        </form>

    <?php endif; ?>
</div>
