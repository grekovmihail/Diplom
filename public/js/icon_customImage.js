/**
 * Created by Михаил on 16.04.2017.
 */

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