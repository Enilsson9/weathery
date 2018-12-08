

<h1>Get weather from IP (JSON)</h1>

<div class="jumbotron">
    <?php if (isset($_GET["ip"])) : ?>
        <?php if ($currentIp !== null) : ?>
        <pre>
            <?php
                $json = array(
                    "ip" => $currentIp,
                    "timezone" => $weather['timezone'],
                    "date" => $chosenDate,
                    "latitude" => $weather['latitude'],
                    "longitude" => $weather['longitude'],
                    "summary" => $weather['currently']['summary'],
                    "temperature" => $weather['currently']['temperature']
                );


                echo json_encode($json, JSON_PRETTY_PRINT);

            ?>
        </pre>

        <?php elseif ($currentIp === null) : ?>
            <div class="alert alert-danger" role="alert">
              Your IP address is not valid
            </div>
        <?php endif; ?>

        <a href="api"><button class="btn btn-primary btn-lg">Go back</button></a>
    <?php endif; ?>
    <?php if (!isset($_GET["ip"])) : ?>
        <div class="alert alert-warning" role="alert">
            <h4> API instructions </h4>

            <p>GET request. Provide valid IP address and valid date format YYYY-mm-dd</p>

            <samp>?ip=8.8.8.8&date=2018-12-07</samp>
        </div>
        
        <form class="form-signin" method="get">
            <div class="alert alert-primary" role="alert">
              Get current weather, future weather (up to 7 days) or previous weather (up to 30 days ago).
            </div>

            <div class="form-group">
                <input class="form-control"  type="text" name="ip" value="<?= $currentIp ?>" placeholder="Your IP address here" required>
                <input class ="form-control" type="date" name="date" value="<?= $today?>" min="<?= $oneMonthAgo ?>" max="<?= $oneWeekLater ?>" required>
            </div>
            <button class="btn btn-primary btn-lg btn-block"  type="submit">Get JSON</button>
        </form>




    <?php endif; ?>
</div>
