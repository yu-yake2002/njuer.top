function set_class(key, value, cid) {
$.ajax({
    url: "index.php?mod=php_api&action=rankList_class&func=SetClass&key=" + key + "&value=" + encodeURIComponent(value) + "&cid=" + cid,
    success: function (data) {
        $.alert(data);
    }
});
}