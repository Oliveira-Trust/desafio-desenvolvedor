function Helper() {

    this.basePasthUrl = function (_path) {
        if (typeof _path === "undefined")   {_path = '';}
       return window.location.protocol + "//" + window.location.host + "/"+_path;
    };

    this.currentUrl = function (_split) {
        if (typeof _split === "undefined")   {_split = false;}
        let url = window.location.href;
        return _split === false ? url : url.split(_split)[0];
    };

    this.alertSucess = function (_title, _button, _timer) {
        if (typeof _title === "undefined"){_title = 'Ação executada com sucesso';}
        if (typeof _button === "undefined"){_button = true;}
        if (typeof _timer === "undefined"){_timer = false;} else { _timer *= 1000; }
        swal({title:_title, type: "success", showConfirmButton: _button, timer: _timer });
    };

    this.alertError = function (_subTitle, _title, __focus) {
        if (typeof _title === "undefined")   {_title = 'Atenção!';}
        if (typeof _subTitle === "undefined"){_subTitle = 'Ocorreu um erro';}
        if (typeof __focus === "undefined")  {__focus = false;}
        swal(_title, _subTitle, "error");
        if(__focus !== false) {
            $('.swal-button--confirm').click(function () {
                $(__focus).focus();
            });
        }
    };

    this.alertSucessInRedirect = function (_title, _urlRedirect) {
        if (typeof _title === "undefined"){_title = 'Ação executada com sucesso';}

        swal({
            title: _title,
            text: "",
            type: "success",
            confirmButtonText: 'Continuar',
            showConfirmButton: true
        }).then((dismiss) => {
                document.location.href = _urlRedirect.replace('#','');
            });

    };

    this.alertErrorInRedirect = function (_subTitle, _urlRedirect) {
        if (typeof _subTitle === "undefined"){_subTitle = 'Ocorreu um erro';}
        swal({ title: "Atenção!", text: _subTitle, type: "error", confirmButtonText: 'Fechar'}).then((action) => { location.href = _urlRedirect; });

    };

    this.alertConfirmation = function (_urlRedirect, _subTitle, _title) {
        if (typeof _subTitle === "undefined")   {_subTitle = 'Existem informações não salvas!<br>Deseja continuar mesmo assim?';}
        if (typeof _title === "undefined")      {_title = 'Atenção!';}

        swal({
            title: _title,
            html: _subTitle,
            type: "warning",
            confirmButtonText: "CONTINUAR MESMO ASSIM >>",
            cancelButtonText: "CANCELAR",
            width: '462px',
            showCancelButton: true
        }).then((dismiss) => {
            if (dismiss.value) {
                document.location.href = _urlRedirect;
            }
        });

    };

    this.smoothScroll = function( hash, type ) {
        if (typeof type === "undefined"){type = '#';}
        $('html, body').animate({
            scrollTop: $(type+hash).offset().top
        }, 800, function(){
            window.location.hash = hash;
        });
    }

    this.alertProcess = function () {
        swal({
            title: "Processando...",
            html: "<img src=\""+this.basePasthUrl()+"assets/images/loading-spinner.gif\">",
            showConfirmButton: false
        });
    };

    this.somenteNumeros = function(num) {
        let er = /[^0-9.]/;
        er.lastIndex = 0;
        let campo = num;
        if (er.test(campo.value)) {
            campo.value = "";
        }
    };

    this.textTruncate = function(str, length, ending) {
        if (length == null) {
            length = 100;
        }
        if (ending == null) {
            ending = '...';
        }
        if (str.length > length) {
            return str.substring(0, length - ending.length) + ending;
        } else {
            return str;
        }
    };

    this.setCookie = function (name, value, days) {
        let expires = "";

        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }

        document.cookie = name + "=" + JSON.stringify(value) + expires + "; path=/";
    };

    this.getCookie = function(name){
        let nameEQ = name + "=",
        ca         = document.cookie.split(';');

        for(let i=0;i < ca.length;i++) {
            let c = ca[i];
            while ( c.charAt(0) == ' ') c = c.substring(1,c.length);
            if ( c.indexOf(nameEQ) == 0)
                return  JSON.parse(c.substring(nameEQ.length,c.length));
        }

        return null;
    };

    this.deleteCookie = function(name,obj){
        obj.setCookie(name,"",-1);
    };

    this.removeDupsArray = function(names) {
        let unique = {};
        names.forEach(function(i) {
            if(!unique[i]) {
                unique[i] = true;
            }
        });
        return Object.keys(unique);
    };

    this.isEmpty = function(str) {
        return (!str || 0 === str.length);
    };

    this.isNumber = function(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    };

    this.formatInputValToFloat = function(value){
        return parseFloat( value.replace('.','').replace(',','.') );
    };

    this.FormateStringData = function(data, formatOut) {

        if (typeof formatOut === "undefined")   {formatOut = 'DDMMYYYY';}

        let dataReturn = '';
        if( data !== '' && typeof data !== "undefined" ) {
            let dataSplit = data.split(/\D/g);
            switch ( formatOut ) {
                case 'DDMMYYYY':
                    dataReturn = [dataSplit[2],dataSplit[1],dataSplit[0] ].join("/");
                    break;
                case 'YYYYMMDD':
                    dataReturn = [dataSplit[2],dataSplit[1],dataSplit[0] ].join("-");
                    break;

            }
        }

        return dataReturn !== '' ? dataReturn : data;
    };

    this.htmlSpinner = function () {
        return '<i class="la la-spinner spinner"></i>';
    };

    this.alertClose = function () {
        swal.close();
    };

    this.onlyString = function ( value ) {
        return this.removeAccentsSpecialChars( value.replace(/(<([^>]+)>)/ig,"") );
    };

    this.onlyNumber = function(num) {
        let er = /[^0-9.]/;
        er.lastIndex = 0;
        let campo = num;
        if (er.test(campo.value)) {
            campo.value = "";
        }
        return campo;
    };

    this.removeAccentsSpecialChars = function(str) {
        let com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŔÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿŕ";
        let sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
        let novastr    = "";
        for(i=0; i<str.length; i++) {
            let troca=false;
            for (a=0; a<com_acento.length; a++) {
                if (str.substr(i,1) === com_acento.substr(a,1) ) {
                    novastr+=sem_acento.substr(a,1);
                    troca=true;
                    break;
                }
            }
            if (troca === false) {
                novastr+=str.substr(i,1);
            }
        }
        return novastr;
    };

    this.actionCloseCard = function (elementBlock) {
        elementBlock.unblock();
    };
    
    this.actionReloadCard = function (_className, _classCloset) {

        if (typeof _classCloset === "undefined")   {_classCloset = 'card';}

        //$('.'+_className).on('click',function(){

            let block_ele = $('#'+_className).closest('.'+_classCloset);

            // Block Element
            block_ele.block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
                //timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    cursor: 'wait',
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });

            return block_ele;
        //});
    };

    this.loadFormFields = function () {

        let elem = $('.form-group-style .form-control');

        elem.off().focus(function() {
            $(this).parent(".form-group-style").addClass('focus');
            if($(this).val() !== ""){
                $(this).parent(".form-group-style").children("label").addClass("filled");
            }
            else{
                $(this).parent(".form-group-style").children("label").removeClass("filled");
            }
        }).focusout(function() {
            if($(this).parent(".form-group-style").hasClass('focus')){
                $(this).parent(".form-group-style").removeClass('focus');
            }
            if($(this).val() !== ""){
                $(this).parent(".form-group-style").children("label").addClass("filled");
            }
            else{
                $(this).parent(".form-group-style").children("label").removeClass("filled");
            }
        });
    };

    this.numberFormat = function( number, decimals, dec_point, thousands_sep) {

        if (typeof decimals === "undefined")     {decimals = 2;}
        if (typeof dec_point === "undefined")    {dec_point = ',';}
        if (typeof thousands_sep === "undefined"){thousands_sep = '.';}

        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        let n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    };

    /**
     * ex: 2124098764
     * @param value
     */
    this.validatePhone = function (value) {
        let flag = false;
        if( value !== '' ) {
            flag = (value[2] === '2' || value[2] === '3' || value[2] === '4' || value[2] === '5');
        }
        return flag;
    };

    this.validateCpf = function (value) {
        let $return   = true;
        let invalidos = [ '111.111.111-11', '222.222.222-22', '333.333.333-33', '444.444.444-44',
                          '555.555.555-55', '666.666.666-66', '777.777.777-77', '888.888.888-88',
                          '999.999.999-99', '000.000.000-00'];

        let i = 0;
        for(i=0;i<invalidos.length;i++) {
            if( invalidos[i] === value) {
                $return = false;
            }
        }

        value = value.replace("-","");
        value = value.replace(/\./g,"");

        //validando primeiro digito
        let add = 0;
        for ( i=0; i < 9; i++ ) {
            add += parseInt(value.charAt(i), 10) * (10-i);
        }
        let rev = 11 - ( add % 11 );
        if( rev === 10 || rev === 11) {
            rev = 0;
        }
        if( rev !== parseInt(value.charAt(9), 10) ) {
            $return = false;
        }

        //validando segundo digito
        add = 0;
        for ( i=0; i < 10; i++ ) {
            add += parseInt(value.charAt(i), 10) * (11-i);
        }
        rev = 11 - ( add % 11 );
        if( rev === 10 || rev === 11) {
            rev = 0;
        }
        if( rev !== parseInt(value.charAt(10), 10) ) {
            $return = false;
        }

        return $return;
    };

    this.strPad = function(input, padLength, padString, padType) {

        let half = '';
        let padToGo;

        let _strPadRepeater = function (s, len) {
            let collect = '';

            while (collect.length < len) {
                collect += s
            }
            collect = collect.substr(0, len);

            return collect
        };

        input += '';
        padString = padString !== undefined ? padString : ' ';

        if (padType !== 'STR_PAD_LEFT' && padType !== 'STR_PAD_RIGHT' && padType !== 'STR_PAD_BOTH') {
            padType = 'STR_PAD_LEFT'
        }
        if ((padToGo = padLength - input.length) > 0) {
            if (padType === 'STR_PAD_LEFT') {
                input = _strPadRepeater(padString, padToGo) + input
            } else if (padType === 'STR_PAD_RIGHT') {
                input = input + _strPadRepeater(padString, padToGo)
            } else if (padType === 'STR_PAD_BOTH') {
                half = _strPadRepeater(padString, Math.ceil(padToGo / 2));
                input = half + input + half;
                input = input.substr(0, padLength);
            }
        }

        return input;
    };

    this.startModalDefault = function(title, htmlFooter){
        let scope                  = $('.modal-default-pdv');
        let elemContentMainDefault = $('.content-main-default');
        scope.removeClass("hidden");
        $('.modal-default-content').addClass('modal-down');
        $('.modal-default-title').html(title);
        elemContentMainDefault.html( helper.htmlSpinner() + ' carregando...' );

        $('.modal-close-default').off().on('click', function () {
            let scope = $('.modal-default-pdv');
            $('.modal-default-content').removeClass('modal-down');
            $('.modal-default-title').html('');
            $('.content-main-default').html('');
            scope.find('.modal-footer').css('display','none').html('');
            scope.addClass("hidden");
        });

        if( typeof htmlFooter !== "undefined" ){
            scope.find('.modal-footer').css('display','block').html(htmlFooter);
        }

        return elemContentMainDefault;

    };

    this.htmlEncode = function(text){

        let el = document.createElement("div");
        el.innerText = el.textContent = text;
        text = el.innerHTML;
        return text;

    };
    this.strLimit = function(text, count, insertDots){
        if( text !== null  ) {
            return text.slice(0, count) + (((text.length > count) && insertDots) ? "..." : "");
        }
        return text;
    };

    this.timer = function(id, timerIn){

        if (parseInt(timerIn) < 10){
            timerIn = helper.strPad( timerIn, 2, '0' )
        }

        let timer2 = timerIn + ":00";
        let interval = setInterval(function() {
            let timer = timer2.split(':');
            let minutes = parseInt(timer[0], 10);
            let seconds = parseInt(timer[1], 10);
            ++seconds;
            minutes = (seconds > 59) ? ++minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds > 59) ? 0 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $('.countdown-'+id).html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }, 1000);
    };

    this.getVolumeUnitLabel = function(volume_value, type){

        let volume_type;
        switch(type) {
        case 'UNIDADE':
            volume_type = (volume_value > 1) ? 'Unds' : 'Un';
            break;
        case 'LITRO':
            volume_type = (volume_value > 1) ? 'Lts' : 'L';
            break;
        default:
            volume_type = capitalize(type)
        }
        return volume_type;

    };

    this.goBack = function () {
        window.history.back();
    };

    const capitalize = (s) => {
        if (typeof s !== 'string') return '';
        return s.charAt(0).toUpperCase() + s.slice(1).toLowerCase()
      }
}

var helper = new Helper();
