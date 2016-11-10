jQuery(function(){
	// wow.js
    function iniciarWow(){
        jQuery('.preload').fadeOut(1000);
        return new WOW().init();
    }
    setTimeout(iniciarWow, 1000);
	
    // animacion con delay
    jQuery(".wow-delay").children().each(function(index, el) {
        var tiempo;
        tiempo = (index*0.15);
        jQuery(this).attr("data-wow-delay", tiempo+'s');
    });

    //error form 
    jQuery("input, textarea").on("focus", function(){
        jQuery(this).parent().find(".wpcf7-not-valid-tip").slideUp();
    });

    // ocultar nav en xs
    jQuery(".collapse").find('a').on("click", function(){
        var ancho = jQuery(window).width();
        if (ancho<767) {
            jQuery(".collapse").collapse('toggle');
        }
    })
    // ani scroll
    var ancho_menu = 0;
    jQuery('a[href^="#"]').not('.btn').click(function(e){
        e.preventDefault();
        var href = jQuery(this).attr('href');
        jQuery('html, body').animate({ scrollTop : jQuery( href ).offset().top - ancho_menu}, 'slow');
    })
    
	jQuery('#instagram-img').bxSlider({
        minSlides: 3,
        maxSlides: 8,
        slideWidth: 360,
        randomStart:true, 
        infiniteLoop: true,
        preloadImages:'all',
        speed:4000,
        hideControlOnEnd: true, 
        auto: true,
    });

})

jQuery(function(){
        // sidebar
        function esMobile(e){
            var ancho = jQuery(window).width();
            if (ancho<767) {
                return e.addClass('mobile');
            }else{
                return e.addClass('desktop');
            }
        }
        esMobile(jQuery('.sidebar'));

        jQuery('.button-mobile').click(function(){
            jQuery(this).parent().parent().toggleClass('sidebar-out');
        })
        //init
        jQuery('.tab-item').first().addClass('active');
        var size = jQuery('.tab-item').first().find('.menu-list-item').size();
        var block = Math.ceil(size/3);
        jQuery('.p-pages').text(block);

        jQuery('.menu-list-item').hide();
        jQuery('.menu-list-item[data-block=1]').show();
        if (jQuery('.menu-pagination .prev').attr('data-block')=='0') {
            jQuery(jQuery('.menu-pagination .prev')).hide();
        }

        // tabs
        jQuery('.tab-cat').click(function (e) {
            e.preventDefault();
            var target = jQuery(this).attr('data-target');
            var title = jQuery(this).find('h4').text();
            var size = jQuery('#'+target).find('.menu-list-item').size();
            var block = Math.ceil(size/3);

            jQuery('.cats li').removeClass('active');
            jQuery(this).parent().addClass('active');

            jQuery('#title-cat').fadeOut(function(){
                jQuery(this).text(title).fadeIn();
            });

            jQuery('.tab-item').removeClass('active');
            jQuery('#'+target).addClass('active');
            
            jQuery('.p-pages').text(block);
            jQuery('.p-page').text('1');

        });
        // paginacion

        jQuery('.menu-pagination .prev').click(function(){
            var page = jQuery('.p-page').text();
            var pages = jQuery('.p-pages').text();

            jQuery('.menu-list-item').hide();
            if (page>1) {
                page--;
                jQuery('.menu-list-item[data-block='+page+']').show();
                jQuery('.p-page').text(page);
            }else{
                jQuery('.menu-list-item[data-block='+pages+']').show();
                jQuery('.p-page').text(pages);
            }
        });

        jQuery('.menu-pagination .next').click(function(){
            var page = jQuery('.p-page').text();
            var pages = jQuery('.p-pages').text();

            jQuery('.menu-list-item').hide();
            if (page<pages) {
                page++;
                jQuery('.menu-list-item[data-block='+page+']').show();
                jQuery('.p-page').text(page);

            }else{
                jQuery('.menu-list-item[data-block=1]').show();
                jQuery('.p-page').text('1');

            }
        });
        // cambio de featured image
        jQuery('.menu-list-item').click(function(){
            var img = jQuery(this).find('.hidden-img').data('img');
            if (img!='') {
                jQuery(this).parent().parent().find('.img-item-featured img').fadeOut(500, function(){
                    jQuery(this).parent().parent().find('.img-item-featured img').attr('src', img);
                    jQuery(this).parent().parent().find('.img-item-featured img').fadeIn(500);
                })
            }
        });
    })