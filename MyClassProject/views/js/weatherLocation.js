$(function(){

  var conditionsInput = $('#currentconditinos')
    , lngInput = $('#longitude')
    , latInput = $('#latitude')
    , iconLable = $('label[for=currentconditinos]')
    , cityInput = $('#currentlocation');

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(goLive, goOffAir);
  }

  if (!navigator.geolocation) {
    goOffAir();
  }

  function goLive(position){
    var lat = position.coords.latitude.toFixed(6)
      , lng = position.coords.longitude.toFixed(6);


    lngInput.val(lng);
    latInput.val(lat);
    getWeather(lat, lng);
  }

  function goOffAir(){
    alert('Damn! looks like we can\'t get a read on your location. Describe your location in the "Plant Location" notes field instead.');
  }

  function getWeather(lat, lng) {

    var url ='http://api.openweathermap.org/data/2.5/weather?units=imperial&lat=' + lat + '&lon=' + lng + '&APPID=7580e76e1156c975eda268ffd1d1c25e';

    console.log(url);
    $.getJSON(url, function(data) {
      console.log(data);
      var description = data.weather[0].description,
        temperature = data.main.temp,
        icon = data.weather[0].icon,
        cityTown = data.name;

      conditionsInput.val(description + ', Temp: ' + temperature + ' (f)');
      iconLable.append('<img height="32" src="http://openweathermap.org/img/w/' + icon + '.png">' );
      cityInput.val(cityTown);
    });
  }
});