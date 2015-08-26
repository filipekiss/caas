<?php 

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Http\Response;

class CreditcardHelper
{
  protected $cards;
  protected $aliases;

  public function __construct(Collection $collection)
  {
    $this->cards = new Collection();
    $this->cards->put('amex', new Collection(["378282246310005", "371449635398431"]));
    $this->cards->put('amex-corp', new Collection(["378734493671000"]));
    $this->cards->put('australian-bankcard', new Collection(["5610591081018250"]));
    $this->cards->put('diners', new Collection(["30569309025904", "38520000023237"]));
    $this->cards->put('discover', new Collection(["6011111111111117", "6011000990139424"]));
    $this->cards->put('jcb', new Collection(["3530111333300000", "3566002020360505"]));
    $this->cards->put('mastercard', new Collection(["5555555555554444", "5105105105105100"]));
    $this->cards->put('visa', new Collection(["4111111111111111", "4012888888881881", "4222222222222"]));
    $this->cards->put('dankort', new Collection(["76009244561", "5019717010103742"]));
    $this->cards->put('switch', new Collection(["6331101999990016"]));
    $this->aliases = new Collection();
    $this->aliases->put('australian-bankcard', new Collection(['australian', 'bank-card']));
    $this->aliases->put('dankort', new Collection(['pbs']));
    $this->aliases->put('switch', new Collection(['solo', 'paymentech']));
  }
  
  public function get($alias = null)
  {
    $cardResponse = $this->getCard($alias);
    if ($cardResponse->get('status') === '404') {
      return (new Response(null, 404));
    }
    return $cardResponse->get('number');
  }
  
  public function getCard($alias = null)
  {
    $result = new Collection();
    $flag = $this->resolveFlagAlias($alias);
    if ($flag) {
      $cards = $this->cards->get($flag);
      if (!$cards) {
        $result->put('status', '404');
        $result->put('message', 'No cards found for the flag ' . $alias);
        return $result;
      }
      $cardnumber = $cards->random();
      $result->put('flag', $alias);
      $result->put('number', $cardnumber);
      return $result;
    }
    $flag = $this->cards->keys()->random();
    $cardnumber = $this->cards->get($flag)->random();
    $result->put('flag' , $flag);
    $result->put('number' , $cardnumber);
    return $result;
  }
  
  public function getJson($alias) {
    $cardResponse = $this->getCard($alias);
    if ($cardResponse->get('status') === '404') {
      return (new Response($cardResponse->toJson(), 404));
    }
    return $cardResponse->toJson();
  }
  
  public function resolveFlagAlias($alias)
  {
    if (!$alias) {
      return null;
    }
    foreach($this->aliases as $flag => $aliases) {
      $hasAlias = $aliases->search($alias);
      if ($hasAlias !== false) {
        return $flag;
      }
    }
    return $alias;
  }
}