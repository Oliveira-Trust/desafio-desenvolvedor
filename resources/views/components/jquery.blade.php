<script>
    // Função responsável por fazer a animação caso o mouse passe no componente
    function animacao_menu(tag,img,animacao = 'animate__rubberBand'){
        $( document ).ready(function() {
            $( tag ).hover(function(){
                //Ao posicionar o cursor sobre a div
                $(img).addClass('animate__animated ' + animacao + ' animate__faster animate__infinite');
                
            },
            function(){
                //Ao remover o cursor da div
                $(img).removeClass('animate__animated ' + animacao + ' animate__faster animate__infinite');
            });
        });
    }

    function animacao_on(tag,img,animacao = 'animate__rubberBand'){
        $( document ).ready(function() {
            $(img).addClass('animate__animated ' + animacao + ' animate__faster animate__infinite');
        });
    }

    function animacao_off(tag,img,animacao = 'animate__rubberBand'){
        $( document ).ready(function() {
            $(img).removeClass('animate__animated ' + animacao + ' animate__faster animate__infinite');
        });
    }

    function mascara_cnpj(input){
        $(document).ready(function(){	
            $(input).mask("00.000.000/0000-00");
        });
    }
</script>