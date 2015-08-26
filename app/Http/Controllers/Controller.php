<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Helpers\DocumentHelper;
use App\Helpers\CreditcardHelper;

class Controller extends BaseController
{
    protected $document;
    protected $creditcard;
  
    public function __construct(DocumentHelper $document, CreditcardHelper $creditcard)
    {
      $this->document = $document;
      $this->creditcard = $creditcard;
    }
  
    public function generateCpf($formatted = false)
    {
      return $this->document->cpf($formatted);
    }
    
    public function generateCnpj($formatted = false)
    {
      return $this->document->cnpj($formatted);
    }
    
    public function generateCreditCard($flag = null)
    {
      return $this->creditcard->get($flag);
    }

    public function generateCreditCardJson($flag = null)
    {
      return $this->creditcard->getJson($flag);
    }

    public function listCreditCardFlags()
    {
      return $this->creditcard->getList();
    }
}
