$(function () {
    ymaps.ready(init);
})

function init() {
    var geolocation = ymaps.geolocation;
    var myMap = new ymaps.Map("map_full", {
        center: [55.76, 37.64],
        zoom: 10,
        controls: ['geolocationControl']
    }, {
        searchControlProvider: 'yandex#search'
    });

    /**
     * добавляем точки на карту
     */
    if (!!Coords) {
        Coords.forEach(function (currentValue) {

            let marks = currentValue.MARK.VALUE.split(',')
            delete currentValue["MARK"]
            console.log(currentValue)

            let htmlPopup = renderPopupMark(currentValue)
            myMap.geoObjects.add(new ymaps.Placemark([marks[0] , marks[1]], {
                balloonContent: htmlPopup
            }))
        })
        myMap.setBounds(myMap.geoObjects.getBounds(),{checkZoomRange:true}).then(
            function(){
                if(myMap.getZoom() > 10) {
                    myMap.setZoom(10);
                }
            }
        );
    } else {
        geolocation.get({
            provider: 'browser',
            mapStateAutoApply: true
        }).then(function (result) {

            result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
            myMap.setCenter([result.geoObjects.position[0],  result.geoObjects.position[1]] , 10);

        });
    }
}
function renderPopupMark(oMark) {
    let html = "";
    for (var key in oMark) {
        html += "<p>"+ oMark[key].NAME + ": "+ oMark[key].VALUE + "</p>"
    }
    return html
}