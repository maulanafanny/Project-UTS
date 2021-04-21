<?php
require_once 'conn.php';

$conn = mysqli_connect('localhost', 'root', '', 'dbbuku')or die(mysqli_error($conn));

function query($query)
{
  global $conn;
  
  $result = mysqli_query($conn, $query);

  return $result;
}

function GetAll(){
  $query = "SELECT * FROM entri_buku";
  $exe = mysqli_query(Connect(),$query);
  while($data = mysqli_fetch_array($exe)){
    $datas[] = array('id' => $data['id'],
		'judul' => $data['judul'],
		'pengarang' => $data['pengarang'],
		'penerbit' => $data['penerbit'],
		'genre' => $data['genre'],
		'harga' => $data['harga'],
    );
  }
  return $datas;
}

function GetSearch($cari){
  $query = "SELECT * FROM `entri_buku` WHERE  `judul` LIKE '%".$cari."%'";
  $exe = mysqli_query(Connect(),$query);
  while($data = mysqli_fetch_array($exe)){
    $datas[] = array('id' => $data['id'],
		'judul' => $data['judul'],
		'pengarang' => $data['pengarang'],
		'penerbit' => $data['penerbit'],
		'genre' => $data['genre'],
		'harga' => $data['harga'],
    );
  }
  return $datas;
}

function GetOne($id){
  $query = "SELECT * FROM  `entri_buku` WHERE  `id` =  '$id'";
  $exe = mysqli_query(Connect(),$query);
  while($data = mysqli_fetch_array($exe)){
    $datas[] = array('id' => $data['id'], 
		'judul' => $data['judul'],
		'pengarang' => $data['pengarang'],
		'penerbit' => $data['penerbit'],
		'genre' => $data['genre'],
		'harga' => $data['harga'],
    );
  }
return $datas;
}

function Insert(){
  $judul=$_POST['judul']; 
	$pengarang=$_POST['pengarang']; 
	$penerbit=$_POST['penerbit']; 
	$genre=$_POST['genre']; 
	$harga=$_POST['harga'];
		
  $query = "INSERT INTO `entri_buku` (`id`,`judul`,`pengarang`,`penerbit`,`genre`,`harga`)
VALUES (NULL,'$judul','$pengarang','$penerbit','$genre','$harga')";
$exe = mysqli_query(Connect(),$query);
  if($exe){
    // kalau berhasil
    $_SESSION['message'] = " Data Sudah disimpan ";
    $_SESSION['mType'] = "success ";
    header("Location: index.php");
  }
  else{
    $_SESSION['message'] = " Data Gagal disimpan ";
    $_SESSION['mType'] = "danger ";
    header("Location: index.php");
  }
}

function Update($id){
  $judul=$_POST['judul']; 
	$pengarang=$_POST['pengarang']; 
	$penerbit=$_POST['penerbit']; 
	$genre=$_POST['genre']; 
	$harga=$_POST['harga']; 
		
  $query = "UPDATE `entri_buku` SET `judul` = '$judul',`pengarang` = '$pengarang',`penerbit` = '$penerbit',`genre` = '$genre',`harga` = '$harga' WHERE  `id` =  '$id'";
  $exe = mysqli_query(Connect(),$query);
  if($exe){
    // kalau berhasil
    $_SESSION['message'] = " Data Sudah diubah ";
    $_SESSION['mType'] = "success ";
    header("Location: index.php");
  }
  else{
    $_SESSION['message'] = " Data Gagal diubah ";
    $_SESSION['mType'] = "danger ";
    header("Location: index.php");
  }
}
function Delete($id){
  $query = "DELETE FROM `entri_buku` WHERE `id` = '$id'";
  $exe = mysqli_query(Connect(),$query);
    if($exe){
      // kalau berhasil
      $_SESSION['message'] = " Data Sudah dihapus ";
      $_SESSION['mType'] = "success ";
      header("Location: index.php");
    }
    else{
      $_SESSION['message'] = " Data Gagal dihapus ";
      $_SESSION['mType'] = "danger ";
      header("Location: index.php");
    }
}


if(isset($_POST['insert'])){
  Insert();
}
else if(isset($_POST['update'])){
  Update($_POST['id']);
}
else if(isset($_POST['delete'])){
  Delete($_POST['id']);
}

// fungsi registrasi

function registrasi($data){

  global $conn;

  // masukkan ke variabel

  $username = $data["register-username"];
  $email = $data["register-email"];
  $password = $data["register-password"];

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan ke dalam database
  mysqli_query($conn, "INSERT INTO users VALUES('', '$email', '$username', '$password')");

  return mysqli_affected_rows($conn);

}

function perpage($count, $per_page = '10',$href) {
	$output = '';
	$paging_id = "link_perpage_box";
	if(!isset($_POST["page"])) $_POST["page"] = 1;
	if($per_page != 0)
	$pages  = ceil($count/$per_page);
	if($pages>1) {		
		if(($_POST["page"]-3)>0) {
			if($_POST["page"] == 1)	$output = $output . '<span id=1 class="current-page">1</span>';
			else	$output = $output . '<input type="submit" name="page" class="perpage-link" value="1" />';
		}
		if(($_POST["page"]-3)>1) $output = $output . '...';
		for($i=($_POST["page"]-2); $i<=($_POST["page"]+2); $i++)	{
			if($i<1) continue;
			if($i>$pages) break;
			if($_POST["page"] == $i)	$output = $output . '<span id='.$i.' class="current-page" >'.$i.'</span>';
			else	$output = $output . '<input type="submit" name="page" class="perpage-link" value="' . $i . '" />';
		}		
		if(($pages-($_POST["page"]+2))>1) $output = $output . '...';
		if(($pages-($_POST["page"]+2))>0) {
			if($_POST["page"] == $pages)
				$output = $output . '<span id=' . ($pages) .' class="current-page">' . ($pages) .'</span>';
			else				
				$output = $output . '<input type="submit" name="page" class="perpage-link" value="' . $pages . '" />';
		}
		
	}
	return $output;
}


?>