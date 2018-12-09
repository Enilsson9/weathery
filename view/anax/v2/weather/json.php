

<h1>Get weather from IP (JSON)</h1>

<div class="jumbotron">
    <?php if (isset($_GET["ip"])) : ?>
        <?php if ($currentIp !== null) : ?>
        <pre>
            <?php
            $data = [];

            foreach ($weather as $key => $value) {
                $day = [
                    "date" => gmdate("Y-m-d", $value["currently"]["time"]),
                    "summary" =>  $value["currently"]["summary"],
                    "temperature" =>  $value["currently"]["temperature"]
                ];
                $data[] = $day;
            }

            $json = [
                "ip" => $currentIp,
                "timezone" => $weather[0]["timezone"],
                "data" => $data,
            ];

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

            <p>GET request. Provide valid IP address and time (future or past). Both provide current weather</p>

            <samp>?ip=8.8.8.8&time=future</samp><br>
            <samp>?ip=8.8.8.8&time=past</samp>
        </div>

        <form class="form-signin" method="get">
            <div class="alert alert-primary" role="alert">
              Get current weather, future weather (up to 7 days) or previous weather (up to 30 days ago).
            </div>

            <div class="form-group">
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
            </div>
            <button class="btn btn-primary btn-lg btn-block"  type="submit">Get JSON</button>
        </form>




    <?php endif; ?>
</div>
