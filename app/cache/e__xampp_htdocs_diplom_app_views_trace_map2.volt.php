<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Задание собственного изображения для метки</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script>

        x=55.751574,
            y=37.573856;
        ymaps.ready(function () {
            /*var x=55.751574,
             y=37.573856;*/
            var myMap = new ymaps.Map('map', {
                    center: [x, y],
                    zoom: 9
                }, {
                    searchControlProvider: 'yandex#search'
                }),
                myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                    hintContent: 'КО',
                    balloonContent: 'КО'
                }, {
                    // Опции.
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: 'KO.png',
                    // Размеры метки.
                    iconImageSize: [30, 42],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-5, -38]
                });

            myMap.geoObjects.add(myPlacemark);
        });
 
    </script>
    <style>
        html, body, #map {
            width: 70%; height: 70%; padding: 0; margin: 0;
        }
    </style>
</head>
<body>
<div id="map"></div>
</body>
</html>
