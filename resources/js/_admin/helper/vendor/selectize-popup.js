$('div.white-popup .selectize').each(function (i, el) {
    const desc_escape = false/*$(el).data('escape') === undefined || $(el).data('escape') === true*/;
    const maxItens = $(el).data('maxitens');
    let create = $(el).data('create');
    const create_url = $(el).data('create_url');
    const create_load = $(el).data('create_load');
    const close = $(el).data('close');
    const length = $(el).data('length') ?? 3;
    const action_no_result = $(el).data('action-no-result');
    const value_field = $(el).data('value-field');


    if (create) {
        create = function (input, callback) {
            callback({id: input, name: input});
        }
    } else if (create_url) {
        create = function (input, callback) {
            $.ajax({
                url: create_url,
                type: 'POST',
                data: {'name': input},
                success: function (result) {
                    /*new PNotify({
                        title: 'Sucesso',
                        text: 'Area de atuação criada com Sucesso',
                        type: 'success'
                    });*/
                    if (result) {//
                        callback({id: result.id, name: input});
                    }
                },
                error: function (result) {

                    new PNotify({
                        title: 'Error',
                        text: result.responseJSON.message,
                        type: 'error'
                    });

                    callback({id: null, name: null});

                }
            });
        }
    } else if(create_load) {
        create = function (input, callback) {
            $.ajax({
                type: "GET",
                url: create_load,
                data: {'name': input},
                success: function(data){ssele
                    $.magnificPopup.open({
                        type: 'inline',
                        closeOnBgClick:false,
                        items: {
                            src: data
                        }
                    })
                }
            });
            callback({id: null, name: null});
        }
    }

    $(el).selectize({
        maxItems: maxItens ? maxItens : 1,
        closeAfterSelect: close ?? true,
        valueField: value_field ?? 'id',
        labelField: 'name',
        searchField: ['name','description','name2'],
        /* create:function (input, callback){
             callback({ id: 1, name: 'Teste' });
         },*/
        create: create,
        createOnBlur: true,
        delimiter: '|',
        load: function (query, callback) {

            if (action_no_result && this.currentResults.items.length) {
                // alert('nao load '+this.currentResults.items.length);
                return callback();
            }


            if (!query.length || query.length < length) return callback();
            const action = this.$input.data('action');
            if (action) {
                $.ajax({
                    url: action.replace('%id', encodeURIComponent(query)),
                    type: 'GET',
                    error: function (e) {
                        callback();
                    },
                    success: function (res) {
                        callback(res/*.repositories.slice(0, 10)*/);
                    }
                });
            }
        },
        render: {
            option_create: function (data, escape) {
                return '<div class="create">Criar <strong>' + escape(data.input) + '</strong>&hellip;</div>';
            },
            option: function (item, escape) {
                if (item.description) {
                    return '<div class="option selectize-item-custom">'
                        + (item.icon ? '<span class="selectize-item-custom-icon" ><i class="' + item.icon + '" aria-hidden="true" style="color: ' + escape(item.background_color ? item.background_color : item.color) + ';"></i></span> ' : '')
                        + (item.name ? '<span class="selectize-item-custom-name">' + escape(item.name) + '</span>' : '')
                        + (item.description ? '<span class="selectize-item-custom-description">' + (desc_escape ? escape(item.description) : item.description)  + '</span>' : '')
                        + '</div>';
                } else {
                    return '<div class="option">'
                        + (item.icon ? '<span><i class="' + item.icon + '" aria-hidden="true" style="color: ' + escape(item.background_color ? item.background_color : item.color) + ';"></i></span> ' : '')
                        + (item.name ? '<span>' + escape(item.name) + '</span>' : '')
                        + '</div>';
                }


            }
        },
        /*render: {
            item: function(item, escape) {
                return "<div><img src='' class='flag flag-" + escape(item.code) + "' alt='flag' />&nbsp;" + escape(item.name) + "</div>";
            },
            option: function(item, escape) {
                return "<div><img src='' class='flag flag-" + escape(item.code) + "' alt='flag' />&nbsp;" + escape(item.name) + "</div>";
            }
        },*/
        onInitialize: function () {
            let self;
            let opts = this.$input.data('options');

            if (opts) {
                self = this;
                if (Array.isArray(opts)) {

                    opts.forEach(function (opt) {


                        // alert(JSON.stringify(opt));
                        self.addOption(opt);
                    });
                } else {
                    self.addOption(opts);
                }
            }

            opts = this.$input.data('value');
            if (opts) {
                self = this;
                if (Array.isArray(opts)) {
                    opts.forEach(function (opts) {
                        self.addItem(opts);
                    });
                } else {
                    self.addItem(opts);
                }
            }
        }
    });
});

