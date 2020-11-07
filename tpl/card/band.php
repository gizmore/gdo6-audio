<?phpuse GDO\UI\GDT_Card;
use GDO\Audio\GDO_Band;use GDO\UI\GDT_EditButton;use GDO\UI\GDT_Link;/** @var $gdo GDO_Band **/

$card = GDT_Card::make('card-' . $gdo->getID())->gdo($gdo);if ($gdo->isFeatured()){    $card->addClass('featured');}$card->title($gdo->gdoColumn('band_name'));$card->addField($gdo->gdoColumn('band_founded'));$card->addField($gdo->gdoColumn('band_country'));$card->addField($gdo->gdoColumn('band_genre'));$card->addField(GDT_Link::make('_num_albums')->initial($gdo->getVar('band_albums'))->href($gdo->hrefAlbums()));$card->addField(GDT_Link::make('_num_songs')->initial($gdo->getVar('band_songs'))->href($gdo->hrefSongs()));if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make('btn_edit')->href(href('Audio', 'BandCRUD', "&band_id={$gdo->getID()}")));}echo $card->render();