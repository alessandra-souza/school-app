<?php
$navItems = Lib\Page::navItems();
?>
<header class="header clearfix">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h3 class="text-muted">
                <a href="/" class="brand">School App</a>
            </h3>
            <ul class="nav nav-pills float-right">
                <?php
                foreach($navItems as $item) {
                    ?>
                <li class="nav-item">
                    <a class="nav-link<?php echo Lib\Request::pathInfo()->getUri()===$item['url']?' active':'';?>" href="<?php echo $item['url'];?>">
                        <?php echo $item['text'];?>
                    </a>
                </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
    
</header>