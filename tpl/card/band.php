<?phpuse GDO\UI\GDT_Card;
use GDO\Audio\GDO_Band;use GDO\UI\GDT_EditButton;use GDO\DB\GDT_UInt;/** @var $gdo GDO_Band **/

$card = GDT_Card::make('card-' . $gdo->getID());$card->title($gdo->gdoColumn('band_name'));$card->addField($gdo->gdoColumn('band_founded'));$card->addField($gdo->gdoColumn('band_country'));$card->addField($gdo->gdoColumn('band_genre'));$card->addField(GDT_UInt::make('num_songs')->initial($gdo->numSongsAvailable()));if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make('btn_edit')->href(href('Audio', 'BandCRUD', "&id={$gdo->getID()}")));}echo $card->render();