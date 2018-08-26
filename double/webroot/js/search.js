$(document).ready(function () {
    function removeElements() {
        $('#customer_error').remove();
        $('#status_error').remove();
        $('#search_error').remove();
        $('.contact-table').remove();
        $('.print-button').remove();
    }

    $('#send').click(function () {
        removeElements();

        $('#reset').click(function () {
            removeElements();
        });

        $.ajax({
            url: '/records/search',
            type: 'POST',
            dataType: 'json',
            data: $('#search').serialize(),
            success: function (response) {

                if (response.customer_error) {
                    $('#customer').after('<small class="d-block text-danger" id="customer_error" style="margin-top: 10px">' + response.customer_error + '</small>');
                }
                if (response.status_error) {
                    $('#search > :last-child').prev().after('<small class="d-block text-danger" id="status_error" style="margin-top: 10px">' + response.status_error + '</small>');
                }
                if (response.search_error) {
                    $('#search > :last-child').after('<p class="h3 text-danger" id="search_error" style="margin-top: 30px">' + response.search_error + '</p>');
                }

                if (!response.customer_error && !response.status_error && !response.search_error && response.length > 0) {
                    response.forEach(function (element, index) {
                        var titleService = '';
                        element.title_service.forEach(function (element) {
                            titleService += element + '<br>';
                        });

                        $('div.h4').after(
                            '<div class="container contact-table" id="print_' + index + '">' +
                                '<table class="table table-bordered text-center">' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<td colspan="2"><b>информация про клиента</b></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>название клиента</td>' +
                                            '<td>' + element.name_customer + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>компания</td>' +
                                            '<td>' + element.company + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td colspan="2"><b>информация про договор</b></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>номер договора</td>' +
                                            '<td>' + element.number + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td>дата подписания</td>' +
                                            '<td>' + element.date_sign + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td colspan="2"><b>информация про сервисы</b></td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<td colspan="2">' + titleService + '</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                '</table>' +
                            '</div>' +
                            '<button class="btn btn-lg btn-basic print-button" id="button_' + index + '">Распечатать</button>'
                        );

                        $('.contact-table').css('marginTop', '50px');

                        $('#button_' + index).click(function () {
                            $('#print_' + index).printThis();
                        });
                    });
                }
            }
        });

        return false;
    })
});