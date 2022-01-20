$(document).ready(function () {
    $('.selectpicker').selectpicker({
        width: '100%'
    });
    
    $('.search-categories').on('click', function () {
       $('.dropdown-menu').css('z-index', '100'); 
    });

    $('body').click(function (){
        $('#jobsSearchResults').fadeOut();
    });
    $('#search-location').autocomplete({
        source: availableLocation,
    });

        $('.image-slider').owlCarousel({
            margin: 10,
            autoplay: false,
            loop: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: false,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                320: {
                    items: 1,
                    margin: 20,
                },
                540: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
            },
        });

    $('.pricing-slider').owlCarousel({
        margin: 10,
        autoplay: false,
        loop: false,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: false,
        dots: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            1024: {
                items: 2,
            },
            1200: {
                items: 3,
            },
        },
    });

    $('#image-search-carousel').owlCarousel({
        margin: 10,
        autoplay: true,
        loop: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: false,
        dots: false,
        items: 1,
    });

    let windowWidth = $(window).width();

    function brandItem () {
        if (windowWidth > 1200) {
            return 6;
        } else if (windowWidth > 576) {
            return 4;
        } else if (windowWidth > 0) {
            return 2;
        }
    }

    function brandSlider (item) {
        let itemLength = $('#brandingSlider .item:not(.cloned)').length;
        return itemLength > item ? true : false;
    }

    $('#brandingSlider').owlCarousel({
        loop: brandSlider(brandItem()),
        autoplay: true,
        margin: 30,
        mouseDrag: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
        responsiveClass: false,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 4,
            },
            1024: {
                items: 4,
            },
            1200: {
                items: 6,
            },
        },
    });

    if ($(window).width() > 1024) {
        // counting the number of classes named .item
        if ($('#brandingSlider .item').length < 6) {
            $('#brandingSlider.owl-carousel .owl-stage-outer').
                css('display', 'flex').
                css('justify-content', 'center');
        }
    }

    $('#brandingSlider .item').on('mouseover', function () {
        $(this).closest('.owl-carousel').trigger('stop.owl.autoplay');
    });

    $('#brandingSlider .item').on('mouseout', function () {
        $(this).closest('.owl-carousel').trigger('play.owl.autoplay');
    });

    $('#notices').on('mouseover', function () {
        this.stop();
    });

    $('#notices').on('mouseout', function () {
        this.start();
    });

    $('#search-keywords').on('keyup', function () {
        let searchTerm = $(this).val();
        if (searchTerm != '') {
            $.ajax({
                url: jobsSearchUrl,
                method: 'GET',
                data: { searchTerm: searchTerm },
                success: function (result) {
                    $('#jobsSearchResults').fadeIn();
                    $('#jobsSearchResults').html(result);
                },
            });
        } else {
            $('#jobsSearchResults').fadeOut();
        }
    });

    $(document).on('click', '#jobsSearchResults ul li', function () {
        $('#search-keywords').val($(this).text());
        $('#jobsSearchResults').fadeOut();
    });

});
