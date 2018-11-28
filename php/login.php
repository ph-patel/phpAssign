<?php
$title = 'Login';
require('header.php');
?>
<main class="container">
    <h1>Log In</h1>

    <?php
    if (isset($_GET['invalid'])) {
        echo '<div class="alert alert-danger" >Invalid Login </div>';
    } else {
        echo '<div class="alert alert-info">Please enter your credentials</div>' ;
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required
                   type="email" placeholder="abc@gmail.com"
            />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </fieldset>
        <fieldset class="col-sm-offset-2">
            <input type="submit" value="Login" class="btn btn-success" />
        </fieldset>
    </form>
</main>

<script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>

</body>
</html>