<div class="container sort">
    <div class="row">
        <div class="col l4 m4 s4">
            <? if($data['sort'] == "name" && $data['orderby'] == "asc") { ?>
            <a href="/?page=<? echo $data['currentPage'];?>&sort=name&orderby=desc" class="btn"><span>Пользователь <i class="small material-icons">arrow_downward</i></span></a>
            <? } else { ?>
            <a href="/?page=<? echo $data['currentPage'];?>&sort=name&orderby=asc" class="btn"><span>Пользователь <i class="small material-icons">arrow_upward</i></span></a>
            <? } ?>
        </div>
        <div class="col l4 m4 s4">
            <? if($data['sort'] == "email" && $data['orderby'] == "asc") { ?>
                <a href="/?page=<? echo $data['currentPage'];?>&sort=email&orderby=desc" class="btn"><span>Email <i class="small material-icons">arrow_downward</i></span></a>
            <? } else { ?>
                <a href="/?page=<? echo $data['currentPage'];?>&sort=email&orderby=asc" class="btn"><span>Email <i class="small material-icons">arrow_upward</i></span></a>
            <? } ?>
        </div>
        <div class="col l4 m4 s4">
            <? if($data['sort'] == "status" && $data['orderby'] == "asc") { ?>
                <a href="/?page=<? echo $data['currentPage'];?>&sort=status&orderby=desc" class="btn"><span>Статус <i class="small material-icons">arrow_downward</i></span></a>
            <? } else { ?>
                <a href="/?page=<? echo $data['currentPage'];?>&sort=status&orderby=asc" class="btn"><span>Статус <i class="small material-icons">arrow_upward</i></span></a>
            <? } ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php foreach($data['tasks'] as $task) { ?>
        <div class="col s4 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><?php echo $task['name']; ?>
                        <? if($data['admin'] == "Success") { ?>
                        <span style="font-size: 12px; float: right">
                            <a href="/form?id=<? echo $task['id'];?>">Редактировать</a>
                        </span>
                        <? } ?>
                    </span>
                    <p><?php echo $task['email']; ?>
                    <p><?php echo $task['text']; ?></p>
                </div>
                <div class="card-action">
                    <p><?php if($task['Status'] == "yes") { echo "Выполнено"; } else { echo "Не выполнено"; } ?></p>
                    <p><?php if($task['editedAdmin']) { echo 'Отредактировано администратором'; } else { echo "&nbsp&nbsp&nbsp&nbsp"; }?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col s12">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $data['pages']; $i++) {?>
                    <li class="<? if($i != $data['currentPage']) {?>waves-effect<? } else {?>active<? } ?>">
                        <a href="/?page=<? echo $i ?><?php if($data['sort'] != "") { echo "&sort={$data['sort']}"; }
                        if($data['orderby'] != "") { echo "&orderby={$data['orderby']}"; } ?>
                        "><? echo $i ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
