$(document).ready(function () {
    var slider = $('.owl-carousel-1');

    //Feature Slider
    slider.owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1,
                loop: true
            }
        },
        autoplay: true,
        smartSpeed: 250,
        fluidSpeed: 250,
        autoplaySpeed: 250,
        autoPlayTimeout: 250
    });

    $('.n-next-testimonial-1').click(function () {
        slider.trigger('next.owl.carousel');
    });
    // Go to the previous item
    $('.n-prev-testimonial-1').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        slider.trigger('prev.owl.carousel', [300]);
    });

    //TEstimonial Slider 1
    var slider2 = $('.owl-carousel-2');


    slider2.owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        dots: false,
        autoHeight: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1,
                loop: true
            }
        },
        autoplay: true,
        smartSpeed: 250,
        fluidSpeed: 250,
        autoplaySpeed: 250,
        autoPlayTimeout: 250

    });

    $('.n-next-testimonial-2').click(function () {
        slider2.trigger('next.owl.carousel');
    });
    // Go to the previous item
    $('.n-prev-testimonial-2').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        slider2.trigger('prev.owl.carousel', [300]);
    });

    //TEstimonial Slider 2
    var slider3 = $('.owl-carousel-3');


    slider3.owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1,
                loop: true
            }
        },
        autoplay: true,
        smartSpeed: 250,
        fluidSpeed: 250,
        autoplaySpeed: 250,
        autoPlayTimeout: 250
    });

    $('.n-next-testimonial-3').click(function () {
        slider3.trigger('next.owl.carousel');
    });
    // Go to the previous item
    $('.n-prev-testimonial-3').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        slider3.trigger('prev.owl.carousel', [300]);
    });

    //Client Slider
    var slider4 = $('.owl-carousel-4');


    slider4.owlCarousel({
        loop: true,
        margin: 24,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4,
                loop: true
            }
        },
        autoplay: true,
        autoplayTimeout: 40,
        autoplaySpeed: 400,
        autoplayHoverPause: true
    });

    $('.n-next-client').click(function () {
        slider4.trigger('next.owl.carousel');
    });
    // Go to the previous item
    $('.n-prev-client').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        slider4.trigger('prev.owl.carousel', [300]);
    });


    //Partners Slider
    var slider5 = $('.owl-carousel-5');


    slider5.owlCarousel({
        loop: true,
        margin: 24,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4,
                loop: true,
                smartSpeed: 250,
                fluidSpeed: 250,
                autoplaySpeed: 250,
                autoPlayTimeout: 250
            }
        },
        autoplay: true
    });

    $('.n-next-partners').click(function () {
        slider5.trigger('next.owl.carousel');
    });
    // Go to the previous item
    $('.n-prev-partners').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        slider5.trigger('prev.owl.carousel', [300]);
    });


    $('#blogAccess').on('submit',function (e) {
        e.preventDefault();
        processBlogAccess('Hello');

    })
});


//Add newsletter story
function processBlogAccess(btn) {

    var post_url = '/blog/process-blog-access';
    var post_data = btn;
    var container = '#blogaccess-response';

    callAjax(post_url,post_data,container)
}


function callAjax(post_url,post_data,container) {
    console.log(post_data)
    // Using the core $.ajax() method
    $.ajax({

        // The URL for the request
        url: post_url,

        // The data to send (will be converted to a query string)
        data: {
            keyword: post_data
        },

        // Whether this is a POST or GET request
        type: "POST",

        // The type of data we expect back
        // dataType : "any",
    })
    // Code to run if the request succeeds (is done);
    // The response is passed to the function
        .done(function( data ) {

            console.log(container);
            $(container).html(data);

        })
        // Code to run if the request fails; the raw request and
        // status codes are passed to the function
        .fail(function( xhr, status, errorThrown ) {
            //alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        })
        // Code to run regardless of success or failure;
        .always(function( xhr, status ) {
            console.log( "The request is complete!" );
        });

}