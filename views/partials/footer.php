<div class="w-full mx-auto max-w-7xl">
    <? foreach (getLangLinks() as $key => $value) : ?>
       <? echo '<a href="'. $value .'" title="'. $key .'">'. $key .'</a>'; ?>
    <? endforeach; ?>
    </div>
</div>
</body>
</html>