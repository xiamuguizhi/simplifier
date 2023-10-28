<?php
/**
 * 极简模板
 * 
 * @package simplifier
 * @author 夏目贵志/simplifier
 * @version 1.0
 * @link https://xiamuyourenzhang.cn/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//文章转载
 ?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	<style>
	body{word-break:break-all;word-wrap:break-word;text-align:justify}img{max-width:100%}pre{background:#f7f7f7;margin:1.25rem 0;padding:.9375rem;overflow:auto;color:#4d4d4c;line-height:1.75}pre code{background:0;text-shadow:none;padding:0;margin:0}blockquote{padding:0 15px;color:#666;border-left:4px solid #ddd}table{width:100%;display:table;border-spacing:2px;margin:20px 0;letter-spacing:0}td,th{display:table-cell;padding:5px;text-align:center}th{background:#DDD}td{background:#EEE;text-align:left;padding:5px 10px;font-size:14px}tr:hover td{background:#ffa}#top{position:fixed;bottom:80px;right:30px;opacity:1;cursor:pointer}h1:before,h2:before,h3:before{content:'# ';color:#000}

	</style>
    <?php $this->header(); ?>	
 </head>

 <body name="top">
 <tt>
 <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>.
 <hr> 
 
         分类:<?php $this->widget('Widget_Metas_Category_List')
                       ->parse(' <a href="{permalink}" >{name}({count})</a>'); ?>
 <hr>
 
<?php 
if ($this->is('index')) {
    // 判断① 判断是否首页
    // 输出文章列表
    $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->parse('{year}/{month}/{day} <a href="{permalink}">{title}</a><br>');
} else {
    // 不是首页
    if ($this->is('category')) {
        // 判断是否分类页面
        // 输出分类列表
    
        $this->widget('Widget_Archive@index', 'pageSize=10000&type=category', 'mid='.getCategeId($this->getArchiveSlug()))->parse('{year}/{month}/{day} <a href="{permalink}">{title}</a><br>');
    } elseif (($this->is('post')) || ($this->is('page'))) {
        // 判断是否文章页或者是独立页面
        // 输出文章标题和内容
        ?>
        <article>
            <h1><?php $this->title() ?></h1>
            <p><?php $this->content('Continue Reading...'); ?></p>
            <?php 
            if (isset($this->fields->author) || ($this->fields->url)) {
                echo '<blockquote>'; 
                echo '<p>文章作者：'.$this->fields->author . '</p>';  
                echo '<p>原文链接：'.$this->fields->url . '</p>';
                echo '<p>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。</p>';
                echo '<blockquote>'; 
            } else {
                // 其他情况的处理
            }
            ?>
        </article>


 <?php if ($this->is('post')) { ?>
 分类:<?php $this->category(',', true, 'none'); ?><br>
<?php } ?>


        <hr/>
        <?php $this->need('comments.php'); ?>
        <?php
    }
} 
?>
<hr>
 
 最后更新于 <?php echo date('Y 年 m 月 d 日', $this->modified);?>.<br>
 Contact me at <?php $this->options->email(); ?>.
 <a href="javascript:window.scrollTo( 0, 0 );" target="_self" id="top">回到顶部</a>
 </tt>
 <?php $this->footer(); ?>
 </body>
</html>
