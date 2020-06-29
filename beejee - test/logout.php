 <?php if(isset($_POST['log_out'])) : ?>
 
        <div class="alert alert-secondary" role="alert">
          Вы вышли из админ-панели!
        </div>

      <script>
    	document.cookie = "id=admin; max-age=-1";
	   </script>
	   
<?php  $admin_user = 'No' ?> 
 
<?php endif; ?>