(function($) {
    $(document).ready(function (){
            $('body').on('click', 'img.herald-img-select', function(e){
                e.preventDefault();
                $(this).closest('ul').find('img.herald-img-select').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');
            }); 
    });
    
})(jQuery);