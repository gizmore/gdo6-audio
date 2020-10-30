<?phpuse GDO\UI\GDT_Card;
use GDO\Audio\GDO_Song;use GDO\UI\GDT_EditButton;/** @var $gdo GDO_Song **/

$card = GDT_Card::make('card-' . $gdo->getID())->gdo($gdo);

$card->title($gdo->gdoColumn('song_title'));
$card->subtitle($gdo->gdoColumn('song_band'));$card->addField($gdo->gdoColumn('song_bpm'));$card->addField($gdo->gdoColumn('song_duration'));$card->addField($gdo->gdoColumn('song_lyrics'));$card->editorFooter();if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make()->href($gdo->hrefEdit()));}
echo $card->render();
