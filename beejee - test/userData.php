<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td>
        <textarea name="comment<?php echo $row['id']?>" rows="2" cols="20"><?php echo $row['text']  ?></textarea>
        <snan class="
        
            <?php
                if($row['changed'] != true){
                    echo 'd-none';
                }
            ?>
        "
        >Изменено администратором!</snan>
    </td>
    <td>
        <input type="checkbox" name="checkbox<?php echo $row['id']?>"
            <?php 
             if ($row['checkbox']){
                 echo "checked";
             }
            ?>
        >
    </td>
    <?php if($_COOKIE['id'] == 'admin') :?>
        <td><input name="change-date<?php echo $row['id']?>" type="submit" value="Изменить"></td>
    <?php else :?>
        <td></td>
    <?php endif; ?>
</tr>
