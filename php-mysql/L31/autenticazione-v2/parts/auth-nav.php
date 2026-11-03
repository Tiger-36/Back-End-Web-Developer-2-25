<?php if(!$auth->isLoggedIn()):?>
        <li class="nav-item">
            <a href="<?=BASE_URL?>/login.php" class="btn btn-primary">Login</a>
        </li> 
        <li class="nav-item">
            <a href="<?=BASE_URL?>/register.php" class="btn btn-warning">Register</a>
        </li> 
<?php endif;?>

<?php if($auth->isLoggedIn()):?>
    <li class="nav-item">
        <a href="<?=BASE_URL?>/auth/main/user-logout.php" class="nav-link">Logout</a>
    </li>
<?php endif;?>