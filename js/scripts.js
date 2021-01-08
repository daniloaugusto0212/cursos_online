$(function(){
    //Aqui vai nosso código javascript
    $('nav.mobile').click(function(){
        //O que vai acontecer qundo clicarmos na nav mobile
        var listaMenu = $('nav.mobile ul');
        //Abrir menu através do fadeIn e fechar através do fadeOut
        /*
        if (listaMenu.is(':hidden') == true)
            listaMenu.fadeIn();
        else
            listaMenu.fadeOut();
            */

        //Abre e fecha menu através do comando slideToggle
        
        //listaMenu.slideToggle();

        //Abre através do show e fecha através do hide
        /*
        if (listaMenu.is(':hidden') == true)
            listaMenu.show();
        else
            listaMenu.hide();
        */

        if (listaMenu.is(':hidden') == true){           
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-arrow-alt-circle-down');
            icone.addClass('fa-arrow-alt-circle-up');
            listaMenu.slideToggle();
        }
        else{   
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-arrow-alt-circle-up');
            icone.addClass('fa-arrow-alt-circle-down');                     
            listaMenu.slideToggle();
   
        }       

    });
    if ($('target').length > 0){
        //O elemento existe, portanto precisamos dar scroll em algum elemento.
        var elemento = '#'+$('target').attr('target');        
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({'scrollTop': divScroll},2000);
        
    }

    carregarDinamico();
    function carregarDinamico(){
        $('[realtime]').click(function(){
            var pagina = $(this).attr('realtime');
            $('.container-principal').hide();
            $('.container-principal').load(include_path+'pages/'+pagina+'.php');

            setTimeout(function(){
                initialize(addMarker);
                addMarker(-27.609959,-48.576585,'',"Minha casa",undefined,false);
                }, 1000);

            $('.container-principal').fadeIn(1000);
            window.history.pushState('','', pagina);

            return false;
        })
    }
})