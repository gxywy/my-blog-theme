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
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')->to($posts); ?>
            <?php while ($posts->next()):  //  开始循环  ?>
                <?php if ($posts->category == 'micro'): ?>
                  <div class="post <?php echo $rounded; ?>">
                    <div class="entry-summary">
                        <div class="row">
                            <div class="post-content-inner col-xl-12">
                                <p><a href="<?php $posts->permalink() ?>" target="<?php $posts->options->listLinkOpen(); ?>" class="float-right d-sm-none d-none d-md-inline d-lg-inline d-xl-inline <?php echo $color['link']; ?>"><?php $posts->fields->summaryContent?$posts->fields->summaryContent():$posts->excerpt($posts->options->summary, '...'); ?></a></p>
                            </div>
                            <?php $img = getPostImg($posts); ?>
                            <?php if ($img): ?>
                                <div class="post-cover col-xl-12">
                                    <div class="post-cover-inner">
                                        <img src="<?php echo $img; ?>" class="post-cover-img" alt="cover">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="article-info clearfix border-top" role="group" aria-label="文章信息">
                        <!--时间-->
                        <div class="info">
                            <i class="icon-calendar icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <span class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" tabindex="0" title="发布日期：<?php $posts->date('Y年m月d日'); ?>"><?php $posts->date('Y年m月d日'); ?></span>
                        </div>
                        <!--阅读量-->
                        <div class="info">
                            <i class="icon-eye icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <span class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" tabindex="0" title="阅读量：<?php echo getPostView($posts); ?>"><?php echo getPostView($posts); ?></span>
                        </div>
                        <!--评论-->
                        <div class="info">
                            <i class="icon-bubbles2 icon <?php echo $color['link']; ?>" aria-hidden="true"></i>
                            <a class="<?php echo $color['link']; ?>" data-toggle="tooltip" data-placement="top" title="评论" href="<?php $posts->permalink() ?>#comments"><?php $posts->commentsNum('%d 评论'); ?></a>
                        </div>
                        <a href="<?php $posts->permalink() ?>" target="<?php $posts->options->listLinkOpen(); ?>" class="float-right d-sm-none d-none d-md-inline d-lg-inline d-xl-inline <?php echo $color['link']; ?>">全文</a>
                        <?php if ($posts->user->hasLogin()): ?>
                            <a href="<?php echo $posts->options->siteUrl . 'admin/write-post.php?cid=' . $posts->cid; ?>" class="float-right mr-3 d-sm-none d-none d-md-inline d-lg-inline d-xl-inline <?php echo $color['link']; ?>">编辑</a>
                        <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <!--结束-->
        </div>
    
        <!-- 来自 sidebar.php -->
        <?php
        $sidebarM = $this->options->sidebarBlockM;  //  获取侧边栏的移动设备显示设置
        if (!is_array($sidebarM)) {
            $sidebarM = array();
        }
        $hideClass = 'd-md-none d-sm-none d-none d-lg-block d-xl-block';  //  用于在移动设备上隐藏区块的class
        $color = color($this->options->color);
        $rounded = $this->options->rounded == 'rightAngle'?'rounded-0':'';  //  获取元素风格设置
        ?>

        <div class="col-md-12 col-lg-4 col-sm-12 sidebar">
            <section class="border <?php echo in_array('HideBlogInfo', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>博客信息</h4>
                <div class="personal-information pt-2">
                    <div class="user">
                        <img src="<?php $this->options->avatarUrl?$this->options->avatarUrl():$this->options->themeUrl('assets/img/avatar.png'); ?>" alt="<?php echo $this->options->nickname?$this->options->nickname . '的头像':$this->options->title . '的头像'; ?>" class="rounded-circle avatar">
                        <div class="p-2">
                            <a class="user-name mt-2 <?php echo $color['link']; ?>" target="_blank" href="<?php echo $this->options->nicknameUrl?$this->options->nicknameUrl:$this->options->siteUrl; ?>"><?php echo $this->options->nickname?$this->options->nickname:$this->options->title; ?></a>
                            <p class="introduction mt-1"><?php echo $this->options->Introduction?$this->options->Introduction:$this->options->description; ?></p>
                        </div>
                    </div>
                    <div class="website clearfix border-top">
                        <?php Typecho_Widget::widget('Widget_Stat')->to($quantity); ?>
                        <div class="info float-left border-right">
                            <p class="quantity"><?php $quantity->publishedPostsNum(); ?></p>
                            文章数
                        </div>
                        <div class="info float-left border-right">
                            <p class="quantity"><?php $quantity->publishedCommentsNum(); ?></p>
                            评论数
                        </div>
                        <div class="info float-left">
                            <p class="quantity"><?php echo $this->options->birthday?round((time() - strtotime($this->options->birthday)) / 86400, 0) . '天':'0天'; ?></p>
                            运行天数
                        </div>
                    </div>
                </div>
            </section>

            <section class="border calendar <?php echo $rounded; ?> <?php echo in_array('HideCalendar', $sidebarM)?$hideClass:''; ?>">
                <?php $date = getMonth(); ?>
                <h4><?php echo $date[0] . '年' . $date[1] . '月'; ?></h4>
                <div class="tag-list pt-2">
                    <?php $calendar = calendar($date[0] . '-' . $date[1] . '-01', $this->options->siteUrl, $this->options->rewrite, $color['link']); ?>
                    <?php echo $calendar['calendar']; ?>
                    <nav class="pt-2 clearfix" aria-label="上个月及下个月">
                        <?php if ($calendar['previous']): ?>
                            <a class="p-0 float-left <?php echo $color['link']; ?>" href="<?php echo $calendar['previousUrl']; ?>"><?php echo date('Y年m月', strtotime($calendar['previous'] . '01')); ?></a>
                        <?php endif; ?>
                        <?php if ($calendar['next']): ?>
                            <a class="p-0 float-right <?php echo $color['link']; ?>"  href="<?php echo $calendar['nextUrl']; ?>"><?php echo date('Y年m月', strtotime($calendar['next'] . '01')); ?></a>
                        <?php endif; ?>
                    </nav>
                </div>
            </section>
        </div>
        <!--结束-->
    </div>
</div>

