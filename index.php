<?php
function getQuote () {
  $keygen = mt_rand(1,999999);
  $c = curl_init();
  curl_setopt($c, CURLOPT_URL,"http://api.forismatic.com/api/1.0/?method=getQuote&key=".$keygen."&format=json&lang=en");
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  return json_decode(utf8_encode(curl_exec($c)),true);
}

$i = 0;
$quote = NULL;
while (is_null($quote) && $i < 100) {
  $quote = getQuote();
  $i++;
}
?>

<html>
  <style>

  div {
    width: 25%;
    min-width: 280px;
    margin: 100px auto;
    padding: 10px 30px;
    font-family: serif;
    box-shadow: 5px 5px 20px -5px rgba(96, 125, 139, 0.25);
    padding: 20px;
  }

  .right {
    text-align: right;
    margin-right: 30px;
    color: gray;
  }

  </style>
  <body>
    <div>
      <p>
        <?=$quote['quoteText']?>
      </p>
        <?php
        if (strlen($quote['quoteAuthor']) > 0) {
          echo "<p class='right'><em>\n - ";
          echo $quote['quoteAuthor'];
          echo "\n</em></p>";
        }
        ?>
    </div>
  </body>
</html>
