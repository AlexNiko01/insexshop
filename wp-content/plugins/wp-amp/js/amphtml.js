(function( $ ) {
    var color_options = [
        'header_color',
        'footer_color',
        'background_color',
        'link_color',
        'main_text_color',
        'header_text_color',
        'footer_text_color',
        'main_title_color',
        'add_to_cart_button_color'
    ];


    $(color_options).each( function() {
        $('#' + this).wpColorPicker();
    });

    $('#reset').click(function(e) {
        $('#amp-settings').attr('action', '#');
        //$('input[name="action"]').val('reset');
    });

    var manage_image = function ( element, custom_uploader ) {
        element.find('.reset_image_button').click(function(e) {
            element.find('.upload_image').val('');
            element.find('.logo_preview').hide();
            element.find(this).hide();
        });

        element.find('.upload_image_button').click(function(e) {

            e.preventDefault();

            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                element.find('.upload_image').val(attachment.url);
                element.find('.logo_preview img').attr('src', attachment.url);
                element.find('.logo_preview').show();
                element.find('.reset_image_button').show();

            });

            custom_uploader.open();

        });
    };

    var logo_uploader;
    var image_uploader;
    var main_logo;

    manage_image( $('tr[data-name=default_logo]'), logo_uploader );
    manage_image( $('tr[data-name=default_image]'), image_uploader );
    manage_image( $('tr[data-name=logo]'), main_logo );

    $('#google_analytic').mask('SS-000099999-0999');

    var checkLogo = function () {
        switch ($('#logo_opt').val()) {
            case 'icon_logo':
                $('tr').has('.logo_preview').show();
                $('tr').has('#logo_text').hide();
                $('.img_text_size').show();
                $('.img_text_size_full').hide();
                break;
            case 'text_logo':
                $('tr').has('#logo_text').show();
                $('tr').has('.logo_preview').hide();
                break;
            case 'icon_an_text':
                $('tr').has('#logo_text').show();
                $('tr').has('.logo_preview').show();
                $('.img_text_size').show();
                $('.img_text_size_full').hide();
                break;
            case 'image_logo':
                $('tr').has('#logo_text').hide();
                $('tr').has('.logo_preview').show();
                $('.img_text_size_full').show();
                $('.img_text_size').hide();
                break;
        }
    };

    var updateAd = function(type) {
        switch ($('#ad_type_' + type).val()) {
            case 'adsense':
                $('tr').has('#ad_data_id_client_' + type).show();
                $('tr').has('#ad_adsense_data_slot_' + type).show();
                $('tr').has('#ad_doubleclick_data_slot_' + type).hide();
                $('#ad_doubleclick_data_slot_' + type).removeAttr('required');
                $('#ad_data_id_client_' + type).attr("required", true);
                $('#ad_adsense_data_slot_' + type).attr("required", true);
                break;
            case 'doubleclick':
                $('tr').has('#ad_data_id_client_' + type).hide();
                $('tr').has('#ad_adsense_data_slot_' + type).hide();
                $('tr').has('#ad_doubleclick_data_slot_' + type).show();
                $('#ad_data_id_client_' + type).removeAttr('required');
                $('#ad_adsense_data_slot_' + type).removeAttr('required');
                $('#ad_doubleclick_data_slot_' + type).attr("required", true);
                break;
        }
    };

    checkLogo();
    updateAd('top');
    updateAd('bottom');

    $('#logo_opt').change(function() {
        checkLogo();
    });

    $('#ad_type_top').change(function() {
        updateAd('top');
    });

    $('#ad_type_bottom').change(function() {
        updateAd('bottom');
    });

    $('input[name="amphtml_ad_enable"]').change(function() {
        if ( $('input[name="amphtml_ad_enable"]:checked').length === 0 ) {
            $('#ad_doubleclick_data_slot_' + type).removeAttr('required');
            $('#ad_data_id_client_' + type).removeAttr('required');
            $('#ad_adsense_data_slot_' + type).removeAttr('required');
        }
    });

    if ( $('input[name="amphtml-exclude"]:checked').length === 1 ) {
        $('#amphtml-metabox-settings').hide();
        $('#amphtml-featured-image').hide();
    }

    $('input[name="amphtml-exclude"]').change( function() {
        $('#amphtml-metabox-settings').toggle();
        $('#amphtml-featured-image').toggle();
    } );

})( jQuery );