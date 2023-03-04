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
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>

	<?php foreach ($potongan as $p) {
		$potongan = $p->jml_potongan;
	} ?>


	<?php
	foreach ($p_alpha as $a) {
		$alpha = $a->jml_potongan;
	}
	foreach ($p_sakit as $s) {
		$sakit = $s->jml_potongan;
	}
	foreach ($print_slip as $ps) : ?>

		<?php
		$potongan = ($ps->alpha * $alpha) + ($ps->sakit * $sakit);
		$t_gaji = $ps->gaji_pokok + $ps->tj_transport + $ps->uang_makan - $potongan;
		// $potongan_gaji = $ps->alpha * $potongan;
		?>

		<table style="width: 100%">
			<tr>
				<td width="20%">Nama Pegawai</td>
				<td width="2%">:</td>
				<td><?php echo $ps->nama_pegawai ?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td><?php echo $ps->nik ?></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td><?php echo $ps->nama_jabatan ?></td>
			</tr>
			<tr>
				<td>Bulan</td>
				<td>:</td>
				<td><?php echo substr($ps->bulan, 0, 2) ?></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td>:</td>
				<td><?php echo substr($ps->bulan, 2, 4) ?></td>
			</tr>
		</table>

		<table class="table table-striped table-bordered mt-3">
			<tr>
				<th class="text-center" width="5%">No</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Jumlah</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Gaji Pokok</td>
				<td>Rp. <?php echo number_format($ps->gaji_pokok, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<td>2</td>
				<td>Tunjangan Transportasi</td>
				<td>Rp. <?php echo number_format($ps->tj_transport, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<td>3</td>
				<td>Uang Makan</td>
				<td>Rp. <?php echo number_format($ps->uang_makan, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<td rowspan="3">4</td>
				<td rowspan="3">Potongan</td>
				<td>Sakit (<?= $ps->sakit; ?>) : Rp. <?= number_format($sakit * $ps->sakit, 0, ',', '.'); ?></td>
			</tr>
			<tr>
				<td>Alpha (<?= $ps->alpha; ?>) : Rp. <?= number_format($alpha * $ps->alpha, 0, ',', '.'); ?></td>
			</tr>
			<tr>
				<td>Total Potongan : Rp. <?php echo number_format($potongan, 0, ',', '.') ?></td>
			</tr>
			<tr>
				<th colspan="2" style="text-align: right;">Total Gaji : </th>
				<th>Rp. <?php echo number_format($t_gaji, 0, ',', '.') ?></th>
			</tr>
			<?php
			$persen_zakat = 0;
			foreach ($zakat as $z) {
				$persen_zakat = $persen_zakat + $z->potongan;
			}
			foreach ($zakat[0] as $w) {
				$zakat_first_id = $w;
				break;
			}
			if ($persen_zakat > 0) { ?>
				<?php
				foreach ($zakat as $z) {
				?>
					<tr>
						<?php if ($z->id == $zakat_first_id) { ?>
							<td rowspan="<?= count($zakat) + 1; ?>">5</td>
							<td rowspan="<?= count($zakat) + 1; ?>">Zakat</td>
							<td><?= $z->nama_zakat; ?> : Rp. <?= number_format(($t_gaji / 100) * $z->potongan, 0, ',', '.'); ?> (<?= $z->potongan; ?>%)</td>
						<?php } else { ?>
							<td><?= $z->nama_zakat; ?> : Rp. <?= number_format(($t_gaji / 100) * $z->potongan, 0, ',', '.'); ?> (<?= $z->potongan; ?>%)</td>
						<?php }; ?>
					</tr>
				<?php } ?>
				<tr>
					<td>Total Zakat : Rp. <?= number_format(($t_gaji / 100) * $persen_zakat, 0, ',', '.'); ?>(<?= $persen_zakat; ?>%)</td>
				</tr>
				<tr>
					<th colspan="2" style="text-align: right;">Total Gaji Setelah Zakat : </th>
					<th>Rp. <?= number_format($t_gaji - (($t_gaji / 100) * $persen_zakat), 0, ',', '.'); ?></th>
				</tr>
			<?php } ?>
		</table>

		<table width="100%">
			<tr>
				<td></td>
				<td>
					<p>Pegawai</p>
					<br>
					<br>
					<p class="font-weight-bold"><?php echo $ps->nama_pegawai ?></p>
				</td>

				<td width="200px">
					<p>Kudus, <?php echo date("d M Y") ?> <br> Finance,</p>
					<br>
					<br>
					<p>___________________</p>
				</td>
			</tr>
		</table>

	<?php endforeach; ?>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>