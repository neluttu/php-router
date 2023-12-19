<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-4 text-2xl font-semibold"><?= $product['name'] .' $' . number_format($product['price'], 0); ?></h1>
        <ul class="flex flex-wrap items-center justify-start flex-1 gap-4">

    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>