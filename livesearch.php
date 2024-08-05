<style type="text/css">
    .ketqua{
        display:block;
        width: initial;
        padding: 5px;
    }
    .ketqua:hover{
        background:steelblue;
    }
</style>
<?php
include "control.php";
$tenphim=$_GET["q"];
$phim=mysqli_query($conn,"select * from phim where name like'%".$tenphim."%' limit 5");
foreach($phim as $p){
    if(isset($_GET['a']))echo "<a class='ketqua' href='index.php?id=".$p['maphim']."'>".$p['name']."</a>";
    else echo "<a class='ketqua' href='infophim.php?id=".$p['maphim']."'>".$p['name']."</a>";
}
//echo "ádajsda";
?>