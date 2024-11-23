<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Akun1</title>
<?= $this->endSection(); ?>




<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('admin/new') ?>" class="btn btn-primary"> Add New</a>
    </div>

    <!-- ini untuk menangkap session success dengan bawaan with -->
<?php if (session()->getFlashdata('success')) :?>
<div class="alert alert-success alert-dismissible show fade">
    <div class="alser-body"> 
        <button class="close" data-dismiss="alert"> x </button>
        <?= session()->getFlashdata('success'); ?>
    </div>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) :?>
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alser-body"> 
        <button class="close" data-dismiss="alert"> x </button>
        <?= session()->getFlashdata('error'); ?>
    </div>
</div>
<?php endif; ?>

    <div class="section-body">
        <!-- dinamis -->
        <div class="card">
            <div class="card-header">
                <h4>Data Users</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->name ?></td>
                                    <td>
                                        <a href="<?=site_url('admin/detail/' . $user->userid) ?>" class="btn btn-info btn-small"><i class="fas fa-bars btn-small"></i> Detail</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</section>

<?= $this->endSection(); ?>