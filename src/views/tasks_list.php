<?php
/** @var array $data data for views */
?>
<h1>Tasks list</h1>
<div class="tasks-actions">
    <div class="new-task">
        <form class="new-task__form" method="post" action="/add">
            <input class="input new-task__input" type="text" name="text" placeholder="Enter text...">
            <button class="button button--filled">add task</button>
        </form>
        <?php if (@$data['error']): ?>
            <p class="new-task__error"><?=$data['error']?></p>
        <?php endif; ?>
    </div>
    <div class="tasks-actions__buttons">
        <a href="/remove_all" class="button">remove all</a>
        <a href="/ready_all" class="button">ready all</a>
    </div>

</div>

<div class="tasks">
    <?php foreach ($data['tasksList'] as $task): ?>
        <div class="task">
            <div class="task__content">
                <div class="task__text"><?= $task['description']; ?></div>
                <div class="task-actions">
                    <a href="/remove?id=<?= $task['id']; ?>" class="button">remove</a>
                    <?php if ($task['status'] == 'ready'): ?>
                        <a href="/change_status?status=unready&id=<?= $task['id']; ?>" class="button">unready</a>
                    <?php else: ?>
                        <a href="/change_status?status=ready&id=<?= $task['id']; ?>" class="button">ready</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="task__status<?= $task['status'] !== 'ready' ? '' : ' task__status--ready' ?>"></div>

        </div>
    <?php endforeach; ?>
</div>
