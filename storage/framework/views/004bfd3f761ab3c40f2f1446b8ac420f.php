<!DOCTYPE html>
<html>
<head>
    <title>Login - BelajarIn</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<script>
function setRole(role) {
    document.getElementById('role').value = role;

    // reset style semua button
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('bg-indigo-500', 'text-white');
        btn.classList.add('bg-gray-100');
    });

    // highlight yang dipilih
    event.target.classList.remove('bg-gray-100');
    event.target.classList.add('bg-indigo-500', 'text-white');
}
</script>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT -->
    <div class="hidden md:flex w-1/2 relative">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
             class="absolute w-full h-full object-cover">

        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative text-white p-10 flex flex-col justify-end">
            <h1 class="text-3xl font-bold mb-2">
                Edit Smarter. Export Faster.
            </h1>
            <p class="text-sm text-gray-200">
                Create Anywhere. Build your LMS.
            </p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 flex items-center justify-center">

        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

            <h2 class="text-2xl font-bold mb-2">Welcome Back!</h2>
            <p class="text-gray-500 text-sm mb-6">
                Login to start your learning
            </p>

            <!-- ERROR VALIDATION -->
            <?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <!-- ERROR LOGIN -->
            <?php if(session('error')): ?>
                <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
                <!-- ROLE -->
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <!-- ROLE OPTION -->
                <div class="mb-4">
                    <label class="text-sm mb-2 block">Sign in as</label>

                    <div class="grid grid-cols-3 gap-2">

                        <button type="button"
                            onclick="setRole('student')"
                            class="role-btn bg-gray-100 py-2 rounded-lg">
                            Student
                        </button>

                        <button type="button"
                            onclick="setRole('teacher')"
                            class="role-btn bg-gray-100 py-2 rounded-lg">
                            Teacher
                        </button>

                        <button type="button"
                            onclick="setRole('admin')"
                            class="role-btn bg-gray-100 py-2 rounded-lg">
                            Admin
                        </button>

                    </div>
                </div>

                <!-- HIDDEN INPUT -->
                <input type="hidden" name="role" id="role" value="student">

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-2 border rounded-lg"
                        required>
                </div>

                <!-- PASSWORD -->
                <div class="mb-4">
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2 border rounded-lg"
                        required>
                </div>

                <!-- REMEMBER -->
                <div class="flex justify-between items-center mb-4 text-sm">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-black text-white py-2 rounded-lg">
                    Login
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html><?php /**PATH C:\Users\user\SI2301-KELF\resources\views/auth/login.blade.php ENDPATH**/ ?>