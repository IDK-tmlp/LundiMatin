<main>
<?php if (!is_null($flashmsg)) { ?>
        <div class="alert alert-success container" role="alert">
            <?php echo $flashmsg; ?>
        </div>
    <?php } ?>
    <form action="index.php?page=login" method="POST">
        <div class="container">
            <div class="form-group">
                <label>Username : </label>
                <input type="text" placeholder="Enter Username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label>Password : </label>
                <input type="password" placeholder="Enter Password" name="password" required class="form-control">
            </div>
            <button type="submit" class='btn btn-warning'>Login</button>
        </div>   
    </form>
</main>