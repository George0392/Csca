<?php $__env->startSection('content3'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        
        <?php if($titulo == "Ingresos por " . $tipo . " del día"): ?>
            <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
            <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample">
                Nuevo ingreso
            </button>
            <button class="btn btn-info" data-toggle="collapse" data-target="#collapseExample2">
                Historial
            </button>
        <?php else: ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
            <a href="/admin/control/ingresos/<?php echo e($tipo); ?>/" class="btn btn-primary">Volver</a>
            <button class="btn btn-info" data-toggle="collapse" data-target="#collapseExample2">
                Historial
            </button>
        <?php endif; ?>
        
        <div class="collapse indent" id="collapseExample">
            <div class="card card-body">
                <p>
                    <form method="POST" action="/admin/control/ingresos/<?php echo e($tipo); ?>">
                        <?php echo csrf_field(); ?>

                        
                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Atendió</label>
                            <select class="form-control" name="id_empleado" value="<?php echo e(old('id_empleado')); ?>">
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($empleado->id); ?>"><?php echo e($empleado->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                                
                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Cliente</label>
                            <select class="form-control" name="id_cliente" value="<?php echo e(old('id_cliente')); ?>">
                                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <input type="hidden" class="form-control" name="id_type" value="<?php echo e($id_type); ?>">
                        <input type="hidden" class="form-control" name="deHoy" value=1>
                        <input type="hidden" class="form-control" name="completada" value=0>
                        <input type="hidden" class="form-control" name="monto" value=0>
                        <input type="hidden" class="form-control" name="desc" value=0>
                        
                        <div class="form-group col-md-2" style="padding-left: 0px;">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Agregar</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
            
        <div class="collapse indent" id="collapseExample2">
            <div class="card card-body">
                <p>
                    <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/ingresos/' . $tipo . '/historial')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label> Desde </label>
                            <input required type="date" class="form-control" name="desde">
                        </div>
                        <div class="form-group">
                            <label> Hasta </label>
                            <input required type="date" class="form-control" name="hasta" value="<?php echo e(date("Y-m-d")); ?>">
                        </div>
                                    
                        <button type="submit" class="btn btn-success">Buscar</button>
                        
                    </form>
                </p>
            </div>
        </div>
    </div>

    <p></p>
    
    <table class="table">
        <thead class="thead-dark"></thead>
            <tr></tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Atendió</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Ver</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($order->id); ?></th>
                    <td>
                        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($cliente->id == $order->id_cliente): ?>
                                <?php echo e($cliente->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($empleado->id == $order->id_empleado): ?>
                                <?php echo e($empleado->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><b>$</b> <?php echo e($order->monto - $order->desc); ?></td>
                    <td><?php echo e(date('d/m/y', strtotime($order->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($order->created_at))); ?></td>
                    <td><a href="/admin/control/ingresos/<?php echo e($tipo); ?>/<?php echo e($order->id); ?>" class="btn btn-success"><span class="oi oi-eye"></span></a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>