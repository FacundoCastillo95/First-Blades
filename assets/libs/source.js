// HEADER SCRIPTS
$(document).ready(function(){
    // Change language displayed item
    $(document).ready(function(){
        $(".dropdown-menu").on('click', '.dropdown-item', function(){
            $(".dropdown-toggle").text($(this).text());
            $(".dropdown-toggle").val($(this).text());
        });
    }); 

    // Change color and styles
    $('.navbar-toggler').click(function () { 
        $('path').toggleClass('white-fill');
        $('header').toggleClass('open'); 
    });

    var mq = window.matchMedia("(max-width: 991.9px)")
    toggleOpenMobile(mq);
    mq.addListener(toggleOpenMobile);

    function toggleOpenMobile(mq){
        if(mq.matches){
           $('.nav-closer').click(function () { 
                $('path').toggleClass('white-fill');
                $('header').toggleClass('open'); 
            });
        }
    }

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault(); 
            
            $('html, body').animate({scrollTop: $(anchor.getAttribute('href')).offset().top - 35}, 'slow');
        });
    });

    // Close navbar on click item
    $('.navbar-nav>li>a').on('click', function(){
        $('.navbar-collapse').collapse('hide');
    });

    // Hide/Show header on scroll down/up
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
           $('#header').removeClass('scrolled'); 
        } else {
            $('#header').addClass('scrolled');
        }
        prevScrollpos = currentScrollPos;
    }
});