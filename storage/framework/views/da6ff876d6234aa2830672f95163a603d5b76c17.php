<?php $__env->startSection('content3'); ?>
    
    <div style="display: flex;">
        <div>
            <h1 style="margin-top: auto;"><?php echo e($titulo); ?></h1>
        </div>
        <?php if($subtitulo != "La orden todavía no existe"): ?>
            <div style="margin-left: auto; margin-top: 3px;">
                <label class="btn btn-success">TOTAL $<?php echo e($order->monto); ?></label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">    
                <?php if($order->descuento == 0): ?>
                    <?php if($order->completada == 0): ?>
                    <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/descuento/<?php echo e($id_order); ?>">
                        <?php echo csrf_field(); ?>

                        <input class="btn btn-default" type="number" min="0" max="25" name="descuento" placeholder="DESC %" style="width: 105px;">
                    </form>
                    <?php else: ?>
                        <label class="btn btn-default">DESC $<?php echo e($order->descuento); ?></label>
                    <?php endif; ?>
                <?php else: ?>
                    <label class="btn btn-danger">DESC $<?php echo e($order->descuento); ?></label>
                <?php endif; ?>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">    
                <?php if($order->completada == 1): ?>
                <a href="/admin/control/ingresos/<?php echo e($tipo); ?>" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <h4 class="mt-2 mb-3"><?php echo e($subtitulo); ?></h4>
        
    <?php if($subtitulo != "La orden todavía no existe"): ?>
        <div class="card card-body">
            <p>
                <?php if($order->completada != "1"): ?>
                <form method="POST" action="/admin/control/ingresos/<?php echo e($tipo); ?>/<?php echo e($id_order); ?>">
                    <?php echo csrf_field(); ?>

                    
                    <?php if($id_type == 2): ?>    
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>Servicio</label>
                        <select class="form-control" name="id_servicio" value="<?php echo e(old('id_servicio')); ?>">
                            <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($servicio->id); ?>"><?php echo e($servicio->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                                
                    <div class="form-group col-md-6" style="padding-left: 0px;">
                        <label>Detalle</label>
                        <input required type="text" maxlength="100" class="form-control" name="detalle" value="<?php echo e(old('detalle')); ?>">
                    </div>
                    
                    <?php else: ?>
                    <div class="form-group col-md-4" style="padding-left: 0px;">
                        <label>Producto</label>
                        <select class="form-control" name="id_producto" value="<?php echo e(old('id_producto')); ?>">
                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($producto->id); ?>"><?php echo e($producto->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                                
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>Cant</label>
                        <input required type="number" min="0" class="form-control" name="cantidad" value="<?php echo e(old('cantidad')); ?>">
                    </div>
                    <?php endif; ?>
                    <input type="hidden" class="form-control" name="id_type" value="<?php echo e($id_type); ?>">
                    <input type="hidden" class="form-control" name="id_order" value="<?php echo e($id_order); ?>">
                        
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success form-control">Agregar</button>
                    </div>
                </form>
                
                <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/cerrar/<?php echo e($id_order); ?>">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" class="form-control" name="completada" value="1">
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-danger form-control">Cerrar</button>
                    </div>
                </form>
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>

    <p></p>
    
    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <?php if($id_type == 2): ?>  
                    <th scope="col">Servicio</th>
                    <th scope="col">Detalle</th>
                <?php else: ?>
                    <th scope="col">Producto</th>
                    <th scope="col">Cant.</th>
                <?php endif; ?>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders_indiv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if($id_type == 2): ?>
                    <td scope="row">
                        <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($servicio->id == $order->id_servicio): ?>
                                <?php echo e($servicio->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><?php echo e($order->detalle); ?></td>
                    <?php else: ?>
                    <td scope="row">
                        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($producto->id == $order->id_producto): ?>
                                <?php echo e($producto->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><?php echo e($order->cantidad); ?></td>
                    <?php endif; ?>
                    
                    <td><b>$</b> <?php echo e($order->monto); ?></td>
                    <td><?php echo e(date('d/m/y', strtotime($order->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($order->created_at))); ?> <b>hs</b></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>