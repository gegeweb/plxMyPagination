<?php if(!defined('PLX_ROOT')) exit; ?>
<?php
/**
 *
 * Plugin	plxMyPagination
 * @author	Gérald Niel
 * @version	1.0
 * @date	26/10/2015 
 **/
 
# Control du token du formulaire
plxToken::validateFormToken($_POST);

if(!empty($_POST)) {
	var_dump($_POST);
	$plxPlugin->setParam('elmt0', plxUtils::getValue($_POST['elmt0']), 'numeric');
	$plxPlugin->setParam('elmt1', plxUtils::getValue($_POST['elmt1']), 'numeric');
	$plxPlugin->setParam('elmt2', plxUtils::getValue($_POST['elmt2']), 'numeric');
	$plxPlugin->setParam('elmt6', plxUtils::getValue($_POST['elmt6']), 'numeric');
	$plxPlugin->setParam('elmt3', plxUtils::getValue($_POST['elmt3']), 'numeric');
	$plxPlugin->setParam('elmt4', plxUtils::getValue($_POST['elmt4']), 'numeric');
	$plxPlugin->setParam('elmt5', plxUtils::getValue($_POST['elmt5']), 'numeric');
	$plxPlugin->setParam('nbdisp', plxUtils::getValue($_POST['nbdisp']), 'numeric');
	$plxPlugin->saveParams();
	header('Location: parametres_plugin.php?p=plxMyPagination');
	exit;
}
$sel=' checked="checked"';
$elmt0 = ($plxPlugin->getParam('elmt0')==1 OR $plxPlugin->getParam('elmt0')=='')?$sel:'';
$elmt1 = ($plxPlugin->getParam('elmt1')==1 OR $plxPlugin->getParam('elmt1')=='')?$sel:'';
$elmt2 = ($plxPlugin->getParam('elmt2')==1 OR $plxPlugin->getParam('elmt2')=='')?$sel:'';
$elmt6 = ($plxPlugin->getParam('elmt6')==1 OR $plxPlugin->getParam('elmt6')=='')?$sel:'';
$elmt3 = ($plxPlugin->getParam('elmt3')==1 OR $plxPlugin->getParam('elmt3')=='')?$sel:'';
$elmt4 = ($plxPlugin->getParam('elmt4')==1 OR $plxPlugin->getParam('elmt4')=='')?$sel:'';
$elmt5 = ($plxPlugin->getParam('elmt5')==1 OR $plxPlugin->getParam('elmt5')=='')?$sel:'';
$nbdisp = $plxPlugin->getParam('nbdisp') !=='' ? $plxPlugin->getParam('nbdisp') : '5';
?>

<h2>Configuration</h2>
<form class="inline-form" id="form_plxMyPagination" action="parametres_plugin.php?p=plxMyPagination" method="post">
	<fieldset class="withlabel">
		<p><?php $plxPlugin->lang('L_PAGER_CHECK_LIB') ?></p>
		<p>
			<input<?php echo $elmt1 ?> type="checkbox" id="id_elmt1" name="elmt1" value="1" />
			<label for="id_elmt1"><?php echo L_PAGINATION_FIRST_TITLE ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_first"><i class="fa fa-fast-backward"></i><span class="hide">'.L_PAGINATION_FIRST.'</span></span>' ?>
		</p>
		<p>
			<input<?php echo $elmt2 ?> type="checkbox" id="id_elmt2" name="elmt2" value="1" />		
			<label for="id_elmt2"><?php echo L_PAGINATION_PREVIOUS_TITLE ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_prev"><i class="fa fa-step-backward"></i><span class="hide">'.L_PAGINATION_PREVIOUS.'</span></span>' ?>
		</p>
		<p>
			<input<?php echo $elmt6 ?> type="checkbox" id="id_elmt6" name="elmt6" value="1" />
			<label for="id_elmt6"><?php $plxPlugin->lang('L_PAGER_PAGES') ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_page">1</span>' ?>
		</p>
		<p style="margin-left: 2em;">
			<input<?php echo $elmt3 ?> type="checkbox" id="id_elmt3" name="elmt3" value="1" />
			<label for="id_elmt3"><?php $plxPlugin->lang('L_PAGER_INDICATOR') ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_page">&hellip;</span>' ?>
		</p>
		<p>
			<input<?php echo $elmt4 ?> type="checkbox" id="id_elmt4" name="elmt4" value="1" />		
			<label for="id_elmt4"><?php echo L_PAGINATION_NEXT_TITLE ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_next"><i class="fa fa-step-forward"></i><span class="hide">'.L_PAGINATION_NEXT.'</span></span>' ?>
		</p>
		<p>
			<input<?php echo $elmt5 ?> type="checkbox" id="id_elmt5" name="elmt5" value="1" />		
			<label for="id_elmt5"><?php echo L_PAGINATION_LAST_TITLE ?>&nbsp;:</label>
			<?php echo '<span class="pagenav p_last"><i class="fa fa-fast-forward"></i><span class="hide">'.L_PAGINATION_LAST.'</span></span>' ?>
		</p>
		<p>
			<input<?php echo $elmt0 ?> type="checkbox" id="id_elmt0" name="elmt0" value="1" />			
			<label for="id_elmt0"><?php $plxPlugin->lang('L_PAGER_NUM_PAGES') ?>&nbsp;:</label>
			<?php printf('<span class="p_pager">'.ucfirst(L_PAGINATION).'</span>',4,10) ?>
		</p>
		<p>
			<label for="id_nbdisp"><?php $plxPlugin->lang('L_PAGER_NAX_PAGES') ?>:</label>
			<input type="number" id="id_nbdisp" name="nbdisp" min="3" value="<?php echo $nbdisp ?>" />			
		</p>
		<p class="in-action-bar">
			<?php echo plxToken::getTokenPostMethod() ?>
			<input type="submit" name="submit" value="<?php $plxPlugin->lang('L_PAGER_SAVE') ?>" />
		</p>
	</fieldset>
</form>
<div id="pagination">
<ul class="pagination">
<?php
if($elmt1!='')echo '<li><a href="#" title="'.L_PAGINATION_FIRST_TITLE.'" class="pagenav"><i class="fa fa-fast-backward"></i><span class="hide">'.L_PAGINATION_FIRST.'</span></a></li>';
if($elmt2!='')echo '<li><a href="#" title="'.L_PAGINATION_PREVIOUS_TITLE.'" class="pagenav"><i class="fa fa-step-backward"></i><span class="hide">'.L_PAGINATION_PREVIOUS.'</span></a></li>';

if($elmt6!='') {

	$stop_p = 3 + round($nbdisp/2) ;
	if( $stop_p < $nbdisp ) $stop_p = $nbdisp;
	if( $stop_p > 10 ) $stop_p = 10;
	$start_p = $stop_p - $nbdisp + 1;
	if($elmt3!='' and $start_p > 1)echo '<li><span class="pagenav">&hellip;</span></li>';
	if($start_p < 1 ) $start_p = 1;
	for( $j = $start_p; $j <= $stop_p; $j++ ) {
		($j == 4 ) ? $html_str = '<li><span class="pagenav p_current">4</span></li>' : $html_str = '<li><a href="#" title="Page '.$j.'" class="pagenav">'.$j.'</a></li>';
		echo $html_str;
	}
	if($elmt3!='' and $stop_p < 10) echo '<li><span class="pagenav">&hellip;</span></li>';

} else {
	echo '<li><span class="pagenav p_current">4</span></li>';
}
if($elmt4!='') echo '<li><a href="#" title="'.L_PAGINATION_NEXT_TITLE.'" class="pagenav p_next"><span class="hide">'.L_PAGINATION_NEXT.'</span><i class="fa fa-step-forward"></i></a</li>';
if($elmt5!='') echo '<li><a href="#" title="'.L_PAGINATION_LAST_TITLE.'" class="pagenav p_last"><span class="hide">'.L_PAGINATION_LAST.'</span><i class="fa fa-fast-forward"></i></a></li>';
?>
</ul>
<?php
if($elmt0!='') printf('<p class="p_pager">'.ucfirst(L_PAGINATION).'</p>',4,10);
?>
</div>
<h2>Affichage (styles)</h2>
<p>
	<?php $plxPlugin->lang('L_PAGER_CSS_DESCRIPTION') ?>
</p>
<ul>
	<li>div#pagination : <?php $plxPlugin->lang('L_PAGER_CSS_CONTAINER') ?></li>
	<li>ul.pagination li : <?php $plxPlugin->lang('L_PAGER_CSS_LI') ?></li>
	<li>ul.pagination li .pagenav : <?php $plxPlugin->lang('L_PAGER_CSS_ITEM') ?></li>
	<li>.p_first : <?php $plxPlugin->lang('L_PAGER_CSS_FIRST') ?></li>
	<li>.p_prev : <?php $plxPlugin->lang('L_PAGER_CSS_PREV') ?></li>
	<li>.p_current : <?php $plxPlugin->lang('L_PAGER_CSS_CURRENT') ?></li>
	<li>.p_next : <?php $plxPlugin->lang('L_PAGER_CSS_NEXT') ?></li>
	<li>.p_last : <?php $plxPlugin->lang('L_PAGER_CSS_LAST') ?></li>
	<li>.p_pager : <?php $plxPlugin->lang('L_PAGER_NUM_PAGES') ?></li>
</ul>
