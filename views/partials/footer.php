<div class="w-full mx-auto max-w-7xl">
    <? foreach (getLangURLs() as $key => $value) : ?>
        <a href="<?=$value?>" title="<?=$key?>"><?=$key?></a> &nbsp;
    <? endforeach; ?>
    </div>
</div>
</body>
</html>