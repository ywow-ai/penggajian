<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<h1>Sistem Informasi Penggajian Karyawan di Pondok Pesantren Tasywiqul Furqon Kudus Berbasis Web</h1>
		<h2>Daftar Gaji Pegawai</h2>
	</center>

	<?php
	if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$bulantahun = $bulan . $tahun;
	} else {
		$bulan = date('m');
		$tahun = date('Y');
		$bulantahun = $bulan . $tahun;
	}
	?>
	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan ?></td>
		</tr>
		<tr>
			<td>Tahunn</td>
			<td>:</td>
			<td><?php echo $tahun ?></td>
		</tr>
	</table>
	<table class="table table-bordered table-triped">
		<tr>
			<th rowspan="2" class="text-center">No</th>
			<th rowspan="2" class="text-center">NIK</th>
			<th rowspan="2" class="text-center">Nama Pegawai</th>
			<th rowspan="2" class="text-center">Jenis Kelamin</th>
			<th rowspan="2" class="text-center">Jabatan</th>
			<th rowspan="2" class="text-center">GajI Pokok</th>
			<th rowspan="2" class="text-center">Tj. Transport</th>
			<th rowspan="2" class="text-center">Uang Makan</th>
			<th colspan="3" class="text-center">Potongan</th>
			<th rowspan="2" class="text-center">Total Gaji</th>
			<?php
			$persen_zakat = 0;
			foreach ($zakat as $z) {
				$persen_zakat = $persen_zakat + $z->potongan;
			}
			if ($persen_zakat > 0) { ?>
				<th colspan="<?= count($zakat); ?>" class="text-center">Zakat</th>
				<th rowspan="2" class="text-center">Total Gaji Setelah Zakat</th>
			<?php } ?>
		</tr>
		<tr>
			<th class="text-center">Alpha</th>
			<th class="text-center">Sakit</th>
			<th class="text-center">Total Potongan</th>
			<?php foreach ($zakat as $z) { ?>
				<th><?= $z->nama_zakat; ?></th>
			<?php } ?>
		</tr>
		<?php
		foreach ($p_alpha as $a) {
			$alpha = $a->jml_potongan;
		}
		foreach ($p_sakit as $s) {
			$sakit = $s->jml_potongan;
		}
		$no = 1;
		foreach ($cetak_gaji as $g) : ?>
			<?php
			$potongan = ($g->alpha * $alpha) + ($g->sakit * $sakit);
			$t_gaji = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potongan;
			?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $g->nik ?></td>
				<td class="text-center"><?php echo $g->nama_pegawai ?></td>
				<td class="text-center"><?php echo $g->jenis_kelamin ?></td>
				<td class="text-center"><?php echo $g->nama_jabatan ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->tj_transport, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
				<td class="text-center"><?php echo number_format($g->alpha, 0, ',', '.') ?> x Rp. <?= $alpha; ?></td>
				<td class="text-center"><?php echo number_format($g->sakit, 0, ',', '.') ?> x RP. <?= $sakit; ?></td>
				<td class="text-center">Rp. <?php echo number_format($potongan, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($t_gaji, 0, ',', '.') ?></td>
				<?php
				$p_zakat = 0;
				foreach ($zakat as $z) {
					$p_zakat = $p_zakat + (($t_gaji / 100) * $z->potongan); ?>
					<td class="text-center">Rp. <?= ($t_gaji / 100) * $z->potongan; ?> (<?= $z->potongan; ?> %)</td>
				<?php }
				if ($persen_zakat > 0) { ?>
					<td class="text-center">Rp. <?php echo number_format($t_gaji - $p_zakat, 0, ',', '.') ?></td>
				<?php } ?>
			</tr>
		<?php endforeach; ?>
	</table>

	<table width="100%">
		<tr>
			<td></td>
			<td width="200px">
				<p>Kudus, <?php echo date("d M Y") ?> <br> Finance</p>
				<br>
				<br>
				<p>_____________________</p>
			</td>
		</tr>
	</table>
</body>

</html>

<script type="text/javascript">
	window.print();
</script>