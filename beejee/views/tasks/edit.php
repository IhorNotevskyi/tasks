<?php if ($user && $user->getLogin() && $user->getRole() === 'admin') : ?>
    <div class="text-left container">
        <h2 class="text-center" style="margin-bottom: 30px">Редактировать задачу</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id'] ?>"/>
            <div class="form-group">
                <label for="edit_username">Имя пользователя <span class="text-danger">*</span></label>
                <input type="text" id="edit_username" name="username" value="<?= $data['username'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="edit_email">E-mail <span class="text-danger">*</span></label>
                <input type="text" id="edit_email" name="email" value="<?= $data['email'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="edit_task">Задача <span class="text-danger">*</span></label>
                    <textarea id="edit_task" name="task" rows="4" class="form-control"><?= $data['task'] ?></textarea>
            </div>
            <div class="form-group" style="margin-top: 20px">
                <label for="edit_is_done" style="margin-right: 5px">Задача выполнена?</label>
                <input type="checkbox" id="edit_is_done" name="is_done" value="on"<?= $data['is_done'] ? ' checked' : '' ?>>
            </div>
            <div class="form-group" style="margin-top: 18px">
                <label for="edit_image" style="margin-right: 5px">Редактировать фото</label>
                <input type="file" name="image" id="edit_image" style="display: inline-block; margin-bottom: 10px">
                <img style="width: 200px; height: 150px; display: inline-block" src="/img/<?= $data['image'] ? $data['image'] : 'no-image.png' ?>">
                <p class="help-block" style="font-size: 12px; margin: 20px 0 40px">Пожалуйста, загрузите Ваш файл (jpg, png, gif). Максимальный размер файла - 3Мб. При несоответствии требованиям фото не будет загружено.</p>
            </div>
            <input type="submit" class="btn btn-lg btn-success" value="Сохранить изменения" style="margin-bottom: 60px">
        </form>
    </div>
<?php endif; ?>