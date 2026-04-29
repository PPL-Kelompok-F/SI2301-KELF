<?php $__env->startSection('content'); ?>

<h1 class="text-2xl font-bold mb-6">
    Halo, <?php echo e(auth()->user()->name); ?>

</h1>

<!-- STATS -->
<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl shadow">
        Streak
        <h2 class="text-2xl font-bold">5 Hari</h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        Course
        <h2 class="text-2xl font-bold">3</h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        Avg Score
        <h2 class="text-2xl font-bold">85</h2>
    </div>

</div>

<!-- COURSES -->
<h2 class="font-bold mb-3">My Courses</h2>

<div class="grid grid-cols-3 gap-4">

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="font-bold">UI/UX Design</h3>
        <p class="text-sm text-gray-500">Progress 80%</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="font-bold">Fullstack Web</h3>
        <p class="text-sm text-gray-500">Progress 40%</p>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\SI2301-KELF\resources\views/dashboard.blade.php ENDPATH**/ ?>