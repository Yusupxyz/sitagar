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
    <h3 align="center">DATA Nilai</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Id Laporan Kinerja</th>
		<th>Tanggung Jawab</th>
		<th>Ketaatan</th>
		<th>Produktivitas</th>
		<th>Efesiensi</th>
		<th>Inovasi</th>
		<th>Kerja Sama</th>
		<th>Efektivitas</th>
		<th>Kecepatan</th>
		
            </tr><?php
            foreach ($nilai_data as $nilai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $nilai->id ?></td>
		      <td><?php echo $nilai->id_laporan_kinerja ?></td>
		      <td><?php echo $nilai->tanggung_jawab ?></td>
		      <td><?php echo $nilai->ketaatan ?></td>
		      <td><?php echo $nilai->produktivitas ?></td>
		      <td><?php echo $nilai->efesiensi ?></td>
		      <td><?php echo $nilai->inovasi ?></td>
		      <td><?php echo $nilai->kerja_sama ?></td>
		      <td><?php echo $nilai->efektivitas ?></td>
		      <td><?php echo $nilai->kecepatan ?></td>	
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