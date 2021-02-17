<?php

class Crypto 
{
    public $prevUSD;
    public $prevEUR;

    public function GetCurrency()
    {
        $url= 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR&tryConversion=true&e=CCCAGG&api_key=9e36e2e3f0f4184d5dbd322dcab454cbfcc829073d55b9cd4d4e5f6118fdf729';
        $response  = file_get_contents($url);
        $jsonObj  = json_decode($response);
        // return $jsonObj;
        return [
            $this->prevUSD = $jsonObj->USD,
            $this->prevEUR = $jsonObj->EUR
        ];
    }
    public function UpdateCurrency($usd, $eur)
    {
        $url= 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR&tryConversion=true&e=CCCAGG&api_key=9e36e2e3f0f4184d5dbd322dcab454cbfcc829073d55b9cd4d4e5f6118fdf729';
        $response  = file_get_contents($url);
        $jsonObj  = json_decode($response);
        echo "<pre>";
        if($jsonObj->USD > $usd) echo "<span style='color:green'> USD: ";
        elseif($jsonObj->USD == $usd) echo "<span> USD: ";
        else echo "<span style='color:red'> USD: ";
        echo $jsonObj->USD;
        echo "</span> | ";
        if($jsonObj->EUR > $eur) echo "<span style='color:green'> EUR: ";
        elseif($jsonObj->EUR == $eur) echo "<span> EUR: ";
        else echo "<span style='color:red'> EUR: ";
        echo $jsonObj->EUR;
        echo "</span>";
        // print_r($jsonObj);
        echo "</pre>";
    }
}

$crypto = new Crypto();
if (isset($_POST['get_currency']))
    $crypto->GetCurrency();

if (isset($_POST['update_currency']))
    $crypto->UpdateCurrency($_POST['USD'], $_POST['EUR']);

?>

<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Cryptocompare</title>
</head>
<body>

<form action="" method="post">
    <input type="submit" value="GET CURRENCY!" name="get_currency" id="get_currency" />
</form>
<form action="" method="post">
    <label for="USD">USD</label>
    <input type="number" name="USD" value="<?php echo $crypto->prevUSD ?>">
    <label for="EUR">EUR</label>
    <input type="number" name="EUR" value="<?php echo $crypto->prevEUR ?>">

    <input type="submit" value="UPDATE CURRENCY!" name="update_currency" id="update_currency" />
</form>

</body>
</html>