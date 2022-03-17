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
    <h3 align="center">DATA Data Berkas</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Id Pegawai</th>
		<th>Sertifikasi</th>
		<th>Ijazah</th>
		<th>Transkrip</th>
		
            </tr><?php
            foreach ($data_berkas_data as $data_berkas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_berkas->id ?></td>
		      <td><?php echo $data_berkas->id_pegawai ?></td>
		      <td><?php echo $data_berkas->sertifikasi ?></td>
		      <td><?php echo $data_berkas->ijazah ?></td>
		      <td><?php echo $data_berkas->transkrip ?></td>	
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