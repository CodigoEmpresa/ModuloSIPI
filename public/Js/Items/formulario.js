$(function()
{
    var item_seleccionado = 0;
    var insumo_seleccionado = 0;
    var url_item = $('#lista-item').data('url');
    var url_insumo = $('#lista-insumo').data('url');
    var utl_cotizaciones = $('#lista-cotizaciones').data('url');
    var no_se_encontraron_resultados = '';
    var no_se_encontraron_insumos = '';
    var no_se_encontraron_cotizaciones = '';

    function itemHtml(item, islock)
    {
        return '<li data-id="'+item.Id+'" class="item list-group-item '+(islock ? 'lock' : 'unlock')+'">'+
                    '<h5 data-islock="'+(islock ? 'lock' : 'unlock')+'" class="pointer"><i class="fa '+(islock ? 'fa-lock' : 'fa-unlock-alt')+'"></i> <span data-rel="Nombre">'+item.Nombre+'</span> (<span data-rel="Codigo">'+item.Codigo+'</span>)</h5>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<small>'+
                                '<strong>Unidad:</strong> <span data-rel="Unidad_De_Medida">'+item.Unidad_De_Medida+'</span>'+
                            '</small>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<br>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<a data-role="seleccionar" class="label label-primary">Seleccionar</a> '+
                            '<a data-role="editar" class="label label-default">Editar</a> '+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function insumoHtml(insumo, enitem)
    {
        return '<li data-id="'+insumo.Id+'" class="insumo list-group-item '+(enitem ? 'seleccionado' : '')+'">'+
                    '<h5><span data-rel="Nombre">'+insumo.Nombre+'</span> (<span data-rel="Codigo">'+insumo.Codigo+'</span>)</h5>'+
                    '<div class="row">'+
                        '<div class="col-md-6">'+
                            '<small>'+
                                '<strong>Unidad:</strong> <span data-rel="Unidad_De_Medida">'+insumo.Unidad_De_Medida+'</span>'+
                            '</small>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<small>'+
                                '<strong>Precio:</strong> $ <span data-rel="Precio">'+insumo.Precio+'</span>'+
                            '</small>'+
                        '</div>'+
                        (enitem ?
                            '<div class="col-md-6">'+
                                '<small>'+
                                    '<strong>Cantidad:</strong> <span data-rel="Cantidad">'+insumo.pivot.Cantidad+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<small>'+
                                    '<strong>Total:</strong> $ <span data-rel="Total">'+(+insumo.pivot.Cantidad * insumo.Precio)+'</span>'+
                                '</small>'+
                            '</div>'
                            :
                            ''
                        )+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            (enitem ? '<a data-role="remover" class="label label-primary">Remover</a> ' : '<a data-role="agregar" class="label label-primary">Agregar</a> ')+
                            '<a data-role="editar" class="label label-default">Editar</a>'+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function cotizacionHtml(cotizacion)
    {
        return '<li data-id="'+cotizacion.Id+'" class="cotizacion list-group-item '+(cotizacion.Precio_Oficial ? 'oficial' : '')+' seleccionado">'+
                    '<h5>'+(cotizacion.Precio_Oficial ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '')+' <span data-rel="Nombre">'+cotizacion.proveedor.Nombre+'</span></h5>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<small>'+
                                '<strong>Fecha actualización:</strong> <span data-rel="Fecha_Actualizacion">'+cotizacion.Fecha_Actualizacion+'</span>'+
                            '</small>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<small>'+
                                '<strong>Precio:</strong> $ <span data-rel="Precio">'+cotizacion.Precio+'</span>'+
                            '</small>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<a data-role="editar" class="label label-default">Editar</a>'+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function establecerItemSeleccionado(id)
    {
        $('#lista-item .item, #mantener-item .item').removeClass('seleccionado').find('a[data-role="seleccionar"]').text('Seleccionar');
        if(id !== 0)
        {
            $('#lista-item .item[data-id="'+id+'"], #mantener-item .item[data-id="'+id+'"]').addClass('seleccionado');
            $('#lista-item .item[data-id="'+id+'"], #mantener-item .item[data-id="'+id+'"]').find('a[data-role="seleccionar"]').text('Cancelar');
        }

        item_seleccionado = id;
        return item_seleccionado;
    }

    function obtenerItemSeleccionado()
    {
        return item_seleccionado;
    }

    function establecerInsumoSeleccionado(id)
    {
        insumo_seleccionado = id;
    }

    function obtenerInsumoSeleccionado()
    {
        return insumo_seleccionado;
    }

    function populateErrors(modal, errors)
    {
        var $div_errors = $(modal);
        var $form = $div_errors.closest('form');
        $form.find('.form-group').removeClass('has-error');
        $div_errors.find('ul').html('');

        $.each(errors, function(k, v)
        {
            $div_errors.find('ul').append('<li>'+v+'</li>');
            $form.find(' *[name="'+k+'"]').closest('.form-group').addClass('has-error');
        });

        $div_errors.show();
    }

    function populateModal(modal, item)
    {
        $.each(item, function(key, value)
        {
            if($(modal+' *[name="'+key+'"]').is(':radio'))
                $(modal+' *[name="'+key+'"][value="'+value+'"]').trigger('click');
            else if($(modal+' *[name="'+key+'"]').is('select'))
                $(modal+' *[name="'+key+'"]').selectpicker('val', value);
            else
                $(modal+' *[name="'+key+'"]').val(value);

        });

        $(modal).modal('show');
    }

    //buscador-items
    $('#buscar-item').on('click', function(e)
    {
        var matcher = $('input[name="buscador-items"]').val();

        $.get(
            $(this).data('url')+'/'+matcher,
            {},
            'json'
        )
        .done(function(data)
        {
            var html = '';
            var item_seleccionado = obtenerItemSeleccionado();

            if (item_seleccionado != 0)
            {
                html += $('.item.unlock[data-id="'+item_seleccionado+'"]').length ? $('.item.unlock[data-id="'+item_seleccionado+'"]').clone().wrap('<div>').parent().html() : '';
            }

            if (data.length)
            {
                $.each(data, function(i, e)
                {
                    if (!$('#mantener-item .item[data-id="'+e.Id+'"]').length && !$('.item.seleccionado[data-id="'+e.Id+'"]').length)
                        html += itemHtml(e, false);
                });
            } else {
                html += no_se_encontraron_resultados;
            }

            $('#lista-item').html(html);
        }).fail(function(xhr, status, error)
        {
            var html = no_se_encontraron_resultados;

            $('#lista-item').html(html);
        });
    });

    // modal-items
    $('#agregar-item').on('click', function(e)
    {
        var item = {
            Id: 0,
            Codigo: '',
            Unidad_De_Medida: '',
            Nombre: '',
            Descripcion: ''
        }

        populateModal('#modal-agregar-item', item);
        e.preventDefault();
    });

    $('#agregar-item-form').on('submit', function(e)
    {
        $.post(
            $(this).prop('action'),
            $(this).serialize(),
            'json'
        )
        .done(function(item)
        {
            var $div_errors = $('#modal-agregar-item').find('.errores');
            $div_errors.hide();

            var en_lista = !!$('#lista-item .item[data-id="'+item.Id+'"], #mantener-item .item[data-id="'+item.Id+'"]').length;

            if (en_lista)
            {
                var panel = $('.item[data-id="'+item.Id+'"]');
                panel.find('span[data-rel="Nombre"]').text(item.Nombre);
                panel.find('span[data-rel="Codigo"]').text(item.Codigo);
                panel.find('span[data-rel="Unidad_De_Medida"]').text(item.Unidad_De_Medida);
            } else {
                var panel = itemHtml(item);
                $('#lista-item').append(panel);
            }

            $('#modal-agregar-item').modal('hide');
        })
        .fail(function(xhr, status, error)
        {
            if(xhr.status == 422)
            {
                var errores = xhr.responseJSON;

                populateErrors('#modal-agregar-item .errores', errores);
            } else {
                alert(error);
            }
        });

        e.preventDefault();
    });

    // lista-items
    $('#lista-item, #mantener-item').delegate('a[data-role="editar"]', 'click', function(e)
    {
        var id = $(this).closest('.item').data('id');

        $.get(
            url_item+'/obtener/'+id,
            {},
            'json'
        ).done(function(data)
        {
            if (data)
            {
                populateModal('#modal-agregar-item', data);
            }
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });

        e.preventDefault();
    });

    $('#lista-item, #mantener-item').delegate('a[data-role="seleccionar"]', 'click', function(e)
    {
        var id = $(this).closest('.item').data('id');
        if(id == obtenerItemSeleccionado())
        {
            establecerItemSeleccionado(0);
        } else {
            establecerItemSeleccionado(id);
        }

        if(obtenerItemSeleccionado() != 0)
        {
            $.get(
                url_item+'/obtener/'+obtenerItemSeleccionado(),
                {},
                'json'
            ).done(function(data)
            {
                if (data)
                {
                    var html_insumos = '';
                    var html_cotizaciones = '';
                    if (data)
                    {
                        // popular lista de insumos
                        if (data.insumos.length)
                        {
                            $.each(data.insumos, function(i, insumo)
                            {
                                html_insumos += insumoHtml(insumo, true);
                                $('#lista-insumo .insumo[data-id="'+insumo.Id+'"]').remove();
                            });
                        } else {
                            html_insumos = no_se_encontraron_insumos;
                        }

                        if (data.cotizaciones.length)
                        {
                            $.each(data.cotizaciones, function(i, cotizacion)
                            {
                                html_cotizaciones += cotizacionHtml(cotizacion);
                            });
                        } else {
                            html_cotizaciones = no_se_encontraron_cotizaciones;
                        }

                        $('#mantener-insumo').html(html_insumos);
                        $('#lista-cotizaciones').html(html_cotizaciones);
                    }
                }
            }).fail(function(xhr, status, error)
            {
                var html_insumos = no_se_encontraron_insumos;

                $('#mantener-insumo').html(html_insumos);
            });
        } else {
            $('#mantener-insumo').html('');
            $('#lista-cotizaciones').html('');
        }

        $('#lista-insumo').html('');

        e.preventDefault();
    });

    $('#lista-item, #mantener-item').delegate('*[data-islock]', 'click', function(e)
    {
        var islock = $(this).attr('data-islock');
        var panel = $(this).closest('.item').clone(true);
        $(this).closest('.item').remove();

        if(islock == 'lock')
        {
            panel.removeClass('lock').addClass('unlock').find('h5').attr('data-islock', 'unlock').find('i').removeClass('fa-lock').addClass('fa-unlock-alt');
            $('#lista-item').find('.item[data-id="'+panel.data('id')+'"]').remove();
            $('#lista-item').prepend(panel);
        } else if(islock == 'unlock') {
            panel.removeClass('unlock').addClass('lock').find('h5').attr('data-islock', 'lock').find('i').removeClass('fa-unlock-alt').addClass('fa-lock');
            $('#mantener-item').find('.item[data-id="'+panel.data('id')+'"]').remove();
            $('#mantener-item').append(panel);
        }
    });

    // buscador-insumos
    $('#buscar-insumo').on('click', function(e)
    {
        var matcher = $('input[name="buscador-insumos"]').val();

        $.get(
            $(this).data('url')+'/'+matcher,
            {},
            'json'
        )
        .done(function(data)
        {
            var html = '';
            if (data.length)
            {
                $.each(data, function(i, e)
                {
                    if (!$('#mantener-insumo .insumo[data-id="'+e.Id+'"]').length && !$('.insumo.seleccionado[data-id="'+e.Id+'"]').length)
                        html += insumoHtml(e, false);
                });
            } else {
                html += no_se_encontraron_resultados;
            }

            $('#lista-insumo').html(html);
        }).fail(function(xhr, status, error)
        {
            var html = no_se_encontraron_resultados;

            $('#lista-insumo').html(html);
        });
    });

    // modal-insumos
    $('#agregar-insumo').on('click', function(e)
    {
        var insumo = {
            Id: 0,
            Codigo: '',
            Unidad_De_Medida: '',
            Nombre: '',
            Descripcion: '',
            Grupo: '',
            Precio: ''
        }

        populateModal('#modal-agregar-insumo', insumo);
        e.preventDefault();
    });

    $('#agregar-insumo-form').on('submit', function(e)
    {
        $.post(
            $(this).prop('action'),
            $(this).serialize(),
            'json'
        )
        .done(function(insumo)
        {
            var $div_errors = $('#modal-agregar-insumos').find('.errores');
            $div_errors.hide();

            var en_lista = !!$('#lista-insumo .insumo[data-id="'+insumo.Id+'"], #mantener-insumo .insumo[data-id="'+insumo.Id+'"]').length;

            if (en_lista)
            {
                var panel = $('.insumo[data-id="'+insumo.Id+'"]');
                panel.find('span[data-rel="Nombre"]').text(insumo.Nombre);
                panel.find('span[data-rel="Codigo"]').text(insumo.Codigo);
                panel.find('span[data-rel="Unidad_De_Medida"]').text(insumo.Unidad_De_Medida);
                panel.find('span[data-rel="Precio"]').text(insumo.Precio);

                if(panel.find('span[data-rel="Cantidad"]').length)
                {
                    panel.find('span[data-rel="Total"]').text(+panel.find('span[data-rel="Cantidad"]').text() * +panel.find('span[data-rel="Precio"]').text());
                }
            } else {
                var panel = insumoHtml(insumo, false);
                $('#lista-insumo').append(panel);
            }

            $('#modal-agregar-insumo').modal('hide');
        })
        .fail(function(xhr, status, error)
        {
            if(xhr.status == 422)
            {
                var errores = xhr.responseJSON;

                populateErrors('#modal-agregar-insumo .errores', errores);
            } else {
                alert(error);
            }
        });

        e.preventDefault();
    });

    // lista-insumos
    $('#lista-insumo, #mantener-insumo').delegate('a[data-role="editar"]', 'click', function(e)
    {
        var id = $(this).closest('.insumo').data('id');

        $.get(
            url_insumo+'/obtener/'+id,
            {},
            'json'
        ).done(function(data)
        {
            if (data)
            {
                populateModal('#modal-agregar-insumo', data);
            }
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });

        e.preventDefault();
    });

    $('#lista-insumo').delegate('a[data-role="agregar"]', 'click', function(e)
    {
        var id = $(this).closest('.insumo').data('id');
        establecerInsumoSeleccionado(id);

        if(obtenerItemSeleccionado() == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un APU para agregar el insumo',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });
        } else {
            bootbox.prompt({
                title: 'Cantidad',
                inputType: 'number',
                buttons: {
                    cancel: {
                        label: 'Volver',
                        className: 'btn-default'
                    },
                    confirm: {
                        label: 'Agregar',
                        className: 'btn-primary'
                    }
                },
                callback: function(result)
                {
                    if(result != null)
                    {
                        if(isNaN(+result))
                            result = 0;
                        $.post(
                            url_item+'/agregar_insumo',
                            {
                                item: obtenerItemSeleccionado(),
                                insumo: obtenerInsumoSeleccionado(),
                                cantidad: result
                            },
                            'json'
                        ).done(function(data)
                        {
                            if (data)
                            {
                                var html_insumos = '';
                                if (data)
                                {
                                    // popular lista de insumos
                                    if (data.insumos.length)
                                    {
                                        $.each(data.insumos, function(i, insumo)
                                        {
                                            html_insumos += insumoHtml(insumo, true);
                                        });

                                        $('#lista-insumo .insumo[data-id="'+obtenerInsumoSeleccionado()+'"]').remove();
                                        establecerInsumoSeleccionado(0);
                                    }

                                    $('#mantener-insumo').html(html_insumos);
                                }
                            }
                        }).fail(function(xhr, status, error)
                        {
                            alert(error);
                        });
                    }
                }
            });
        }
    });

    $('#lista-insumo, #mantener-insumo').delegate('a[data-role="remover"]', 'click', function(e)
    {
        var id = $(this).closest('.insumo').data('id');

        $.post(
            url_item+'/remover_insumo',
            {
                item: obtenerItemSeleccionado(),
                insumo: id
            },
            'json'
        ).done(function(data)
        {
            $('#mantener-insumo .insumo[data-id="'+id+'"]').remove();
            var panel = insumoHtml(data, false);
            $('#lista-insumo').append(panel);
        }).fail(function(xhr, status, error)
        {
            alert(error);
        });
    });

    // modal-cotizacion
    $('#agregar-cotizacion').on('click', function(e)
    {
        var item = {
            Id: 0,
            Id_Item: obtenerItemSeleccionado(),
            Id_Proveedor: '',
            Precio: '',
            Precio_Oficial: '0',
            Precio_Calculo: '',
            Fecha_Actualizacion: ''
        }

        if(obtenerItemSeleccionado() == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un APU para agregar una cotización',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });
        } else {
            populateModal('#modal-agregar-cotizacion', item);
        }

        e.preventDefault();
    });

    $('#agregar-proveedor').on('click', function(e)
    {
        $('#agregar-proveedor-form').show();
    });

    $('#cancelar-proveedor').on('click', function(e)
    {
        $('#agregar-proveedor-form').hide();
    });

    $('#agregar-proveedor-form').on('submit', function(e)
    {
        $.post(
            $(this).prop('action'),
            $(this).serialize(),
            'json'
        ).done(function(proveedor)
        {
            if(proveedor)
            {
                $('#agregar-proveedor-form').find('input').val('');
                $('select[name="Id_Proveedor"]').append('<option value="'+proveedor.Id+'">'+proveedor.Nombre+'</option>');
                $('select[name="Id_Proveedor"]').selectpicker('refresh');
                $('#agregar-proveedor-form').hide();
            }
        }).fail(function(xhr, status, error)
        {
            if(xhr.status == 422)
            {
                var errores = xhr.responseJSON;

                populateErrors('#agregar-proveedor-form .errores', errores);
            } else {
                alert(error);
            }
        });

        e.preventDefault();
    });

    $('#agregar-cotizacion-form').on('submit', function(e)
    {
        $.post(
            $(this).prop('action'),
            $(this).serialize(),
            'json'
        ).done(function(cotizacion)
        {
            if (cotizacion)
            {
                var $div_errors = $('#modal-agregar-cotizacion').find('.errores');
                $div_errors.hide();

                var en_lista = !!$('#lista-cotizaciones .cotizacion[data-id="'+cotizacion.Id+'"]').length;
                var oficial = $('#lista-cotizaciones .cotizacion.oficial');

                if (oficial)
                {
                    var id = oficial.attr('data-id');
                    if (cotizacion.Precio_Oficial == '1' && id != cotizacion.Id)
                    {
                        $('#lista-cotizaciones .cotizacion').removeClass('oficial');
                        $('#lista-cotizaciones h5 i').remove();
                    }
                }

                if (en_lista)
                {
                    var panel = $('#lista-cotizaciones').find('.cotizacion[data-id="'+cotizacion.Id+'"]');
                    if (cotizacion.Precio_Oficial == '1')
                        panel.addClass("oficial");

                    panel.find('h5').html((cotizacion.Precio_Oficial == '1' ? '<i class="fa fa-star" aria-hidden="true"></i>' : '')+' <span data-rel="Nombre">'+cotizacion.proveedor.Nombre+'</span>');
                    panel.find('span[data-rel="Fecha_Actualizacion"]').text(cotizacion.Fecha_Actualizacion);
                    panel.find('span[data-rel="Precio"]').text(cotizacion.Precio);
                } else {
                    var panel = cotizacionHtml(cotizacion);
                    $('#lista-cotizaciones').append(panel);
                }

                $('#modal-agregar-cotizacion').modal('hide');
            }
        }).fail(function(xhr, status, error)
        {
            if(xhr.status == 422)
            {
                var errores = xhr.responseJSON;

                populateErrors('#agregar-cotizacion-form .errores', errores);
            } else {
                alert(error);
            }
        });

        e.preventDefault();
    });

    $('#lista-cotizaciones').delegate('a[data-role="editar"]', 'click', function(e)
    {
        var id = $(this).closest('.cotizacion').data('id');

        $.get(
            utl_cotizaciones+'/obtener/'+id,
            {},
            'json'
        ).done(function(data)
        {
            if (data)
            {
                populateModal('#modal-agregar-cotizacion', data);
            }
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });

        e.preventDefault();
    });
});
