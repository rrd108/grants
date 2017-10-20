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
    <?= $this->Html->css('grants.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <?= $this->Html->image('logo.png') ?>
            <div class="top-bar-section">
                <ul class="right">
                    <li><?= $this->Html->link(
                        __('Histories'),
                        ['controller' => 'Histories', 'action' => 'index']
                        ) ?></li>
                    <li><?= $this->Html->link(
                        __('Current status'),
                        ['controller' => 'CompaniesGrants', 'action' => 'index']
                        ) ?></li>
                </ul>
            </div>
        </nav>
    </header>
    <?= $this->Flash->render() ?>
    <main class="container clearfix row">
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>
</body>
</html>
