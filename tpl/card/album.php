<?phpuse GDO\Audio\GDO_Album;
use GDO\UI\GDT_Card;
/** @var $gdo GDO_Album **/

$card = GDT_Card::make('card-' . $gdo->getID());

$card->title($gdo->displayTitle());

echo $card->render();
