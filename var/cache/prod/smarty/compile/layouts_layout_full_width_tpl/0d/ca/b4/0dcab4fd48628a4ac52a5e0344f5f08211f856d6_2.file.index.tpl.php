<?php
/* Smarty version 3.1.33, created on 2020-03-30 15:59:20
  from 'C:\Users\steven\Documents\Prestashop_projet\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e81fb38df9ea1_38442481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0dcab4fd48628a4ac52a5e0344f5f08211f856d6' => 
    array (
      0 => 'C:\\Users\\steven\\Documents\\Prestashop_projet\\themes\\classic\\templates\\index.tpl',
      1 => 1579532616,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e81fb38df9ea1_38442481 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20531810645e81fb38deb391_34543801', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_13684960675e81fb38ded619_69111671 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_3070479755e81fb38df2853_78465446 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_17739854475e81fb38df0849_64977108 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3070479755e81fb38df2853_78465446', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_20531810645e81fb38deb391_34543801 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_20531810645e81fb38deb391_34543801',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_13684960675e81fb38ded619_69111671',
  ),
  'page_content' => 
  array (
    0 => 'Block_17739854475e81fb38df0849_64977108',
  ),
  'hook_home' => 
  array (
    0 => 'Block_3070479755e81fb38df2853_78465446',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13684960675e81fb38ded619_69111671', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17739854475e81fb38df0849_64977108', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
