<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    
    <div class="converter">
    <form method="post">
    <h1>Currency Converter</h1><br>
        Amount: <input type="number" name="amount" step="0.01" required><br>
        From (currency code): <input type="text" name="from" required><br>
        To (currency code): <input type="text" name="to" required><br>
        <button type="submit">Convert</button>
        </form>
        <br>
       
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST['amount'];
        $from = strtoupper($_POST['from']);
        $to = strtoupper($_POST['to']);

        $url = "https://api.frankfurter.app/latest?amount=$amount&from=$from&to=$to";
        $response = file_get_contents($url);
        echo "<h1>Result: </h1><br>";
        if ($response === FALSE) {
            echo "<p>Error: Could not retrieve data.</p>";
        } else {
            $data = json_decode($response, true);
            if (isset($data['rates'][$to])) {
                $converted = $data['rates'][$to];
                echo "<p>$amount $from = $converted $to</p>";
            } else {
                echo "<p>Error: Invalid currency code or API issue.</p>";
            }
        }
    }
    ?>
     </div>
</body>
</html>
