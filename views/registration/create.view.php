<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="relative mx-auto w-full bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold text-gray-900">Register</h1>
                    <p class="mt-2 text-gray-500">Create a new account</p>
                </div>
                <div class="mt-5">
                    <form action="/register" method="post">
                        <div class="relative mt-6">
                            <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Email Address" class="peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="email" class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Email Address</label>
                            
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['email'] ?? '' ?></span>
                        <div class="relative mt-6">
                            <input type="password" name="password" id="password" placeholder="Password" class="peer peer mt-1 w-full border-b-2 border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                            <label for="password" class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Password</label>
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['password'] ?? '' ?></span>
                        <div class="my-6">
                            <button type="submit" class="w-full rounded-md bg-black px-3 py-4 text-white focus:bg-gray-600 focus:outline-none">Register</button>
                        </div>
                        <p class="text-center text-sm text-gray-500">Already have an account?
                            <a href="/login"
                                class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Login now
                            </a>.
                        </p>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>