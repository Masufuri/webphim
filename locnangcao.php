<?php
    include_once "control.php";
    $getdata=new data;
    include_once "header.php";
    $loi="<script>alert('Có gì đó không ổn, bạn sẽ được đưa về trang chủ');window.location.href='index.php'</script>";
    if(isset($_GET['trang'])){
        $trang=$_GET['trang']*12-12;
    }
    else {$_GET['trang']=1;$trang=0;}
    $gettheloai=$getdata->gettheloai();

    if(isset($_GET['sort'])){
        if($_GET['sort']=='moi')$sort='moi';
        else $sort='cu';
    }else $sort='moi';

    $ar=array();
    if(isset($_GET['matl']))$a=$_GET['matl'];
    else {$a="";$_GET['matl']="";}
    $sotl=substr_count($a,";");
    for($i=0;$i<$sotl;$i++){
        $themmang=stristr("$a",";",true);
        array_push($ar,$themmang);
        $a=substr(stristr("$a",";"),1);
    }
?>
	<form action="" method="post">
        <?php
            foreach($gettheloai as $se){
                echo "<div style='display:inline-block'>
                        <input type='checkbox' id='{$se['matheloai']}' name='theloai[]' value='{$se['matheloai']}' ".(in_array($se['matheloai'],$ar)?'checked':'').">
                        <label for='{$se['matheloai']}'>{$se['theloai']}</label>&emsp;
                    </div>";
            }
        ?>
        <select name="thoigian">
            <option value="moi" <?php if($sort=="moi")echo "selected";?>>Mới nhất</option>
            <option value="cu" <?php if($sort=="cu")echo "selected";?>>Cũ nhất</option>
        </select>
        <input type="submit" name="sbtl" value="Tìm kiếm">
    </form>
<div class="new">
    
    <?php
        $layallphim=[];
        if(isset($_POST['sbtl'])){
            $dstl="";
            foreach($_POST['theloai'] as $tlnha){
                $dstl.=$tlnha.";";
            }
            echo "<script>location.href='locnangcao.php?matl={$dstl}&sort={$_POST['thoigian']}'</script>";
        }
        try{
            $layallphim=$getdata->locnhieutheloai($ar,$trang,$sort);
        }
        catch(Exception $e){echo $loi;}
    ?>
    <div class="cacpicnew">
        <?php
            foreach($layallphim as $fi){
                echo "<div class='divpicnew'>
                        <a href='infophim.php?id={$fi['maphim']}'>
                            <img class='picnew' src='{$fi['picture']}'><br>
                            <span class='title-phim-hot'>{$fi['name']}</span>
                        </a>
                    </div>";
            }
            if($ar!=null)$sophim=mysqli_num_rows($getdata->locnhieutheloai($ar,-1,$sort));
            else $sophim=1;
            $sotrang=ceil($sophim/12);
        ?>
    </div>
    <ul class="phantrang">
        Trang:
        <?php
            for($i=1;$i<=$sotrang;$i++){
                echo "<li>
                        <a "?><?php if(isset($_GET['trang']))if($_GET['trang']==$i)echo "style='background-color:red;' "; echo "href='locnangcao.php?matl={$_GET['matl']}&trang={$i}&sort={$sort}'>{$i}
                        </a>
                    </li>";
            }?>
    </ul>
</div>
<?php include_once "footer.php";?>
</div>
</body>
</html>