<?php
/** @var $field GDT_AudioFile **/
?>
<audio
controls
src="<?=$field->displayPreviewHref($field->getValue())?>"><?=t('err_no_html_audio')?></audio>