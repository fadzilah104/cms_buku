
<head>
    <title>Pengelolaan Buku</title>
    
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
  <div class="panel-heading"><b>Form Tambah Buku</b></div>
  <div class="panel-body">
  <?=$this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>buku/proses_edit_buku" method="post" enctype="multipart/form-data">
       <table class="table table-striped">

       <input type="hidden" name="id_buku" value="<?php echo $buku->id_buku?>" />
 
          <tr>
          <td style="width:15%;">Judul Buku</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="judul" class="form-control"  value="<?php echo $buku->judul; ?>">
            </div>
            </td>
         </tr>

         <tr>
          <td style="width:15%;">Pengarang</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="pengarang" class="form-control" value="<?php echo $buku->pengarang; ?>">
            </div>
            </td>
         </tr>

         <tr>
          <td style="width:15%;">Penerbit</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="penerbit" class="form-control" value="<?php echo $buku->penerbit; ?>">
            </div>
            </td>
         </tr>

         <tr>
          <td style="width:15%;">Kategori</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="kategori" class="form-control" value="<?php echo $buku->id_kategori; ?>">
            </div>
            </td>
         </tr>

         <tr>
          <td style="width:15%;">ISBN</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="isbn" class="form-control" value="<?php echo $buku->isbn; ?>">
            </div>
            </td>
         </tr>

         <tr>
          <td style="width:15%;">Tahun Terbit</td>
          <td>
            <div class="col-sm-10">
                <input type="text" name="thn_terbit" class="form-control" value="<?php echo $buku->tahun_terbit; ?>">
            </div>
            </td>
         </tr>


         <tr>
          <td style="width:15%;">File Foto</td>
          <td>
            <div class="col-sm-6">
                <input type="file" name="filefoto" class="form-control">
            </div>
            </td>
         </tr>
         

         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Ubah">
            <button type="reset" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
