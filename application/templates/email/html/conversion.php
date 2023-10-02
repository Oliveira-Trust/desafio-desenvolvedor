<div class="container">
    <div class="row">
        <div class="column content">
            <?php
            $lines = explode("\n", $content);

            foreach ($lines as $line) :
                echo '<p> ' . $line . "</p>\n";
            endforeach;
            ?>
        </div>
        <div class="column content">
            Conversão realiza em: <?= date('d/m/Y - H:i:s') ?>
        </div>
    </div>
</div>