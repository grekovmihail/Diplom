/**
 * Created by ������ on 16.04.2017.
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
            hintContent: '��',
            balloonContent: '��'
        }, {
            // �����.
            // ���������� ������� ������ ��� ������.
            iconLayout: 'default#image',
            // ��� ����������� ������ �����.
            iconImageHref: 'KO.png',
            // ������� �����.
            iconImageSize: [30, 42],
            // �������� ������ �������� ���� ������ ������������
            // � "�����" (����� ��������).
            iconImageOffset: [-5, -38]
        });

    myMap.geoObjects.add(myPlacemark);
});