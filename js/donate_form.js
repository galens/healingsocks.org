$(function() {
        
    // jquery extend function
    $.extend(
    {
        redirectPost: function(location, args)
        {
            var form = '';
            $.each( args, function( key, value ) {
                form += '<input type="hidden" name="'+key+'" value="'+value+'">';
            });
           $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
        }
    });
        
    var enc_key = '-----BEGIN PKCS7-----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-----END PKCS7-----';
        
    $("#donate_form").submit(function(event) {
        var redirect = 'https://www.paypal.com/cgi-bin/webscr';
        $.redirectPost(redirect, {cmd: '_s-xclick', encrypted: enc_key});
    });
    
    $("#top_donate").click(function(event) {
        var redirect = 'https://www.paypal.com/cgi-bin/webscr';
        $.redirectPost(redirect, {cmd: '_s-xclick', encrypted: enc_key});
    });

});