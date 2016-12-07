$(document).ready(function () {
    var getProductHeight = $('.product.active').height();

    $('.products').css({
        height: getProductHeight
    });

    function calcProductHeight() {
        getProductHeight = $('.product.active').height();
        $('.products').css({
            height: getProductHeight
        });
    }
    
    function updateButtons() {
        if(!productCurrentItem.next().length) {
            // Fin de los items en Siguiente
            $('a[id="next"]').text('Comenzar a usarlo');
            $('a[id="next"]').attr("href", "index.php?page=automocion_vehiculos");
        } else {
            // Hay items en Siguiente
            $('a[id="next"]').removeAttr('disabled');
            $('a[id="prev"]').removeAttr('disabled');
            $('a[id="next"]').text('Siguiente');
            $('a[id="next"]').attr("href", "#")
        }
        
        if(productCurrentItem.prev().length) {
            // Hay items en Anterior
            $('a[id="prev"]').removeAttr('disabled');
        } else {
            // Fin de los items en Anterior
            $('a[id="prev"]').attr('disabled','disabled');
        }
    }
    
    function onClickNext(e) {
        if($(this).attr('href') != '#') return;
        e.preventDefault();
        var nextItem = productCurrentItem.next();
        productCurrentItem.removeClass('active');
        if (nextItem.length) {
            productCurrentItem = nextItem.addClass('active');
        } else {
            productCurrentItem = productCurrentItem.addClass('active');
        }
        updateButtons();
        calcProductHeight();
    }
   
   function onClickPrev(e) {
        e.preventDefault();
        var prevItem = productCurrentItem.prev();
        productCurrentItem.removeClass('active');
        if (prevItem.length) {
            productCurrentItem = prevItem.addClass('active');
        } else {
            productCurrentItem = productCurrentItem.addClass('active');
        }
        updateButtons();
        calcProductHeight();
    }

    var productItem = $('.product'), productCurrentItem = productItem.filter('.active');

    $('#next').on('click', onClickNext);
    $('#prev').on('click', onClickPrev);
    
    updateButtons();
});