(function () {
    $('table thead tr th').css('verticalAlign', 'middle');
    $('table tbody tr td').css('verticalAlign', 'middle');
})();

$(document).ready(function() {
    $('.delete-items').click(function() {
        var el = this;
        var id = this.id;
        var splitId = id.split("_");
        var deleteId = splitId[1];

        swal({
            position: 'top',
            title: 'Вы уверены, что хотите удалить эту задачу?',
            text: "Вы не сможете вернуть эту задачу!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#19aa4e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да, удалить!',
            cancelButtonText: 'Отмена',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '/tasks/delete/' + deleteId,
                        type: 'POST',
                        data: {id: deleteId}
                    })
                        .done(function(response){
                            swal({
                                position: 'top',
                                title: 'Удалено!',
                                text: 'Ваша задача была удалена.',
                                type: 'success'
                            });
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function () {
                                $(this).remove();
                            });
                        })
                        .fail(function(){
                            swal({
                                position: 'top',
                                title: 'Упс...',
                                text: 'Что-то пошло не так при удалении!',
                                type: 'error'
                            });
                        });
                });
            },
            allowOutsideClick: false
        });
        $(this).preventDefault();
    });
});