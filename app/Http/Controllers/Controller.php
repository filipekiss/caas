<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Helpers\DocumentHelper;

class Controller extends BaseController
{
    protected $document;
  
    public function __construct(DocumentHelper $document)
    {
      $this->document = $document;
    }
  
    public function generateCpf($formatted = false)
    {
      return $this->document->cpf($formatted);
    }
    
    public function generateCnpj($formatted = false)
    {
      return $this->document->cnpj($formatted);
    }
}
