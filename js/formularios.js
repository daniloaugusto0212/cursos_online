$(function(){
    $('body').on('submit','form.ajax-form',function(){
        var form = $(this);
            $.ajax({
                beforeSend:function(){
                    $('.overlay-loading').fadeIn();
                },
                url:include_path+'ajax/formularios.php',
                method:'post',
                dataType:'json',
                data:form.serialize()
        }).done(function(data){
            if(data.sucesso){
                //Melhorando a interface
                $('.overlay-loading').fadeOut();
                $('.sucesso').slideToggle();
                setTimeout(function(){
                    $('.sucesso').fadeOut();
                },4000)
            }else{
                $('.overlay-loading').fadeIn();
            }
        });
        return false;
        
    })
    
})