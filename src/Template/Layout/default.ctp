<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('foundation.min.css') ?>
    <?= $this->Html->css('foundation-icons.css') ?>

    <?= $this->Html->css("https://fonts.googleapis.com/css?family=Quicksand") ?>
    <?= $this->Html->css('grants.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
<header>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <?php
        if($this->request->params['action'] != 'login') {
            echo $this->Html->link(
                $this->Html->image('logo.png'),
                ['controller' => 'CompaniesGrants', 'action' => 'index'],
                ['escape' => false]
            );
        }
        ?>
        <div class="top-bar-section">
            <?php
            if ($this->request->session()->read('Auth.User')) :
            ?>
            <ul class="right">
                <li><?= $this->Html->link(
                        __('New History'),
                        ['controller' => 'Histories', 'action' => 'add']
                    ) ?>
                </li>
                <li>
                    <?= $this->Html->link(__('Logout'),
                        ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout']);
                    ?>
                    <span id="username"><?= $this->request->session()->read('Auth.User.username') ?></span>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </nav>
</header>
<?= $this->Flash->render() ?>
<main class="container clearfix row">
    <?= $this->fetch('content') ?>
</main>
<footer>
</footer>
<?= $this->Html->script('vendor/jquery.js') ?>
<?= $this->Html->script('vendor/what-input.js') ?>
<?= $this->Html->script('vendor/foundation.js') ?>
<?= $this->Html->script('grants.min') ?>
<?= $this->fetch('script') ?>
</body>
</html>
