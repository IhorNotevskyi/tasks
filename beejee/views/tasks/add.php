<div class="text-left container">
    <h2 class="text-center" style="margin-bottom: 30px">Добавить задачу</h2>
    <form action="" method="post" enctype="multipart/form-data" id="form_add">
        <div class="form-group">
            <label for="add_username">Имя пользователя <span class="text-danger">*</span></label>
            <input type="text" id="add_username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="add_email">E-mail <span class="text-danger">*</span></label>
            <input type="text" id="add_email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="add_task">Задача <span class="text-danger">*</span></label>
            <textarea id="add_task" name="task" rows="4" class="form-control"></textarea>
        </div>
        <?php if ($user && $user->getLogin() && $user->getRole() === 'admin') : ?>
            <div class="form-group" style="margin-top: 20px">
                <label for="add_is_done" style="margin-right: 5px">Задача выполнена?</label>
                <input type="checkbox" id="add_is_done" name="is_done" value="on">
            </div>
        <?php endif; ?>
        <div class="form-group" style="margin-top: 30px">
            <label for="add_image" style="margin-right: 5px">Добавить фото</label>
            <input type="file" name="image" id="add_image" style="display: inline-block">
            <p class="help-block" style="font-size: 12px; margin: 20px 0 40px">Пожалуйста, загрузите Ваш файл (jpg, png, gif). Максимальный размер файла - 3Мб. При несоответствии требованиям картинка не будет загружена.</p>
        </div>
        <input type="submit" class="btn btn-lg btn-success" value="Сохранить задачу" style="margin-bottom: 40px">
    </form>
</div>