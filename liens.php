
<?php if(isset($_SESSION['admin'])){{
include("menuadmin.php");
}
?> 
<section class="photocouverture">
<img src="">
</section>
<?php 
}else{if(isset($_SESSION['utilisateur'])){
include("menuutilisateur.php");
?> 
<section class="photocouverture">
<img src="">
</section>
<?php 

}else{
include("menu.php");}
}
?> 


