<?php $__env->startSection('content2'); ?>
    include('barcode.php');
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <p>
            <a href="<?php echo e(route('services.create')); ?>" class="btn btn-primary">Nuevo Servicio</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoría</th>
            <th scope="col">Código</th>
            <th scope="col">Cant.</th>
            <th scope="col">Quedan</th>
            <th scope="col">Costo</th>
            <th scope="col">Monto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($service->id); ?></th>
                    <td><?php echo e($service->nombre); ?></td>
                    <td>Varios</td>
                    <td><img src="barcode.php?text=0123456789&size=40&codetype=Code39&print=true"></td>
                    <td>50</td>
                    <td>50</td>
                    <td><b>$</b> <?php echo e($service->monto); ?></td>
                    <td>25</td>
                    <td>
                        <form action="<?php echo e(route('services.delete', $service)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            
                            <a href="<?php echo e(route('services.edit', $service)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>