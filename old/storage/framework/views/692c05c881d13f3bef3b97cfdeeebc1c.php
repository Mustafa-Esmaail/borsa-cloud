<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <?php if(session()->has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Showing All Office
                            </span>

                            <div class="btn-group pull-right btn-group-xs">



                                

                                <button type="button" class="btn btn-default btn-sm pull-right"
                                                    data-toggle="modal" data-target="#create">
                                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New Office
                                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">



                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                </caption>
                                <thead class="thead">
                                    <tr>
                                         <img class="img-fluid" style=" width: 100px;"
                                                    src="<?php echo e(asset('storage/chat_img/fWB0RxmzfrtLaOPlpkqU3Hbq8GIVk6hDmwTadDm1.jpg' )); ?>" alt="Avatar">

                                        <th>Office Name</th>
                                        <th>Office Owner</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $office): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($office->id); ?></td>
  <img class="img-fluid" style=" width: 100px;"
                                                    src="<?php echo e(asset('storage/chat_img/fWB0RxmzfrtLaOPlpkqU3Hbq8GIVk6hDmwTadDm1.jpg' )); ?>" alt="Avatar">
                                            <td><?php echo e($office->office_name); ?></td>
                                            <td><?php echo e($office->office_owner); ?></td>
                                            <td><?php echo e($office->country); ?></td>
                                            <td><?php echo e($office->city); ?></td>
                                            <td><?php echo e($office->phone); ?></td>
                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo e($office->created_at); ?></td>
                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo e($office->updated_at); ?></td>



                                            </td>
                                            <td>

                                                
                                                <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-toggle="modal" data-target="#edit<?php echo e($office->id); ?>">
                                                    Edit office
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-block"
                                                    data-toggle="modal" data-target="#delete<?php echo e($office->id); ?>">
                                                    Delete office
                                                </button>

                                            </td>

                                        </tr>




                                        

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?php echo e($office->id); ?>"
                                            tabindex="-<?php echo e($office->id); ?>"
                                            aria-labelledby="#deleteLable<?php echo e($office->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable<?php echo e($office->id); ?>">Edit
                                                            <?php echo e($office->office_name); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form
                                                                action="<?php echo e(route('office.update', ['id' => $office->id])); ?>"
                                                                method="POST" enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PUT'); ?>
                                                                <!-- Form fields go here -->
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="office_name"
                                                                        value="<?php echo e($office->office_name); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="office_owner">Office Owner</label>
                                                                    <input type="text" class="form-control"
                                                                        id="office_owner" name="office_owner"
                                                                        value="<?php echo e($office->office_owner); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="country">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="country" name="country"
                                                                        value="<?php echo e($office->country); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="city">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="city" name="city"
                                                                        value="<?php echo e($office->city); ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="phone">Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        id="phone" name="phone"
                                                                        value="<?php echo e($office->phone); ?>">
                                                                </div>
                                                                <!-- Add other form fields as   needed -->
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?php echo e($office->id); ?>"
                                            tabindex="-<?php echo e($office->id); ?>"
                                            aria-labelledby="#deleteLable<?php echo e($office->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable<?php echo e($office->id); ?>">Are
                                                            you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to proceed with this action?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <a href="<?php echo e(route('office.delete', ['id' => $office->id])); ?>"
                                                            class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>

                            </table>
                            <div class="modal fade" id="create"
                                tabindex="-1"
                                aria-labelledby="#createLable" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLable">Add Office
                                                </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form
                                                    action="<?php echo e(route('office.store')); ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('POST'); ?>

                                                    <!-- Form fields go here -->
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control"
                                                            id="name" name="office_name"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="office_owner">Office Owner</label>
                                                        <input type="text" class="form-control"
                                                            id="office_owner" name="office_owner"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" class="form-control"
                                                            id="country" name="country"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control"
                                                            id="city" name="city"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control"
                                                            id="phone" name="phone" required
                                                            >
                                                    </div>
                                                    <!-- Add other form fields as   needed -->
                                                    <button type="submit"
                                                        class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/borsacloud/public_html/resources/views/office/index.blade.php ENDPATH**/ ?>