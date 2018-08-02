$(document).ready(function () {
    var imageContent;
    $('#show-preview').click(function (event) {

        var data = {};
        $.each($(event.target).closest("form").serializeArray(), function(_, kv) {
            data[kv.name] = kv.value;
        });

        var code = $("<table class=\"table table-striped\">").append(
            $("<thead>").append(
                $("<tr>").append(
                    $("<th>").text("Имя пользователя").css('verticalAlign', 'middle'),
                    $("<th>").text("E-mail").css('verticalAlign', 'middle'),
                    $("<th>").text("Задача").css('verticalAlign', 'middle'),
                    $("<th>").text("Статус (выполнено)").css('verticalAlign', 'middle'),
                    $("<th>").text("Фото").css('verticalAlign', 'middle')
                )
            ),
            $("<tbody>").append(
                $("<tr>").append(
                    $("<td>").text(data.username).css('width', '13%').css('verticalAlign', 'middle'),
                    $("<td>").text(data.email).css('width', '13%').css('verticalAlign', 'middle'),
                    $("<td>").text(data.task).css('width', '34%').css('verticalAlign', 'middle'),
                    $("<td>").text(data.is_done ? "Да" : "Нет").css('width', '10%').css('verticalAlign', 'middle'),
                    $("<td>").append(
                        $("<img>").attr("src", imageContent ? imageContent : '/img/no-image.png').css('width', '320px').css('height', '240px').css('verticalAlign', 'middle')
                    ),
                )
            )
        );

        $("#preview").empty()
            .append(code);

        event.preventDefault();
        return false;
    });

    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function (e) {
                imageContent = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#add_image").change(function(){
        readURL(this);
    });
});