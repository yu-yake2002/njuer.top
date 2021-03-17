function set_private(set_key, set_value) {
    sendData_GET("index.php?mod=php_api&action=user_profile&func=set_private"
        + "&key=" + set_key
        + "&value=" + set_value);
}
function settings(set_key, set_value) {
    document.getElementById("set_" + set_key).selectedIndex = Number(set_value) - 1;
    sendData_GET("index.php?mod=php_api&action=user_profile&func=settings"
        + "&key=" + set_key
        + "&value=" + set_value);
}