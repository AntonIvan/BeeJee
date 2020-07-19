<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="/resources/js/materialize.js"></script>
    <script src="/resources/js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="/resources/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/main.css">

</head>
<body>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="/" class="brand-logo">Tasks</a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    <li style="position: relative;"><a class="waves-effect waves-light btn modal-trigger" href="#new-task">New Task</a>
                    </li>
                    <?php if($data['admin'] == "Error") { ?>
                    <li style="position: relative;"><a class="waves-effect waves-light btn modal-trigger" href="#sign-form">LOGIN</a>
                    </li>
                    <?php } else { ?>
                        <li style="position: relative;"><a class="waves-effect waves-light btn" id="exit-admin">EXIT</a>
                        </li>
                    <?php } ?>
                </ul>

            </div>
        </div>
    </nav>
</div>
<div id="top"></div>
<?php include 'App/View/'.$content_view; ?>
<div id="sign-form" class="modal">
    <div class="modal-content">
        <h4>Welcome</h4>
        <form class="col s12" id="signin-form">
            <div class="row">
                <div class="input-field col s6">
                    <input id="username" name="username" type="text" class="validate">
                    <label for="username">Login</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
                <div class="input-field col s6">
                    <input id="pass" name="pass" type="password" class="validate">
                    <label for="pass">Password</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
            </div>
            <div class="row">
                <a id="signin" class="waves-effect waves-light btn">Sing in</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
<div id="new-task" class="modal">
    <div class="modal-content">
        <h4>New task</h4>
        <form class="col s12" id="task-form">
            <div class="row">
                <div class="input-field col s6">
                    <input id="username-task" name="username-task" type="text" class="validate">
                    <label for="username-task">Username</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
                <div class="input-field col s6">
                    <input id="email-task" name="email-task" type="email" class="validate">
                    <label for="email-task">Email</label>
                    <span class="helper-text" data-error="Invalid email" data-success="Right"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Textarea</label>
                    <span class="helper-text" data-error="Empty" data-success="Right"></span>
                </div>
            </div>
            <div class="row">
                <a id="create-new-task" class="waves-effect waves-light btn">Create</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
</body>
</html>