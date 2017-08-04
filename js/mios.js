function notificar(tipo, mensaje, tiempo) {
    tiempo = tiempo || 3500;

    $.notify({
        message: mensaje,
        url: ''
    }, {
        element: 'body',
        type: tipo,
        allow_dismiss: true,
        offset: {
            x: 20,
            y: 20
        },
        spacing: 10,
        z_index: 1031,
        newest_on_top: true,
        delay: 3500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: true,
        template: '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">Cerrar</button>' +
            '</div>'
    });
}

function GuardaSkin(form) {
    var postInfo = JSON.stringify(form);
    $.post( "scripts/GuardaSkin.php", postInfo) .done(function( data ) {
        resp = JSON.parse(data);
        switch (resp.Codigo) {
        case 10: //Error MySQL
            notificar('danger', resp.Mensaje);
            break;
        }
    });
}