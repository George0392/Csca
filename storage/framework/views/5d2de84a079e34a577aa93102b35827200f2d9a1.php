<?php $__env->startSection('content2'); ?>
        
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de <?php echo e($type); ?>s</h1>
        <p>
            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">Nuevo <?php echo e($type); ?></a>
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-info">ir a Categorias</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoría</th>
            <th scope="col">Código barra</th>
            <th scope="col">Pedido</th>
            <th scope="col">Quedan</th>
            <th scope="col">Costo</th>
            <th scope="col">Monto</th>
            <th scope="col">Foto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($product->id); ?></th>
                    <td><?php echo e($product->nombre); ?></td>
                    <td>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($product->id_categoria == $category->id): ?>
                        <?php echo e($category->nombre); ?>

                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php
                        echo DNS1D::getBarcodeHTML("$product->codigo", "EAN13", 1, 35);
                        ?>
                    </td>
                    <td><?php echo e($product->pedido); ?> <b>uds.</b></td>
                    <td><?php echo e($product->quedan); ?> <b>uds.</b></td>
                    <td><b>$</b> <?php echo e($product->costo); ?></td>
                    <td><b>$</b> <?php echo e($product->monto); ?></td>
                    <td>
                        <img class="zoom" width="36px" src="../uploads/<?php echo e($product->archivo); ?>">
                    </td>
                    <td>
                        <form action="<?php echo e(route('products.delete', $product)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            
                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>