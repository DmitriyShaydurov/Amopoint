function  sendData(data) {
    device = ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) ? 'mobile device' :  'desktop';
    body =`ip=${data.geoplugin_request}&city=${data.geoplugin_regionName}&device=${device}`;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'http://amopoint-test2.shaydurov.beget.tech/api/visitors', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(body);
}
window.onload =function() {
    const Http = new XMLHttpRequest();
    const url='http://www.geoplugin.net/json.gp';
    Http.open("GET", url);
    Http.send();
    Http.onreadystatechange=(e)=>{
        if (Http.readyState === 4) {
            sendData(JSON.parse(Http.responseText));
        }
    }
};