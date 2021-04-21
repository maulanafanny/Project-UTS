<?php
session_start();
require_once 'func.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Page</title>
	<link rel = "icon" href ="logos.png" type = "image/x-icon"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container" style="margin-top: 40px;">
	<h1 style="font-weight: bold;">HALAMAN ADMIN BOOKSLIDE</h1>
	<br>
		<div class="card" style="box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			<div class="card-header">
				<i class="fa fa-fw fa-book" style="font-size: 25px;"></i>
				<strong style="font-size: 25px;">Entri Buku</strong>
				<a href='#addNewBook' class="btn btn-success" data-toggle='modal' style="float: right;"><i class="fa fa-fw fa-plus-circle"></i>Tambah Buku Baru</button></a>
			</div>
			<div class="col-sm-12">
				<div class="card-body">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i>Cari Buku</h5>

					<form class="col-sm-12 row" action="index.php" method="get">
						<div class="form-group" style="margin-right: 20px;">
						  <label for="">Judul Buku</label>
						  <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan Judul Buku">
						</div>
						<div class="form-group" style="margin-right: 20px;">
						  <label for="">Genre</label>
						  <input type="text" class="form-control" name="genre" id="genre" placeholder="Masukkan Genre Buku">
						</div>
						<div class="form-group" style="margin-right: 20px;">
						  <label for="">Pengarang</label>
						  <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Masukkan Pengarang Buku">
						</div>
						<div class="form-group" style="display: flex; align-items: flex-end;">
							<button type="submit" name="submit-search" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-fw fa-search"></i>Search</button>
							<button type="reset" class="btn btn-danger" style="margin-right: 10px;"><i class="fa fa-fw fa-recycle"></i>Clear</button>
						</div>
					</form>

					</div>
			</div>
		</div>
		<hr>

		<table class="table table-striped table-bordered" style=" box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			<thead class="thead-dark">
				<tr>
					<th style="text-align: center;">No</th>
					<th>Judul</th>
					<th>Pengarang</th>
					<th>Penerbit</th>
					<th>Genre</th>
					<th>Harga</th>
					<th colspan='2' style="text-align: center;">Opsi</th>
				</tr>
			</thead>
			<tbody>
					<?php
					if(isset($_GET['submit-search'])){

						$condition	=	'';
						if (isset($_REQUEST['judul']) and $_REQUEST['judul'] != "") {
							$condition	.=	' AND judul LIKE "%' . $_REQUEST['judul'] . '%" ';
						}
						if (isset($_REQUEST['genre']) and $_REQUEST['genre'] != "") {
							$condition	.=	' AND genre LIKE "%' . $_REQUEST['genre'] . '%" ';
						}
						if (isset($_REQUEST['pengarang']) and $_REQUEST['pengarang'] != "") {
							$condition	.=	' AND pengarang LIKE "%' . $_REQUEST['pengarang'] . '%" ';
						}
						
						$d 	= mysqli_query(Connect(),"SELECT * FROM entri_buku WHERE 1 " . $condition . "");
    	  		$no = 1;
					}
					else{
						$d = mysqli_query(Connect(),"SELECT * FROM `entri_buku`");	
      			$no = 1;
					}
						while($data = mysqli_fetch_array($d)){
					?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['judul']; ?></td>
								<td><?php echo $data['pengarang']; ?></td>
								<td><?php echo $data['penerbit']; ?></td>
								<td><?php echo $data['genre']; ?></td>
								<td>Rp <?php echo $data['harga']; ?>,00</td>
								<td class='text-center'>
								<form name='edt' id='edt' method='POST'>
									<input type='hidden' name='id' value="<?php echo $data['id']?>">
									<button type='submit' style="border: none; color: blue; background-color: transparent"><i class='fa fa-edit'></i></button>
								</form>
    	        	</td>
								<td class='text-center'>
									<a href='#DeleteBook' data-toggle='modal' style="color: red;"><i class='fa fa-fw fa-trash'></i></a>
									<input type='hidden' name='id' value="<?php echo $data['id']?>">
    	          </td>
							</tr>
							<?php } ?>
			</tbody>

		</table>
	</div>

	<!-- Add Modal HTML -->
	<div id="addNewBook" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action='func.php' method='POST'>
					<div class="modal-header">						
						<h4 class="modal-title">Tambah Buku Baru</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Judul</label>
							<input type="text" id="judul" name="judul" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Pengarang</label>
							<input type="text" id="pengarang" name="pengarang" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Penerbit</label>
							<input type="text" id="penerbit" name="penerbit" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Genre</label>
							<textarea class="form-control" id="genre" name="genre" required></textarea>
						</div>					
						<div class="form-group">
							<label>Harga</label>
							<input type="text" id="harga" name="harga" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type='submit' name='insert' class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Edit Modal HTML -->
	<?php
		$id = $_POST['id'];
		print $id;
		$one = GetOne($id);
	?>
	<div id="editIdentity" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action='func.php' method='POST'>
				<input type='hidden' name='id' value="<?php echo $_POST['id']; ?>">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Identitas Buku</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">

				<?php
				foreach($one as $data){?>

					<div class="form-group">
						<label>Judul</label>
						<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $data['judul']; ?>" required>
					</div>
					<div class="form-group">
						<label>Pengarang</label>
						<input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $data['pengarang']; ?>" required>
					</div>
					<div class="form-group">
						<label>Penerbit</label>
						<input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $data['penerbit']; ?>" required>
					</div>
					<div class="form-group">
						<label>Genre</label>
						<textarea class="form-control" id="genre" name="genre" required><?php echo $data['genre']; ?></textarea>
					</div>					
					<div class="form-group">
						<label>Harga</label>
						<input type="text" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>" required>
					</div>
				</div>

				<?php } ?>

				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name='update' class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal HTML -->
<div id="DeleteBook" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method='POST' action='func.php'>
				<input type='hidden' name='id' value="<?php echo $_POST['id']; ?>">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Buku</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Apakah Anda yakin ingin menghapus data ini?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name='delete' class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
window.onpageshow = function() {
    if (typeof window.performance != "undefined"
        && window.performance.navigation.type === 0) {
         $('#editIdentity').modal('show');
    }
}
</script>

</body>

</html>