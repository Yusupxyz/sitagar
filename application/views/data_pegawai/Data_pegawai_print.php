<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Data Pegawai</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Username</th>
		<th>Password</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Jk</th>
		<th>Pendidikan Terakhir</th>
		<th>Nuptk</th>
		<th>Alamat</th>
		<th>Jabatan</th>
		<th>Tahun Lulus</th>
		<th>Tanggal Sk Awal</th>
		<th>Tempat Tugas</th>
		<th>No Hp</th>
		<th>Email</th>
		<th>Status Verif</th>
		<th>Catatan Verif</th>
		
            </tr><?php
            foreach ($data_pegawai_data as $data_pegawai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_pegawai->nama ?></td>
		      <td><?php echo $data_pegawai->username ?></td>
		      <td><?php echo $data_pegawai->password ?></td>
		      <td><?php echo $data_pegawai->tempat_lahir ?></td>
		      <td><?php echo $data_pegawai->tanggal_lahir ?></td>
		      <td><?php echo $data_pegawai->jk ?></td>
		      <td><?php echo $data_pegawai->pendidikan_terakhir ?></td>
		      <td><?php echo $data_pegawai->nuptk ?></td>
		      <td><?php echo $data_pegawai->alamat ?></td>
		      <td><?php echo $data_pegawai->jabatan ?></td>
		      <td><?php echo $data_pegawai->tahun_lulus ?></td>
		      <td><?php echo $data_pegawai->tanggal_sk_awal ?></td>
		      <td><?php echo $data_pegawai->tempat_tugas ?></td>
		      <td><?php echo $data_pegawai->no_hp ?></td>
		      <td><?php echo $data_pegawai->email ?></td>
		      <td><?php echo $data_pegawai->status_verif ?></td>
		      <td><?php echo $data_pegawai->catatan_verif ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>