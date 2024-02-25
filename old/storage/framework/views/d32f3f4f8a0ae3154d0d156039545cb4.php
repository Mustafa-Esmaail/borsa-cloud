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
                                Showing All users
                            </span>

                            <div class="btn-group pull-right btn-group-xs">



                                

                                <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal"
                                    data-target="#create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    Create New User
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
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Office</th>
                                        <th>Created</th>
                                        <th>Updated</th>

                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->id); ?></td>

                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->office->office_name); ?></td>

                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo e($user->created_at); ?></td>
                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo e($user->updated_at); ?></td>

                                            </td>
                                            <td>


                                                <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-toggle="modal" data-target="#edit<?php echo e($user->id); ?>">
                                                    Edit User
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-block"
                                                    data-toggle="modal" data-target="#delete<?php echo e($user->id); ?>">
                                                    Delete User
                                                </button>

                                            </td>

                                        </tr>




                                        <div class="modal fade" id="edit<?php echo e($user->id); ?>"
                                            tabindex="-<?php echo e($user->id); ?>"
                                            aria-labelledby="#deleteLable<?php echo e($user->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable<?php echo e($user->id); ?>">Edit
                                                            <?php echo e($user->name); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form action="<?php echo e(route('users.update', ['id' => $user->id])); ?>"
                                                                method="POST" enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PUT'); ?>
                                                                <!-- Form fields go here -->
                                                                <div class="form-group">
                                                                    <label for="name<?php echo e($user->id); ?>">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name<?php echo e($user->id); ?>" name="name"
                                                                        value="<?php echo e($user->name); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email<?php echo e($user->id); ?>" name="email"
                                                                        value="<?php echo e($user->email); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="selectOffice"<?php echo e($user->id); ?>>Select Office</label>
                                                                    <select class="form-control" id="selectOffice<?php echo e($user->id); ?>"
                                                                        name="office_id">
                                                                        <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $office): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($office->id); ?>"
                                                                                <?php echo e($office->id == $user->office_id ? 'selected' : ''); ?>>
                                                                                <?php echo e($office->office_name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password<?php echo e($user->id); ?>">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        id="<?php echo e($user->id); ?>password<?php echo e($user->id); ?>" name="password" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password-confirm<?php echo e($user->id); ?>">Password Confirm</label>
                                                                    <input type="password" class="form-control"
                                                                        id="password-confirm<?php echo e($user->id); ?>" name="password_confirmation" required>
                                                                </div>

                                                                <!-- Add other form fields as   needed -->
                                                                <button type="submit" class="btn btn-primary">Save</button>
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
                                        <div class="modal fade" id="delete<?php echo e($user->id); ?>"
                                            tabindex="-<?php echo e($user->id); ?>"
                                            aria-labelledby="#deleteLable<?php echo e($user->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="#deleteLable<?php echo e($user->id); ?>">Are
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
                                                        <a href="<?php echo e(route('users.delete', ['id' => $user->id])); ?>"
                                                            class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>

                            </table>

                            <ul id="messages"></ul>
                            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="#createLable"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createLable">Add User
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form action="<?php echo e(route('users.store')); ?>" method="POST"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('POST'); ?>


                                                    <!-- Form fields go here -->
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="office_id">Select Office</label>
                                                        <select class="form-control" id="office_id" name="office_id" required>
                                                            <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $office): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($office->id); ?>">
                                                                    <?php echo e($office->office_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password-confirm">Password Confirm</label>
                                                        <input type="password" class="form-control" id="password-confirm"
                                                            name="password_confirmation" required>
                                                    </div>
                                                    <!-- Add other form fields as   needed -->
                                                    <button type="submit" class="btn btn-primary">Save</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>



    <script>

const socketIO = io('http://localhost:3000');

// Replace USER_ID with the actual user ID
var userId = prompt("Enter user ID");
var message = prompt("Enter message ID");




socketIO.emit("connected", userId);
socketIO.emit("sendEvent", {
        "myId": userId,
        "userId": 2,
        "message": message
    });


socketIO.on("messageReceived", function (data) {
    console.log(data);
  console.log(`Received private message: ${data.message} from user ${data.sender_id}`);
});
// socket.on('privateMessage', (data) => {
//   console.log(`Received private message: ${data.message} from user ${data.sender}`);
// });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/borsacloud/public_html/resources/views/user/index.blade.php ENDPATH**/ ?>