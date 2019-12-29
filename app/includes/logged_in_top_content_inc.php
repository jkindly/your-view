<div class="user-avatar user-avatar-logged-in ml-5">
    <img id="user-avatar-navbar" src="<?= $user->getAvatar(); ?>" alt="">
    <div id="user-avatar-menu" class="dropdown-menu user-avatar-menu">
        <a class="dropdown-item" href="<?= HOST ?>app/scripts/logout.php">Wyloguj</a>
        <a class="dropdown-item" href="<?= HOST ?>settings">Ustawienia</a>
        <?php
            if ($user->getRole() === 'admin')
                echo '<a class="dropdown-item" href='.HOST.'admin>Panel CMS</a>';
        ?>
    </div>
</div>