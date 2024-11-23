<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Neraca</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Perubahan Modal</h1>
    </div>

    <div class="section-body">
        <div class="card-body">
            <form action="<?= site_url('neraca') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="tglawal" value="<?= $tglawal ?>">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="tglakhir" value="<?= $tglakhir ?>">
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i> Tampilkan</button>
                        <input type="submit" class="btn btn-success" formtarget="_blank" formaction="neraca/neracapdf" value="Cetak PDF">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tr>
                        <td>AKTIVA</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    $aktiva_lancar = 0;
                    $aktiva_tetap = 0;
                    $total_aktiva_lancar = 0;
                    $total_aktiva_tetap = 0;
                    $total_aktiva = 0;
                    $total_kewajiban = 0;
                    $modal_pemilik = 0;

                    ?>
                    <!-- Aktiva Lancar -->
                    <?php foreach ($dttransaksi as $key => $value) : ?>
                        <?php if ($value->kode_akun2 == 11) : ?>
                            <?php
                            $debit = $value->jumdebit + $value->jumdebits;
                            $kredit = $value->jumkredit + $value->jumkredits;
                            $aktiva_lancar = $debit - $kredit;
                            $total_aktiva_lancar = $total_aktiva_lancar + $aktiva_lancar;
                            ?>
                            <tr>
                                <td class="text-left" style="padding-left:3em"><?= $value->nama_akun3; ?></td>
                                <td></td>
                                <td class="text-right" style="padding-right:6em"><?= number_format($aktiva_lancar, 0, ",", ","); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td>AKTIVA LANCAR</td>
                        <td></td>
                        <td class="text-right"><?= number_format($total_aktiva_lancar, 0, ",", ","); ?> </td>
                    </tr>

                    <!-- Aktiva Tetap -->
                    <?php foreach ($dttransaksi as $key => $value) : ?>
                        <?php if ($value->kode_akun2 == 12) : ?>
                            <?php
                            $debit = $value->jumdebit + $value->jumdebits;
                            $kredit = $value->jumkredit + $value->jumkredits;
                            $aktiva_tetap = $debit - $kredit;
                            $total_aktiva_tetap = $total_aktiva_tetap + $aktiva_tetap;
                            $modal_pemilik = $total_aktiva_lancar + $total_aktiva_tetap + $total_kewajiban;
                            ?>
                            <tr>
                                <td class="text-left" style="padding-left:3em"><?= $value->nama_akun3; ?></td>
                                <td></td>
                                <td class="text-right" style="padding-right:6em"><?= number_format(abs($aktiva_tetap), 0, ",", ","); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td>AKTIVA TETAP</td>
                        <td></td>
                        <td class="text-right"><?= number_format($total_aktiva_tetap, 0, ",", ","); ?> </td>
                    </tr>

                    <tr>
                        <td>JUMLAH AKTIVA</td>
                        <td></td>
                        <td class="text-right"><?= number_format($total_aktiva_lancar + $total_aktiva_tetap, 0, ",", ","); ?> </td>
                    </tr>

                    <!-- Modal dan Kewajiban -->
                    <tr>
                        <td>KEWAJIBAN DAN MODAL</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($dttransaksi as $key => $value) : ?>
                        <?php if ($value->kode_akun2 == 21) : ?>
                            <?php
                            $debit = $value->jumdebit + $value->jumdebits;
                            $kredit = $value->jumkredit + $value->jumkredits;
                            $kewajiban = $debit - $kredit;
                            $total_kewajiban = $total_kewajiban + $kewajiban;
                            $modal_pemilik = $total_aktiva_lancar + $total_aktiva_tetap + $total_kewajiban;
                            ?>
                            <tr>
                                <td class="text-left" style="padding-left:3em"><?= $value->nama_akun3; ?></td>
                                <td></td>
                                <td class="text-right" style="padding-right:6em"><?= number_format(abs($kewajiban), 0, ",", ","); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td>TOTAL KEWAJIBAN</td>
                        <td></td>
                        <td class="text-right"><?= number_format(abs($total_kewajiban), 0, ",", ","); ?> </td>
                    </tr>

                    <tr>
                        <td>MODAL</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="padding-left:3em">Perubahan Modal Pemilik</td>
                        <td></td>
                        <td class="text-right"><?= number_format(abs($modal_pemilik), 0, ",", ","); ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">JUMLAH KEWAJIBAN DAN MODAL</td>
                        <td></td>
                        <td class="text-right"><?= number_format($modal_pemilik + abs($total_kewajiban), 0, ",", ","); ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>