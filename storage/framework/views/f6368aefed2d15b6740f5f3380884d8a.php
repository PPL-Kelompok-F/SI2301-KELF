

<?php $__env->startSection('content'); ?>

<h1 class="text-2xl font-bold mb-6">Profile</h1>

<?php if(session('success')): ?>
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="bg-white p-6 rounded-xl shadow max-w-lg">

    <form method="POST" action="/profile">
        <?php echo csrf_field(); ?>

        <!-- NAME -->
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name"
                value="<?php echo e(old('name', $user->name)); ?>"
                class="w-full border rounded px-3 py-2">
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email"
                value="<?php echo e(old('email', $user->email)); ?>"
                class="w-full border rounded px-3 py-2">
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="block mb-1">New Password</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2">
        </div>

        <!-- FORM UPDATE -->
<form id="updateForm" method="POST" action="/profile">
    <?php echo csrf_field(); ?>
</form>

<!-- BUTTON AREA -->
<div class="flex justify-between mt-6">

    <!-- LOGOUT -->
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="text-red-500">
            Logout
        </button>
    </form>

    <!-- UPDATE -->
    <button type="submit" form="updateForm"
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Update Profile
    </button>

</div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\SI2301-KELF\resources\views/pages/profile.blade.php ENDPATH**/ ?>