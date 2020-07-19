<?php if($data['admin'] == "Error") { ?>
    <script>
        location.replace("/");
    </script>
<?php } ?>
<?php if(empty($data['task'])) { ?>
<script>
    location.replace("/");
</script>
<?php } ?>
<div class="container">
    <div class="row">
        <form class="col s12" id="task-edit">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username-edit" name="username-edit" type="text" value="<? echo $data['task'][0]['name']; ?>" readonly>
                    <label for="username-edit">Username</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email-edit" name="email-edit" type="text" value="<? echo $data['task'][0]['email']; ?>" readonly>
                    <label for="email-edit">Email</label>
                    <span class="helper-text" data-error="Invalid email" data-success="Right"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea2" class="materialize-textarea"><? echo $data['task'][0]['text']; ?></textarea>
                    <label for="textarea2">Textarea</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
                <input type="hidden" id="id-task" value="<? echo $data['task'][0]['id']; ?>">
                <input type="hidden" id="cookie" value="<? echo $_COOKIE['admin']; ?>">
            </div>
            <div class="row">
                <a id="edit-task" class="waves-effect waves-light btn">Edit</a>
            </div>
        </form>
    </div>
</div>
