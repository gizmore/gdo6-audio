<?phpuse GDO\Audio\GDO_Album;
use GDO\UI\GDT_Card;use GDO\Audio\GDT_BandSubtitle;
use GDO\UI\GDT_EditButton;use GDO\Audio\GDO_SongAlbum;use GDO\Audio\GDT_Track;/** @var $gdo GDO_Album **/

$card = GDT_Card::make('card-' . $gdo->getID())->gdo($gdo);

$card->title($gdo->gdoColumn('album_title'));
$card->avatar($gdo->gdoColumnCopy('album_cover')->withFileInfo(false)->variant('thumb'));$card->subtitle(GDT_BandSubtitle::make()->band($gdo->getBand()));foreach (GDO_SongAlbum::getSongs($gdo) as $song){    $track = GDT_Track::make()->album($gdo)->song($song);    $card->addField($track);}if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make()->href($gdo->hrefEdit()));}// $card->editorFooter();
echo $card->render();
