<?php 
    if(!empty($_GET['location'])){
       
        // Retrieve City Code
        $city_url = 'https://developers.zomato.com/api/v2.1/cities?q=' . $_GET['location'];
        $cityResource = curl_init($city_url);
        curl_setopt($cityResource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cityResource, CURLOPT_HTTPHEADER, array(
            'user-key: 93a6b94e44720afab279f89636f42cae'
        ));
        $cityResult = curl_exec($cityResource);
        $cityData = json_decode($cityResult, true);
        $cityId = $cityData['location_suggestions'][0]['id'];
        // print_r($cityId);
        
        curl_close($cityResource);

        // Search Restauants Curl;

        $search_url = 'https://developers.zomato.com/api/v2.1/search?entity_id=' . $cityId .'&entity_type=city';
        $resource = curl_init($search_url);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($resource, CURLOPT_HTTPHEADER, array(
            'user-key: 93a6b94e44720afab279f89636f42cae'
        ));
        $result = curl_exec($resource);
        $data = json_decode($result, true);
        $restaurants = $data['restaurants'];
        curl_close($resource);
      

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Zomato API</title>
</head>
<body>
    <form action="">
        <input type="text" name="location">
        <button type="submit">submit</button>        
    </form>    
    <section class="section">
        
        <?php 
        if(!empty($restaurants)){
            foreach($restaurants as $restaurant){
                echo '
                    <article>
                        <h3>' . $restaurant['restaurant']['name'] . '</h3>
                        <a href="' . $restaurant['restaurant']['url'] . '">
                            <img src="' . $restaurant['restaurant']['thumb'] . '" />
                        </a>
                        <h6>' . $restaurant['restaurant']['cuisines'] . '</h6>
                        <p>' . $restaurant['restaurant']['location']['address'] . '</p>                        
                    </article>
                ';
            }
        }
        ?>

        </section>

</body>
</html>