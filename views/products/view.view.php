<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <? if(isset($_SESSION['_flashed']['cart_message']['result'])) : ?>
            <div class="p-3 mb-4 text-white bg-blue-400 border border-blue-500 rounded-md">
                <?= $_SESSION['_flashed']['cart_message']['result'] ?? 'No error message available at this time...'; ?>
            </div>
        <? endif ?>

        <h1 class="mb-4 text-2xl font-semibold">
            <?=$product['name'] . '<br><br> Price: ' . $product['price'] . '$' ?>
        </h1>
        <img src="/images/products/<?=$product['id']?>.jpg" class="max-w-[460px]">
                    <form name="" method="post" action="/product/<?=slug($product['name']) ?>/<?=$product['category']?>">
                    <? if($product['color']) { ?>
                        <select name="color" class="p-2 mr-2 bg-white border">
                            <? foreach(explode(',', $product['color']) as $Color) echo '<option value="'.$Color.'">'.$Color.'</option>'; ?>
                        </select>              
                    <? } ?>          
                        <input type="hidden" name="id" value="<?=$product['id'] ?>">
                        <input type="hidden" name="name" value="<?=$product['name'] ?>">
                        <input type="hidden" name="price" value="<?=$product['price'] ?>">
                        Quantity: 
                        <select name="quantity" class="p-2 mr-2 bg-white border">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                        <button type="submit" class="px-3 py-2 mt-4 bg-white border">
                            Add to cart
                        </button>
                    </form>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>