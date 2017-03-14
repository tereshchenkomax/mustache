
(function($){
    wp.customize("mustache_settings", function(value) {
        console.log(value)
        value.bind(function(newval) {
            $("#mustache_settings").html(newval);
        } );
    });
})(jQuery);