<?php $color = color($this->options->color); ?>
<footer>
    <div class="container">
        <?php if ($this->options->icp): ?>
            <div>
                <span><?php $this->options->icp(); ?></span>
            </div>
        <?php endif; ?>
        <span>Powered by <a href="http://www.typecho.org/" target="_blank">Typecho</a>, Made by Microyu</span>
    </div>
</footer>
<?php if ($this->options->toTop == 'show'): ?>
    <button type="button" class="btn to-top rounded-circle d-none <?php echo $color['link']; ?>" title="返回顶部" aria-label="返回顶部">
        <i class="icon-arrow-up"></i>
    </button>
<?php endif; ?>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/bundle20201109.js'); ?>"></script>
<!--图片懒加载-->
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $("img.lazyload").lazyload();
</script>
<!---->
<!--鼠标点击烟花效果-->
<canvas class="fireworks" id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;"></canvas>
<script type="text/javascript" src="https://cdn.bootcss.com/animejs/2.2.0/anime.min.js"></script>
<script type='text/javascript' src="<?php $this->options->themeUrl('assets/js/fireworks.js'); ?>"></script> 
<!---->
<?php if ($this->options->bodyHTML): ?>
    <?php $this->options->bodyHTML(); ?>
<?php endif; ?>
<?php $this->footer(); ?>
</body>
</html>
