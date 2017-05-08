$(function()
{
    var item_seleccionado = 0;
    var insumo_seleccionado = 0;
    var url_item = $('#lista-item').data('url');
    var url_insumo = $('#lista-insumo').data('url');
    var utl_cotizaciones = $('#lista-cotizaciones').data('url');
    var url_assets = $('#lista-insumo').data('url-assets');
    var no_se_encontraron_resultados = '';
    var no_se_encontraron_insumos = '';
    var no_se_encontraron_cotizaciones = '';

    function itemHtml(item)
    {
        return '<li data-id="'+item.Id+'" class="item list-group-item">'+
                    '<h5><span data-rel="Codigo">'+item.Id.pad(4)+'</span> | <span data-rel="Nombre">'+item.Nombre+'</span></h5>'+
                    '<div class="list-group-item-text">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Descripcion:</strong> <span data-rel="Descripcion">'+(item.Descripcion ? item.Descripcion : 'Sin descripción')+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<br>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="list-group-item-footer">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<a data-role="seleccionar" class="label label-primary">Seleccionar</a> '+
                                '<a data-role="editar" class="label label-default">Editar</a> '+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function insumoHtml(insumo)
    {
        return '<li data-id="'+insumo.Id+'" class="insumo list-group-item">'+
                    '<h5><span data-rel="Codigo">'+insumo.Id_Item.pad(4)+'-'+insumo.Id+'</span> | <span data-rel="Nombre">'+insumo.Nombre+'</span></h5>'+
                    '<div class="list-group-item-text">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<a data-toggle="image" data-rel="Foto_1" href="'+url_assets+'/'+(insumo.Foto_1 ? insumo.Foto_1 : 'default.jpg')+'" class="pull-left"><img height="20px"; src="'+url_assets+'/'+(insumo.Foto_1 ? insumo.Foto_1 : 'default.jpg')+'" alt="" /></a>'+
                                '<a data-toggle="image" data-rel="Foto_2" href="'+url_assets+'/'+(insumo.Foto_2 ? insumo.Foto_2 : 'default.jpg')+'" class="insumo-img pull-left"><img height="20px"; src="'+url_assets+'/'+(insumo.Foto_2 ? insumo.Foto_2 : 'default.jpg')+'" alt="" /></a>'+
                                '<a data-toggle="image" data-rel="Foto_3" href="'+url_assets+'/'+(insumo.Foto_3 ? insumo.Foto_3 : 'default.jpg')+'" class="insumo-img pull-left"><img height="20px"; src="'+url_assets+'/'+(insumo.Foto_3 ? insumo.Foto_3 : 'default.jpg')+'" alt="" /></a>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Unidad:</strong> <span data-rel="Unidad_De_Medida">'+insumo.Unidad_De_Medida+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Descripción:</strong> <span data-rel="Descripcion">'+(insumo.Descripcion ? insumo.Descripcion : 'Sin descripción')+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Precio oficial:</strong> <span data-rel="Precio_Oficial">'+(insumo.Precio_Oficial ? insumo.Precio_Oficial : 'Sin determinar')+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Calculo precio oficial:</strong> <span data-rel="Precio_Oficial_Calculo">'+(insumo.Precio_Oficial_Calculo ? insumo.Precio_Oficial_Calculo : 'Sin determinar')+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<br>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="list-group-item-footer">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<a data-role="seleccionar" class="label label-primary">Seleccionar</a> '+
                                '<a data-role="editar" class="label label-default">Editar</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function cotizacionHtml(cotizacion)
    {
        return '<li data-id="'+cotizacion.Id+'" class="cotizacion seleccionado list-group-item">'+
                    '<h5><span data-rel="Nombre">'+cotizacion.proveedor.Nombre+'</span></h5>'+
                    '<div class="list-group-item-text">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Fecha actualización:</strong> <span data-rel="Fecha_Actualizacion">'+cotizacion.Fecha_Actualizacion+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Precio:</strong> <span data-rel="Precio">'+cotizacion.Precio+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Observaciones:</strong> <span data-rel="Observaciones">'+(cotizacion.Observaciones ? cotizacion.Observaciones : 'Sin observaciones')+'</span>'+
                                '</small>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                                '<br>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="list-group-item-footer">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<a data-role="editar" class="label label-default">Editar</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</li>';
    }

    function establecerItemSeleccionado(id)
    {
        $('#lista-item .item').removeClass('seleccionado').find('a[data-role="seleccionar"]').text('Seleccionar');
        if(id !== 0)
        {
            $('#lista-item .item[data-id="'+id+'"]').addClass('seleccionado');
            $('#lista-item .item[data-id="'+id+'"]').find('a[data-role="seleccionar"]').text('Cancelar');
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
        $('#lista-insumo .insumo').removeClass('seleccionado').find('a[data-role="seleccionar"]').text('Seleccionar');
        if(id !== 0)
        {
            $('#lista-insumo .insumo[data-id="'+id+'"]').addClass('seleccionado');
            $('#lista-insumo .insumo[data-id="'+id+'"]').find('a[data-role="seleccionar"]').text('Cancelar');
        }

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

    function populateForm(container, item)
    {
        if($(container).find('form'))
            $(container).find('form')[0].reset();

        $.each(item, function(key, value)
        {
            value = value ? value : '';
            if($(container+' *[name="'+key+'"]').is(':radio'))
                $(container+' *[name="'+key+'"][value="'+value+'"]').trigger('click');
            else if($(container+' *[name="'+key+'"]').is('select'))
                $(container+' *[name="'+key+'"]').selectpicker('val', value);
            else if($(container+' *[name="'+key+'"]').is('p'))
                $(container+' *[name="'+key+'"]').text(value);
            else if($(container+' *[name="'+key+'"]').is('img'))
                $(container+' *[name="'+key+'"]').attr('src', $(container+' *[name="'+key+'"]').data('url')+'/'+value);
            else if($(container+' *[name="'+key+'"]').is('input[type="file"]'))
                $(container+' *[name="'+key+'"]').val('');
            else
                $(container+' *[name="'+key+'"]').val(value);
        });
    }

    function populateModal(modal, item)
    {
        populateForm(modal, item);

        $(modal).modal('show');
    }

    //buscador-items
    $('#buscar-item').on('click', function(e)
    {
        var matcher = $('input[name="buscador-items"]').val();

        if(matcher.length > 0)
        {
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
                    html += $('.item[data-id="'+item_seleccionado+'"]').length ? $('.item[data-id="'+item_seleccionado+'"]').clone().wrap('<div>').parent().html() : '';
                }

                if (data.length)
                {
                    $.each(data, function(i, e)
                    {
                        if (!$('.item.seleccionado[data-id="'+e.Id+'"]').length)
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
        }
    });

    // modal-items
    $('#agregar-item').on('click', function(e)
    {
        var item = {
            Id: 0,
            Codigo: 'Automático',
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

            var en_lista = !!$('#lista-item .item[data-id="'+item.Id+'"]').length;

            if (en_lista)
            {
                var panel = $('.item[data-id="'+item.Id+'"]');
                panel.find('span[data-rel="Codigo"]').text(item.Id.pad(4));
                panel.find('span[data-rel="Nombre"]').text(item.Nombre);
                panel.find('span[data-rel="Descripcion"]').text(item.Descripcion ? item.Descripcion : 'Sin descripción');
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
    $('#lista-item').delegate('a[data-role="editar"]', 'click', function(e)
    {
        var id = $(this).closest('.item').data('id');

        $.get(
            url_item+'/obtener/'+id,
            {},
            'json'
        ).done(function(item)
        {
            if (item)
            {
                item.Codigo = item.Id.pad(4);
                populateModal('#modal-agregar-item', item);
            }
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });

        e.preventDefault();
    });

    $('#lista-item').delegate('a[data-role="seleccionar"]', 'click', function(e)
    {
        var id = $(this).closest('.item').data('id');
        if (id == obtenerItemSeleccionado())
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

                        $('#lista-insumo').html(html_insumos);
                    }
                }
            }).fail(function(xhr, status, error)
            {
                var html_insumos = no_se_encontraron_insumos;
                $('#lista-insumo').html(html_insumos);
            });
        } else {
            $('#lista-insumo').html('');
        }

        $('#lista-cotizaciones').html('');
        $('#precio-oficial').hide();

        e.preventDefault();
    });

    // modal-insumos
    $('#agregar-insumo').on('click', function(e)
    {
        var insumo = {
            Id: 0,
            Id_Item: obtenerItemSeleccionado(),
            Codigo: 'Automático',
            Unidad_De_Medida: '',
            Nombre: '',
            Descripcion: '',
            Foto_1: 'default.jpg',
            Foto_2: 'default.jpg',
            Foto_3: 'default.jpg',
            Precio_Oficial: 'Sin determinar',
            Precio_Oficial_Calculo: 'Sin determinar',
        }

        if(obtenerItemSeleccionado() == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un item para agregar un insumo',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });
        } else {
            populateModal('#modal-agregar-insumo', insumo);
        }
        e.preventDefault();
    });

    $('#agregar-insumo-form').on('submit', function(e)
    {
        var data = new FormData(this);

        $.ajax({
            url: $(this).prop('action'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'json'
        })
        .done(function(insumo)
        {
            var $div_errors = $('#modal-agregar-insumos').find('.errores');
            $div_errors.hide();
            insumo.Id_Item = +insumo.Id_Item;

            var en_lista = !!$('#lista-insumo .insumo[data-id="'+insumo.Id+'"], #mantener-insumo .insumo[data-id="'+insumo.Id+'"]').length;

            if (en_lista)
            {
                var panel = $('.insumo[data-id="'+insumo.Id+'"]');
                panel.find('span[data-rel="Nombre"]').text(insumo.Nombre);
                panel.find('span[data-rel="Descripcion"]').text(insumo.Descripcion);
                panel.find('span[data-rel="Unidad_De_Medida"]').text(insumo.Unidad_De_Medida);
                panel.find('span[data-rel="Precio_Oficial"]').text(insumo.Precio_Oficial);
                panel.find('span[data-rel="Precio_Oficial_Calculo"]').text(insumo.Precio_Oficial_Calculo);
                panel.find('a[data-rel="Foto_1"]').attr('href', url_assets+'/'+(insumo.Foto_1 ? insumo.Foto_1 : 'default.jpg')).find('img').attr('src', url_assets+'/'+(insumo.Foto_1 ? insumo.Foto_1 : 'default.jpg'));
                panel.find('a[data-rel="Foto_2"]').attr('href', url_assets+'/'+(insumo.Foto_2 ? insumo.Foto_2 : 'default.jpg')).find('img').attr('src', url_assets+'/'+(insumo.Foto_2 ? insumo.Foto_2 : 'default.jpg'));
                panel.find('a[data-rel="Foto_3"]').attr('href', url_assets+'/'+(insumo.Foto_3 ? insumo.Foto_3 : 'default.jpg')).find('img').attr('src', url_assets+'/'+(insumo.Foto_3 ? insumo.Foto_3 : 'default.jpg'));
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
    $('#lista-insumo').delegate('a[data-role="editar"]', 'click', function(e)
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
                data.Codigo = data.Id_Item.pad(4)+'-'+data.Id;
                data.Precio_Oficial = data.Precio_Oficial ? data.Precio_Oficial : 'Sin determinar';
                data.Precio_Oficial_Calculo = data.Precio_Oficial_Calculo ? data.Precio_Oficial_Calculo : 'Sin determinar';
                data.Foto_1 = data.Foto_1 ? data.Foto_1 : 'default.jpg';
                data.Foto_2 = data.Foto_2 ? data.Foto_2 : 'default.jpg';
                data.Foto_3 = data.Foto_3 ? data.Foto_3 : 'default.jpg';

                populateModal('#modal-agregar-insumo', data);
            }
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });

        e.preventDefault();
    });

    $('#lista-insumo').delegate('a[data-role="seleccionar"]', 'click', function(e)
    {
        var id = $(this).closest('.insumo').data('id');

        if(id == obtenerInsumoSeleccionado())
        {
            establecerInsumoSeleccionado(0);
        } else {
            establecerInsumoSeleccionado(id);
        }

        if(obtenerInsumoSeleccionado() != 0)
        {
            $.get(
                url_insumo+'/obtener/'+obtenerInsumoSeleccionado(),
                {},
                'json'
            ).done(function(data)
            {
                if (data)
                {
                    var html_cotizaciones = '';
                    if (data)
                    {
                        // popular lista de cotizaciones
                        if (data.cotizaciones.length)
                        {
                            $.each(data.cotizaciones, function(i, cotizacion)
                            {
                                html_cotizaciones += cotizacionHtml(cotizacion, true);
                                $('#lista-cotizaciones .cotizaciones[data-id="'+cotizacion.Id+'"]').remove();
                            });
                        } else {
                            html_cotizaciones = no_se_encontraron_cotizaciones;
                        }

                        $('#lista-cotizaciones').html(html_cotizaciones);
                        $('#precio-oficial').find('input[name="Precio_Oficial"]').val(data.Precio_Oficial);
                        $('#precio-oficial').find('textarea[name="Precio_Oficial_Calculo"]').val(data.Precio_Oficial_Calculo);
                        $('#precio-oficial').find('input[name="Id"]').val(data.Id);
                        $('#precio-oficial').show();
                    }
                }
            }).fail(function(xhr, status, error)
            {
                var html_cotizaciones = no_se_encontraron_cotizaciones;
                $('#lista-cotizaciones').html(html_cotizaciones);
            });
        } else {
            $('#lista-cotizaciones').html('');
            $('#precio-oficial').hide();
        }

        e.preventDefault();
    });

    // modal-cotizacion
    $('#agregar-cotizacion').on('click', function(e)
    {
        var item = {
            Id: 0,
            Id_Insumo: obtenerInsumoSeleccionado(),
            Id_Proveedor: '',
            Precio: '',
            Observaciones: '',
            Fecha_Actualizacion: ''
        }

        if(obtenerInsumoSeleccionado() == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un insumo para agregar una cotización',
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

                if (en_lista)
                {
                    var panel = $('#lista-cotizaciones').find('.cotizacion[data-id="'+cotizacion.Id+'"]');
                    panel.find('span[data-rel="Nombre"]').text(cotizacion.proveedor.Nombre);
                    panel.find('span[data-rel="Fecha_Actualizacion"]').text(cotizacion.Fecha_Actualizacion);
                    panel.find('span[data-rel="Observaciones"]').text(cotizacion.Observaciones ? cotizacion.Observaciones : 'Sin observaciones');
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

    $('#precio-oficial-form').on('submit', function(e)
    {
        $.post(
            $(this).prop('action'),
            $(this).serialize(),
            'json'
        ).done(function(insumo)
        {
            var panel = $('.insumo[data-id="'+insumo.Id+'"]');
            panel.find('span[data-rel="Precio_Oficial"]').text(insumo.Precio_Oficial);
            panel.find('span[data-rel="Precio_Oficial_Calculo"]').text(insumo.Precio_Oficial_Calculo);

            bootbox.alert({
                title: 'Mensaje',
                message: 'El precio oficial ha sido actualizado satisfactoriamente',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });
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
