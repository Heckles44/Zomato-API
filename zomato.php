<?php 
    if(!empty($_GET['location'])){
       
        $zomato_url = 'https://developers.zomato.com/api/v2.1/search?entity_id=259&entity_type=city';

        // $zomato_json = file_get_contents($zomato_url);
        // $zomato_array = json_decode($zomato_json, true);


        // $restaurants = $zomato_array['restaurants'];
        // echo $restaurants;

        // Using Curl;
        $resource = curl_init($zomato_url);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($resource, CURLOPT_HTTPHEADER, array(
            'user-key: 93a6b94e44720afab279f89636f42cae'
        ));
        $result = curl_exec($resource);
        $data = json_decode($result, true);
        $restaurants = $data['restaurants'];

      

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