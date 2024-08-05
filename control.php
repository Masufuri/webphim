<?php
    include "connect.php";
    class data{
		public function dangnhap($username,$pass){
			global $conn;
			$sql="select * from users_phim where username='$username' and password='$pass'";
			$run=mysqli_query($conn,$sql);
			$num=mysqli_num_rows($run);
			return $run;
		}
		public function themphimyeuthich($user_id,$movie_id){
			global $conn;
			$sql="insert into favorites(user_id,movie_id) values ($user_id,$movie_id)";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function themphim($maphim,$name,$pic,$theloai,$namsx,$phim,$noidung,$iddaodien,$loaiphim,$thoiluong){
			global $conn;
			$sql="insert into phim(maphim,name,picture,theloai,namsx,phim,noidung,directors_id,loaiphim,thoiluong) values ($maphim,'$name','$pic','$theloai',$namsx,\"$phim\",\"$noidung\",$iddaodien,'$loaiphim','$thoiluong')";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function timphim($name,$sx){
			global $conn;
			if($sx==1)$sql="select * from phim where name like '%$name%'";
			else $sql="select * from phim where name like '%$name%' order by maphim desc";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function phimbophimle($loaiphim,$sx){
			global $conn;
			if($sx==1)$sql="select * from phim where loaiphim = '$loaiphim'";
			else $sql="select * from phim where loaiphim = '$loaiphim' order by maphim desc";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
        public function dsphim($limit){
            global $conn;
            if($limit<0)$sql="select * from phim order by maphim desc";
			else $sql="select * from phim order by maphim desc limit $limit,12";
            $run=mysqli_query($conn,$sql);
            return $run;
        }
		public function dsphimcu(){
            global $conn;
            $sql="select * from phim";
            $run=mysqli_query($conn,$sql);
            return $run;
        }
        public function phimmoinhat(){
            global $conn;
            $sql="select * from phim order by maphim desc limit 1";
            $run=mysqli_query($conn,$sql);
            return $run;
        }
        public function loctheloai($theloai,$limit,$sx){
			global $conn;
			if($limit<0)$sql="select * from phim where theloai like '%$theloai%' order by maphim desc";
			elseif($sx=='moi')$sql="select * from phim where theloai like '%$theloai%' order by maphim desc limit $limit,12";
			else $sql="select * from phim where theloai like '%$theloai%' order by maphim asc limit $limit,12";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function locnhieutheloai($nhieutheloai,$limit,$sort){
			if($nhieutheloai==null)return [];
			$demsotheloai=count($nhieutheloai);
			global $conn;
			$query="";
			if($limit>=0){
				if($sort=='moi')$them=" order by maphim desc limit $limit,12";
				elseif($sort=='cu') $them=" order by maphim asc limit $limit,12";
			}else $them="";
			for($i=1;$i<$demsotheloai;$i++){$query.= " and phim.theloai like concat('%',(SELECT theloai.theloai FROM theloai WHERE matheloai={$nhieutheloai[$i]}),'%')";}
			$sql="SELECT * FROM phim WHERE phim.theloai like concat('%',(SELECT theloai.theloai FROM theloai WHERE matheloai={$nhieutheloai[0]}),'%')".$query.$them;
			
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function locnamsx($namsx,$limit,$sx){
			global $conn;
			if($limit<0)$sql="select * from phim where namsx = $namsx order by maphim desc";
			elseif($sx=='moi')$sql="select * from phim where namsx = $namsx order by maphim desc limit $limit,12";
			else $sql="select * from phim where namsx = $namsx order by maphim asc limit $limit,12";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function topluotxem($top){
			global $conn;
			if($top==10)$sql="select * from phim order by view desc limit 10";
			else $sql="select * from phim order by view desc limit 5";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
        public function infophim($id)
        {
            global $conn;
            $sql="select * from phim where maphim=$id";
            $run=mysqli_query($conn,$sql);
            return $run;
        }
		public function suaphim($name,$picture,$theloai,$namsx,$filephim,$noidung,$iddaodien,$loaiphim,$thoiluong,$maphim){
			global $conn;
			$sql="update phim set name='$name',picture='$picture',theloai='$theloai',namsx=$namsx, phim=\"$filephim\",noidung=\"$noidung\",directors_id=$iddaodien,loaiphim='$loaiphim',thoiluong='$thoiluong' where maphim={$maphim}";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function xoaphim($maphim){
			global $conn;
			$sql="delete from phim where maphim=$maphim";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function getnamsx(){
			global $conn;
			$sql="SELECT DISTINCT namsx FROM `phim` ORDER BY namsx ASC";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function getcountries(){
			global $conn;
			$sql="SELECT ten FROM `countries` where phim.countries_id=";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function gettheloai(){
			global $conn;
			$sql="select * from theloai";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function ins_theloai($tl){
			global $conn;
			$sql="insert into theloai(theloai) values('$tl')";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function del_theloai($id){
			global $conn;
			$sql="delete from theloai where matheloai=$id";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function chon_theloai($chuoisosanh,$chuoigoc){
			global $conn;
			$sql="select CHARINDEX('$chuoisosanh', '$chuoigoc')";
			$run=mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($run);
			$num=mysqli_num_rows($run);
			return $num;
		}
		public function chon_theloai2($chuoisosanh){
			global $conn;
			$sql="select * from phim where theloai like '$chuoisosanh%' or theloai like '%$chuoisosanh%' or theloai like '%$chuoisosanh'";echo $sql;
			$run=mysqli_query($conn,$sql);
			/* $row = mysqli_fetch_array($run); */
			return $run;
		}
		public function chontheloai($id){
			global $conn;
			$sql="select theloai from theloai where matheloai=$id";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
		public function getdaodienall(){
			global $conn;
			$sql="select * from directors";
			$run=mysqli_query($conn,$sql);
			return $run;
		}
    }

?>