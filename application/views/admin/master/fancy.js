
(function($){
    $.fn.fancy_string = function(settings)
    {
        console.log('memanggil fancy string...');

        var opts = {
            mode : "",
        };

        var opts = $.extend(opts, settings);
        var raw_text = $(this).html();
        var result_text = raw_text; 

        switch (opts.mode){

            case "title": 
                raw_text = result_text = raw_text.toLowerCase();
                result_text = title(raw_text);
            break;

            default:
                result_text = raw_text;
            break;
        }

        $(this).html(result_text);

    };

    // function untuk mengubah string menjadi bentuk title
    function title(raw_text)
    {
        var word_list = raw_text.trim().split(' ');

        var temp_word_list = [];
        word_list.forEach(function(word){
            var temp_word = word.replace(word.charAt(0), word.charAt(0).toUpperCase());
            temp_word_list.push(temp_word);
        });

        return temp_word_list.join(' ');
    };  

})(jQuery);
