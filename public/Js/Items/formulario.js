$(function()
{
    var item_seleccionado = 0;
    var insumo_seleccionado = 0;
    var url_item = $('#lista-item').data('url');
    var url_insumo = $('#lista-insumo').data('url');
    var url_proveedores = $('#lista-cotizaciones').data('url');
    var url_assets = $('#lista-insumo').data('url-assets');
    var no_se_encontraron_resultados = '';
    var no_se_encontraron_insumos = '';
    var no_se_encontraron_cotizaciones = '';

    function itemHtml(item)
    {
        return '<li data-id="'+item.Id+'" class="item list-group-item">'+
                    '<h5><span data-rel="Codigo">'+(item.Id.pad(4))+'</span> | <span data-rel="Nombre">'+item.Nombre+'</span></h5>'+
                    '<div class="list-group-item-text">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Descripción:</strong> <span data-rel="Descripcion">'+(item.Descripcion ? item.Descripcion : 'Sin descripción')+'</span>'+
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

    function cotizacionHtml(proveedor)
    {
        return '<li data-id="'+proveedor.Id+'" class="cotizacion seleccionado list-group-item">'+
                    '<h5><span data-rel="Nombre">'+proveedor.Nombre+'</span></h5>'+
                    '<div class="list-group-item-text">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<small>'+
                                    '<strong>Email:</strong> <span data-rel="Email">'+proveedor.Email+'</span>'+
                                    '<br>'+
                                    '<strong>Teléfono:</strong> <span data-rel="Telefono">'+proveedor.Telefono+'</span>'+
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
                                '<a data-role="remover" class="label label-danger">Remover</a>'+
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
        if($(container).find('form').length > 0)
            $(container).find('form')[0].reset();
        else if ($(container).is('form'))
            $(container)[0].reset();


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

                if (item_seleccionado !== 0)
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

    // formulario-items
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
                message: 'Debe seleccionar una categoría para agregar un insumo',
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

    // formulario-insumos
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
                    // popular lista de cotizaciones
                    if (data.proveedores.length)
                    {
                        $.each(data.proveedores, function(i, proveedor)
                        {
                            html_cotizaciones += cotizacionHtml(proveedor);
                            $('#lista-cotizaciones .cotizaciones[data-id="'+proveedor.Id+'"]').remove();
                        });
                    } else {
                        html_cotizaciones = no_se_encontraron_cotizaciones;
                    }

                    $('#lista-cotizaciones').html(html_cotizaciones);
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
        $('#agregar-proveedor-form').hide();

        var item = {
            Id: 0,
            Id_Insumo: obtenerInsumoSeleccionado(),
            Id_Proveedor: ''
        }

        if(obtenerInsumoSeleccionado() == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un insumo para agregar un proveedor',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });
        } else {
            $.post(
                $('select[name="Id_Proveedor"]').data('url'),
                {
                    Id_Insumo: obtenerInsumoSeleccionado()
                },
                'json'
            ).done(function(proveedores) {
                $('select[name="Id_Proveedor"]').html('');
                $('select[name="Id_Proveedor"]').prop('title', 'Seleccionar');

                if (proveedores.length) {
                    var html_proveedores = '';
                    $.each(proveedores, function(i, proveedor) {
                        html_proveedores += '<option value="'+proveedor.Id+'">'+proveedor.Nombre+'</option>';
                    });

                    $('select[name="Id_Proveedor"]').html(html_proveedores);
                } else {
                    $('select[name="Id_Proveedor"]').prop('title', 'No se encontraron proveedores para esta categoría');
                }

                $('select[name="Id_Proveedor"]').selectpicker('refresh');

                populateModal('#modal-agregar-cotizacion', item);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                bootbox.alert({
                    title: 'Error',
                    message: 'No se pudo cargar los proveedores verifique su conexión a internet o comuníquese con el desarrollador <br> Codigo: '+textStatus,
                    buttons: {
                        ok: {
                            label: 'Volver',
                            className: 'btn-default'
                        }
                    }
                });
            });
        }

        e.preventDefault();
    });

    $('#agregar-proveedor').on('click', function(e)
    {
        var data = {
            'Id': 0,
            'Id_Item': obtenerItemSeleccionado(),
            'Nombre': '',
            'Ciudad': '',
            'Nombre_Contacto':'',
            'Direccion': '',
            'Telefono': '',
            'Email': ''
        }

        populateForm('#agregar-proveedor-form', data);
        $('#agregar-proveedor-form').show();
    });

    $('#editar-proveedor').on('click', function(e)
    {
        var Id_Proveedor = $('select[name="Id_Proveedor"]').selectpicker('val');

        if (Id_Proveedor)
        {
            $.get(
                $(this).data('url')+'/'+Id_Proveedor,
                {},
                'json'
            ).done(function(data)
            {
                populateForm('#agregar-proveedor-form', data);
                $('#agregar-proveedor-form').show();
            });
        }

        e.preventDefault();
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
                $('select[name="Id_Proveedor"] option[value="'+proveedor.Id+'"]').remove();

                $('select[name="Id_Proveedor"]').append('<option value="'+proveedor.Id+'">'+proveedor.Nombre+'</option>');
                $('select[name="Id_Proveedor"]').selectpicker('refresh');
                $('select[name="Id_Proveedor"]').selectpicker('val', proveedor.Id);
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
        ).done(function(proveedor)
        {
            if (proveedor)
            {
                var $div_errors = $('#modal-agregar-cotizacion').find('.errores');
                $div_errors.hide();

                var en_lista = !!$('#lista-cotizaciones .cotizacion[data-id="'+proveedor.Id+'"]').length;

                if (en_lista)
                {
                    var panel = $('#lista-cotizaciones').find('.cotizacion[data-id="'+proveedor.Id+'"]');
                    panel.find('span[data-rel="Nombre"]').text(proveedor.Nombre);
                    panel.find('span[data-rel="Email"]').text(proveedor.Email);
                    panel.find('span[data-rel="Telefono"]').text(proveedor.Telefono);
                } else {
                    var panel = cotizacionHtml(proveedor);
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

    $('#lista-cotizaciones').delegate('a[data-role="remover"]', 'click', function(e)
    {
        var _this = $(this);
        $.post(
            url_proveedores+'/remover',
            {
                Id_Insumo: obtenerInsumoSeleccionado(),
                Id_Proveedor: $(this).closest('.cotizacion').data('id')
            },
            'json'
        ).done(function(data)
        {
            if (data) {
                _this.closest('.cotizacion').remove();
            }
        }).fail(function(xhr, status, error)
        {       
            bootbox.alert({
                title: 'Error',
                message: 'No se pudo realizar la operación verifique su conexión a internet o comuníquese con el desarrollador <br> Codigo: '+status,
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
});
