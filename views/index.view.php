<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold py-4">Hello, <?= $_SESSION['user']['name'] ?? 'Guest'; ?></h1>
        
        This is the index page. Be sure to check out the <a href="/notes" class="text-blue-500">notes page</a>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
