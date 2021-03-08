<?php
/**
 * 微博
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$color = color($this->options->color);
$rounded = $this->options->rounded == 'rightAngle'?'rounded-0':'';  //  获取元素风格设置
$this->need('components/header.php');
?>

<div class="container home main-content">
    <div class="row">
        <div class="article-list col-md-12 col-lg-8 col-sm-12 content-area">
        <?php $color = color($this->options->color); ?>
        <!--来自 components/post-list.php -->
            <?php while ($this->next()):  //  开始循环  ?>
                    <div class="entry-summary">
                        <p><?php $this->fields->summaryContent?$this->fields->summaryContent():$this->excerpt($this->options->summary, '...'); ?></p>
                    </div>
                    <div class="article-info clearfix border-top" role="group" aria-label="文章信息">
                        <!--时间-->
                        <div class="info">
                            <i class="icon-calendar icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <span class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" tabindex="0" title="发布日期：<?php $this->date('Y年m月d日'); ?>"><?php $this->date('Y年m月d日'); ?></span>
                        </div>
                        <!--阅读量-->
                        <div class="info">
                            <i class="icon-eye icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <span class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" tabindex="0" title="阅读量：<?php echo getPostView($this); ?>"><?php echo getPostView($this); ?></span>
                        </div>
                        <!--评论-->
                        <div class="info">
                            <i class="icon-bubbles2 icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <a class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" title="评论" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('%d 评论'); ?></a>
                        </div>
                        <a href="<?php $this->permalink() ?>" target="<?php $this->options->listLinkOpen(); ?>" class="float-right d-sm-none d-none d-md-inline d-lg-inline d-xl-inline <?php echo $color['link']; ?>">阅读评论</a>
                        <?php if ($this->user->hasLogin()): ?>
                            <a href="<?php echo $this->options->siteUrl . 'admin/write-post.php?cid=' . $this->cid; ?>" class="float-right mr-3 d-sm-none d-none d-md-inline d-lg-inline d-xl-inline <?php echo $color['link']; ?>">编辑</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <!--结束-->

            <nav aria-label="分页导航区" class="pagination-nav">
                <?php $this->pageNav('&laquo;', '&raquo;', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination justify-content-center ' . $color['name'], 'itemTag' => 'li',  'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
            </nav>
        </div>
    <?php $this->need('components/sidebar.php'); ?>
    </div>
</div>
<?php $this->need('components/footer.php'); ?>