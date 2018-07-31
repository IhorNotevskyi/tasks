<h2 class=text-center" style="margin-bottom: 20px">Список задач</h2>
<a href="/tasks/add" class="float-right" style="display: inline; margin: 15px 0">
    <button class="btn btn-lg btn-success" style="padding: 15px 60px">Добавить задачу</button>
</a>
<div class="table-responsive text-canter" style="margin-top: 20px">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Имя пользователя</th>
                <th>E-mail</th>
                <th>Задача</th>
                <th>Выполнено</th>
                <th>Фото</th>
                <?php if ($user && $user->getLogin() && $user->getRole() === 'admin') : ?>
                    <th>Управление</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['tasks'] as $key => $task) : ?>
                <?php if ($key === 'count') break; ?>
                <tr>
                    <td style="width: 13%"><?= $task['username'] ?></td>
                    <td style="width: 13%"><?= $task['email'] ?></td>
                    <td style="width: 34%"><?= $task['task'] ?></td>
                    <td style="width: 10%"><?= $task['is_done'] ? 'да' : 'нет' ?></td>
                    <td style="width: 20%">
                        <img src="/img/<?= $task['image'] ? $task['image'] : 'no-image.png' ?>" alt="Image_<?= $task['id'] ?>" style="width: 320px; height: 240px">
                    </td>
                    <?php if ($user && $user->getLogin() && $user->getRole() === 'admin') : ?>
                        <td style="width: 10%">
                            <a href="/tasks/edit/<?= $task['id'] ?>" style="margin-bottom: 2px">
                                <button class="btn btn-sm btn-block btn-primary">Редактировать</button>
                            </a>
                            <button class="btn btn-sm btn-block btn-danger delete-items" id="del_<?= $task['id'] ?>" style="margin-top: 2px">Удалить</button>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <tbody>
    </table>
</div>
<br/>
<?php if (!isset($_GET['page'])) $_GET['page'] = 1; ?>
<div class="text-center" style="margin: -10px 0 20px">
    <ul class="pagination pagination-lg tasks-pagination justify-content-center">
        <?php if ($_GET['page'] > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="/tasks?page=<?= $_GET['page'] - 1 ?>">Предыдущая</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link">Предыдущая</span>
            </li>
        <?php endif; ?>

        <?php for ($j = 1; $j <= ($data['tasks']['count']); $j++) : ?>
            <?php if ($j == 2) : ?>
                <li class="page-item dots" onclick="moveDots()" style="cursor: pointer">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            <li class="page-item<?= ($j == $_GET['page']) ? ' active' : ''; ?>">
                <a href="/tasks?page=<?= $j ?>" class="page-link"><?= $j ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($_GET['page'] < $j - 1) : ?>
            <li class="page-item">
                <a class="page-link" href="/tasks?page=<?= $_GET['page'] + 1 ?>">Следующая</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link">Следующая</span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<script src="/js/pagination.js" async></script>
<script src="/js/delete.js" async></script>