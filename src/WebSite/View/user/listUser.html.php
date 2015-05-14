<div class="wrapper">
    <?php

    foreach($response['users'] as $value){
        ?>
    <div class="user">
        <?
        foreach ( $value as  $key => $value){
           echo '<div class="'.$key.'">'.$value.'</div>';
            echo'<br>';
        }

        ?>
    </div>
    <?}?>
</div>