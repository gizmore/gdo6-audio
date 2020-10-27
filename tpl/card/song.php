<?phpuse GDO\UI\GDT_Card;
use GDO\Audio\GDO_Song;/** @var $gdo GDO_Song **/

$card = GDT_Card::make('card-' . $gdo->getID());

$card->title($gdo->displayTitle());
$card->subtitle(t('song_subtitle', []));
echo $card->render();
