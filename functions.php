<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeFields($layout) { // 文章版权信息
    $url = new Typecho_Widget_Helper_Form_Element_Text('url', NULL, NULL, _t('转载文章地址'), _t('url'));
    $author = new Typecho_Widget_Helper_Form_Element_Text('author', NULL, NULL, _t('作者名'), _t('author'));	
    $layout->addItem($url);
    $layout->addItem($author);	
}

function themeConfig($form) { // 网站底部联系邮箱
    $email = new Typecho_Widget_Helper_Form_Element_Text('email', NULL, NULL, _t('电子邮件地址'), _t('在这里填入你的联系邮箱'));
    $form->addInput($email);
}

function getCategeId($slug) //根据分类的slug获取分类的ID
{
    $db = Typecho_Db::get();
    $CategeId = $db->fetchRow($db->select()->from('table.metas')->where('slug=?', $slug)->where('type=?', 'category'));
    return $CategeId['mid'];
}
