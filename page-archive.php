<?php
/**
 * 文章归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$color = color($this->options->color);
$rounded = $this->options->rounded == 'rightAngle'?'rounded-0':'';  //  获取元素风格设置
$this->need('components/header.php');
?>

    <div class="container archive-page main-content mb-0">
        <?php if ($this->options->breadcrumb == 'on'): ?>
            <nav aria-label="路径" class="breadcrumb-nav">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php $this->options->siteUrl(); ?>" class="<?php echo $color['link']; ?>">首页</a>
                    </li>
                    <li tabindex="0" class="breadcrumb-item active" aria-current="page"><?php $this->title(); ?></li>
                </ol>
            </nav>
        <?php endif; ?>
        <div class="row">
            <div class="archive col-md-12 col-lg-8 col-sm-12 content-area">
                <main class="<?php echo $rounded; ?>">
                    <header class="entry-header border-bottom">
                        <h2 class="entry-title p-name">
                            <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                        </h2>
                    </header>
                    <article>
                        <div data-target="<?php $this->options->postLinkOpen(); ?>" class="post-content" itemprop="articleBody" data-color="<?php echo $color['link']; ?>">
                            <?php
                            $stat = Typecho_Widget::widget('Widget_Stat');
                            Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
                            $year = 0;
                            $mon = 0;
                            $i = 0;
                            $j = 0;
                            $output = '<div class="archives">';
                            while ($archives->next()) {
                                $year_tmp = date('Y', $archives->created);
                                $mon_tmp = date('m', $archives->created);
                                $y = $year;
                                $m = $mon;
                                if ($year > $year_tmp || $mon > $mon_tmp) {
                                    $output .= '</ul></div>';
                                }
                                if ($year != $year_tmp || $mon != $mon_tmp) {
                                    $year = $year_tmp;
                                    $mon = $mon_tmp;
                                    $output .= '<div class="archives-item"><h2>' . date('Y年m月', $archives->created) . '</h2><ul class="archives_list" aria-label="' . date('Y年m月', $archives->created) . '">'; //输出年份
                                }
                                $output .= '<li>' . date('d日', $archives->created) . ' <a href="' . $archives->permalink . '">' . $archives->title . '</a></li>'; //输出文章
                            }
                            $output .= '</ul></div></div>';
                            echo $output;
                            ?>
                        </div>
                    </article>
                </main>
            </div>
            <?php $this->need('components/sidebar.php'); ?>
        </div>
    </div>
<?php $this->need('components/footer.php'); ?>