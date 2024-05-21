<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        #result {
            display: none;
        }
    </style>
</head>
<body>
    <form name="weather_form" id="weather_form" action="{{ route('get_weather') }}">
        @csrf
        <input name="city" id="city" type="text" placeholder="Enter city name" required value=""/>
        <button type="submit">Get Weather</button>
    </form>
    <div id="result">
            <h2 class="city_name"></h2>
            <p>Temperature: <span class="temp"></span>°C</p>
            <p>Description: <span class="desc"></span></p>
            <p>Feels like : <span class="feels_like"></span>°C</p>
            <p>Humidity :   <span class="humidity"></span>%</p>
            <p>Pressure :   <span class="pressure"></span></p>
            <p>Wind Speed : <span class="wind_speed"></span>m/s</p>
    </div>
          
    <script>
        $(document).ready(function() {
            $("#weather_form").submit(function(e) {

                e.preventDefault(); 

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    dataType: "json",
                    success: function(response)
                    {
                        if(response.status =='success'){
                            let weather = response.weather;
                            $('.city_name').text(weather.city);
                            $('.temp').text(weather.temp);
                            $('.desc').text(weather.desc);
                            $('.feels_like').text(weather.feels_like);
                            $('.humidity').text(weather.humidity);
                            $('.pressure').text(weather.pressure);
                            $('.wind_speed').text(weather.wind_speed);
                            $('#result').show();
                        }
                    }
                });

            });
        });
    </script>
</body>
</html>