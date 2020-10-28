<?phpuse GDO\Audio\GDO_Album;
use GDO\UI\GDT_Card;
use GDO\UI\GDT_Label;use GDO\UI\GDT_EditButton;use GDO\Audio\GDO_SongAlbum;use GDO\Audio\GDT_Track;/** @var $gdo GDO_Album **/

$card = GDT_Card::make('card-' . $gdo->getID())->gdo($gdo);

$card->title($gdo->gdoColumn('album_title'));
$card->avatar($gdo->gdoColumn('album_cover')->withFileInfo(false));$card->subtitle(GDT_Label::make()->label('album_subtitle', [$gdo->displayBand(), $gdo->displayReleased()]));foreach (GDO_SongAlbum::getSongs($gdo) as $song){    $track = GDT_Track::make()->album($gdo)->song($song);    $card->addField($track);}if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make()->href($gdo->hrefEdit()));}$card->editorFooter();
echo $card->render();
