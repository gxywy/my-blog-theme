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
<!--fancybox-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<!---->
<!--鼠标点击烟花效果-->
<canvas class="fireworks" id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;"></canvas>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/animejs@latest"></script>
<script type='text/javascript' src="<?php $this->options->themeUrl('assets/js/fireworks.js'); ?>"></script> 
<!---->
<?php if ($this->options->bodyHTML): ?>
    <?php $this->options->bodyHTML(); ?>
<?php endif; ?>
<?php $this->footer(); ?>
</body>
</html>
