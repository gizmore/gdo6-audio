<?phpuse GDO\UI\GDT_Card;
use GDO\Audio\GDO_Song;use GDO\Audio\GDT_MusicianInstrument;
use GDO\UI\GDT_EditButton;use GDO\UI\GDT_Accordeon;use GDO\UI\GDT_Divider;use GDO\Audio\GDT_SongSubtitle;/** @var $gdo GDO_Song **/

$card = GDT_Card::make('card-' . $gdo->getID())->gdo($gdo);
if ($gdo->isFeatured()){    $card->addClass('featured');}
$card->title($gdo->gdoColumn('song_title'));
$card->subtitle(GDT_SongSubtitle::make()->song($gdo));$card->addField($gdo->gdoColumn('song_description'));$card->addField($gdo->gdoColumn('song_bpm'));$card->addField($gdo->gdoColumn('song_duration'));$card->addField(GDT_Accordeon::make()->title('lyrics')->textRaw($gdo->displayLyrics()));$card->addField($gdo->gdoColumn('song_file')->withPlayer()->withControls()->withDownload());$card->addField(GDT_Divider::make('divider')->label('musicians'));foreach ($gdo->getMusicians() as $musician){    $card->addField(GDT_MusicianInstrument::make()->song($gdo)->musician($musician));}if ($gdo->canEdit()){    $card->actions()->addField(GDT_EditButton::make()->href($gdo->hrefEdit()));}
echo $card->render();
