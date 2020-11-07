<?phpuse GDO\Audio\GDT_AudioFile;
/** @var $field GDT_AudioFile **/
?>
<audio<?php if ($field->withControls) : ?>
controls<?php endif; ?>
src="<?=$field->displayPreviewHref($field->getValue())?>"><?=t('err_no_html_audio')?></audio>