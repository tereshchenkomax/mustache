
(function($){
    wp.customize("mustache_my_settings", function(value) {
        console.log(value)
        value.bind(function(newval) {
            $("#mustache_my_settings").html(newval);
        } );
    });
})(jQuery);