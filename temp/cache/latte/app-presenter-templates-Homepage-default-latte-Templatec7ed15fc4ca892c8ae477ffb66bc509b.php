<?php
// source: /var/www/uloha-cortex/app/presenter/templates/Homepage/default.latte

class Templatec7ed15fc4ca892c8ae477ffb66bc509b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('a4949127ba', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb8e83eb4f4a_content')) { function _lb8e83eb4f4a_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h2>Počet uživatelů : <?php echo Latte\Runtime\Filters::escapeHtml($usersCount, ENT_NOQUOTES) ?></h2>
<h2>počet přiřazených karet : <?php echo Latte\Runtime\Filters::escapeHtml($cardsCount, ENT_NOQUOTES) ?></h2>
<h2>Top 10 zákazníků podle obratu nákupů za posledních 30 dní</h2>

<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Jméno</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Datum registrace</th>
            <th>adresa</th>
        </tr>
<?php $iterations = 0; foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($user->getJmeno(), ENT_NOQUOTES) ?></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($user->getEmail(), ENT_NOQUOTES) ?></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($user->getTelefon(), ENT_NOQUOTES) ?></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($user->getDatumRegistrace(), ENT_NOQUOTES) ?></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getUlice(), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getMesto(), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getCP(), ENT_NOQUOTES) ?>

                        <?php if ($user->getAdresa()->getCO()=== '') { ?>/<?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getCO(), ENT_NOQUOTES) ;} ?>

                        <?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getPSC(), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($user->getAdresa()->getStat(), ENT_NOQUOTES) ?>

                    </td>
                </tr>
<?php $iterations++; } ?>
    </table>
</div><?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start(function () {});}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}