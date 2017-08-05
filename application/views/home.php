
<head>
    <title>Daftar Buku</title> <!-- variabel diambil dari controller -->
    
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet"> <!-- Custom styles for this template -->
<style>

    body{
        margin:20px 10%;
    }
</style>
</head>

<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b> Daftar Buku</b></div>
  <div class="panel-body">
    
    <?=$this->session->flashdata('pesan')?>
    <p>
        <a href="<?=base_url()?>buku/add" class="btn btn-success">Tambah</a>
    </p>
  <table class="table table-bordered table-striped">
    <tr>
      <th>cover</th>
      <th>Judul Buku</th>
      <th>Pengarang</th>
      <th>Penerbit</th>
      <th>Kategori</th>
      <th>ISBN</th>
      <th>Tahun Terbit</th>
      <th colspan="2">Action</th>
    </tr>
  <?php foreach ($query as $row)
{
  ?>
    <tr>
      <td><img  src="<?=base_url()?>assets/hasil_resize/<?=$row->cover;?>"></td>
      <td><?=$row->judul;?></td>
      <td><?=$row->pengarang;?></td>
      <td><?=$row->penerbit;?></td>
      <td><?=$row->id_kategori; ?></td>
      <td><?=$row->isbn;?></td>
      <td><?=$row->tahun_terbit;?></td>
      <td><a class="btn btn-default" href="<?php echo base_url('buku/edit/'.$row->id_buku);?>">Edit</a></td>
      <td><a href="<?=base_url('buku/deletebuku/'.$row->id_buku);?>" class="btn btn-danger">Hapus</a></td>
    </tr>
<?php } ?>
  </table>

</div>
</div>
</div>
