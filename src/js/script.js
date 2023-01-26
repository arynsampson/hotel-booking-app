// get hotels to compare 
function showHotel(num) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let hotel = JSON.parse(this.responseText);
            document.getElementById("hotel-name").innerHTML = hotel.name;
            document.getElementById("daily_rate").innerHTML = hotel.daily_rate;
            document.getElementById("rating").innerHTML = hotel.rating;
            document.getElementById("thumnbail").src = hotel.thumbnail;
            document.getElementById("hotel_link").href = "../views/hotelDetails.view.php/?id=" + hotel.id;
        }
    };
    xmlhttp.open("GET","../php/handling/hotel/HotelHandler.php/?action=fetchHotel&id="+num);
    xmlhttp.send();
}