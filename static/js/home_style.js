function settings(set_key, set_value) {
    sendData_GET("index.php?mod=php_api&action=user_profile&func=settings"
        + "&key=" + set_key
        + "&value=" + set_value);
}