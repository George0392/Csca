<?php $__env->startSection('content2'); ?>

    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Operación Exitosa!</strong>
            <?php echo e(session()->get('message')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <h1 class="form-group col-md-12">Crear Servicio</h1>

    <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(url('admin/servicios')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control text-uppercase" name="nombre" value="<?php echo e(old('nombre')); ?>" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Monto</label>
                <input type="number" class="form-control" name="monto" value="<?php echo e(old('monto')); ?>" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/servicios" class="btn btn-primary form-control">Volver</a>
            </div>

            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar servicio</button>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>