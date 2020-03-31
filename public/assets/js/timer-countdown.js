class TimerCountDown{

    c = {
        secondsKeepSession: 5,
        ordersIdsProcessing: null,
        timeLimit: null,
        processInit: 1,
        jump: 1,
        howCall: null,
        lastID:null,
        elemAlert:null,
    };

    initVerifyNewOrdes( lastID, elem, elemAlert, ordersIdsProcessing ){

        if (typeof elemAlert === "undefined"){elemAlert = null;}

        this.c.lastID             = lastID;
        this.c.elemAlert          = elemAlert;
        this.c.howCall            = 'new-orders';
        obj.c.ordersIdsProcessing = ordersIdsProcessing;
        this.c.timeLimit          = 100;
        this.c.jump               = 2;
        this._initTemplateProgressBar(elem);
        this._startTimer();
    }

    initKeepSession(elem){
        this.c.howCall = 'keep-session';
        this.c.timeLimit = 100;
        this._initTemplateProgressBar(elem);
        this._startTimer();
    };

    initVerifyNewInPreparation( lastID, elem, elemAlert ){

        if (typeof elemAlert === "undefined"){elemAlert = null;}

        this.c.lastID    = lastID;
        this.c.elemAlert = elemAlert;
        this.c.howCall   = 'new-in-preparation';
        this.c.timeLimit = 100;
        this.c.jump      = 3;
        this._initTemplateProgressBar(elem);
        this._startTimer();
    }

    _initTemplateProgressBar(elem){

        elem.html('<div class="progress" style="height: 3px;">\n' +
            '           <div id="countdown" class="progress-bar progress-bar-striped bg-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:0%;"></div>\n' +
            '      </div>');

        this._renderTemplateProgressBar(this.c.processInit);

    };

    _renderTemplateProgressBar(sec){
        let counter = $('#countdown');
        counter.attr('aria-valuenow',sec);
        counter.attr('aria-valuemin',sec);
        counter.attr('aria-valuemax',sec);
        counter.css('width',sec+'%');
    }

    _startTimer(){
        let sec   = 0;
        let tmp   = 0;
        let scope = this;
        let i = setInterval(function(){
            tmp = ++sec * scope.c.secondsKeepSession * scope.c.jump;

            scope._renderTemplateProgressBar( tmp );

            if (tmp >= scope.c.timeLimit) {
                scope._finalize( i );
            }

        }, scope.c.secondsKeepSession * 1000 );
    };

    _finalize(elemInterval){
        switch ( this.c.howCall ) {
            case 'keep-session'      : this._ajaxKeepSession( elemInterval ); break;
            case 'new-orders'        : this._ajaxNewOrders( elemInterval ); break;
            case 'new-in-preparation': this._ajaxNewInPreparation( elemInterval ); break;
            default                  : clearInterval(elemInterval);
        }
    };

    _ajaxKeepSession(elemInterval){

        clearInterval(elemInterval);
        let scope = this;
        $.ajax({
            type: 'GET',
            timeout: 3000,
            url: "/api/keep-session",
            success: function (data, jqXHR) {
                scope._renderTemplateProgressBar(scope.c.processInit);
                scope._startTimer();
            },
            error: function (data, jqXHR) {
                toastr.error(data.responseJSON.messages, 'ATENÇÃO!', {
                    positionClass: 'toast-top-full-width',
                    timeOut: 0,
                    containerId: 'toast-top-full-width'
                });
                location.reload();
            }
        });

    };

    _ajaxNewOrders(elemInterval){

        clearInterval(elemInterval);
        let scope = this;
        $.ajax({
            type: 'GET',
            timeout: 3000,
            url: "/api/get/order@verify-new-orders/"+this.c.lastID,
            data: { ordersIdsProcessing: obj.c.ordersIdsProcessing },
            success: function (data, jqXHR) {

                if (typeof data.tt !== "undefined"){
                    if( data.tt > 0 ){
                        toastr.success('Existem ' + data.tt + ' novo(s) pedidos(s)! Recarregue a página para visualiza-los. <button style="margin-top: 10px" type="button" class="btn btn-info btn-min-width mr-1 mb-1 clear" onClick="window.location.href=window.location.href"><i class="la la-refresh"></i>Recarregar</button>', 'ATENÇÃO!', {
                            positionClass: 'toast-top-full-width',
                            timeOut: 5000,
                            progressBar: true,
                            containerId: 'toast-top-full-width'
                        });
                        if( scope.c.elemAlert !== null ){
                            scope.c.elemAlert.fadeIn(600);
                        }
                    } else if( data.change_orders_pending === true ){
                        toastr.success('Alguns pedidos EM PREPARO foram processados! Recarregue para atuaizar a pagina. <button style="margin-top: 10px" type="button" class="btn btn-info btn-min-width mr-1 mb-1 clear" onClick="window.location.href=window.location.href"><i class="la la-refresh"></i>Recarregar</button>', 'ATENÇÃO!', {
                            positionClass: 'toast-top-full-width',
                            timeOut: 5000,
                            progressBar: true,
                            containerId: 'toast-top-full-width'
                        });
                        if( scope.c.elemAlert !== null ){
                            $('.section-orders-change-processing').fadeIn(600);
                        }
                    }
                    scope._renderTemplateProgressBar(scope.c.processInit);
                    scope._startTimer();
                }
            },
            error: function (data, jqXHR) {
                toastr.error('Ocorreu um falha ao verificar novos pedidos', 'ATENÇÃO!', {
                    positionClass: 'toast-top-full-width',
                    timeOut: 0,
                    containerId: 'toast-top-full-width'
                });
                location.reload();
            }
        });

    };

    _ajaxNewInPreparation(elemInterval){

        clearInterval(elemInterval);
        let scope = this;
        $.ajax({
            type: 'GET',
            timeout: 3000,
            url: "/api/get/order@verify-new-items-preparation/"+this.c.lastID,
            success: function (data, jqXHR) {
                if (typeof data.tt !== "undefined"){
                    if( data.tt > 0 ){
                        toastr.success('Existem ' + data.tt + ' novo(s) item(ns)! Recarregue a página para visualiza-los. <button style="margin-top: 10px" type="button" class="btn btn-info btn-min-width mr-1 mb-1 clear" onClick="window.location.href=window.location.href"><i class="la la-refresh"></i>Recarregar</button>', 'ATENÇÃO!', {
                            positionClass: 'toast-top-full-width',
                            timeOut: 5000,
                            progressBar: true,
                            containerId: 'toast-top-full-width'
                        });
                        if( scope.c.elemAlert !== null ){
                            scope.c.elemAlert.fadeIn(600);
                        }
                        if( $('.swal2-container').length === 0 ) {
                            location.reload();
                        }
                    }
                    scope._renderTemplateProgressBar(scope.c.processInit);
                    scope._startTimer();
                }
            },
            error: function (data, jqXHR) {
                toastr.error('Ocorreu um falha ao verificar novos pedidos', 'ATENÇÃO!', {
                    positionClass: 'toast-top-full-width',
                    timeOut: 0,
                    containerId: 'toast-top-full-width'
                });
            }
        });

    };

}
