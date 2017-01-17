<?php

defined('_JEXEC') or die ();

//require('lip/recaptchalib.php');

include_once (JPATH_ROOT.DS.'plugins'.DS.'droideforms'.DS.'droiderecaptcha'.DS.'lib'.DS.'droide-recaptcha.v2.php');

class plgDroideformsDroiderecaptcha extends JPlugin{

  public $erros = null;
  public $recaptcha = '';
    public function __construct(&$subject, $config)
     {
        $this->recaptcha = new DroideRecaptcha('6LdqpREUAAAAAN4EpqrRZFhe44Mb6FDGanEdSqmR', '6LdqpREUAAAAAHngwL0iUVJjKlE41IGgGFyJ_SP1');

        parent::__construct($subject, $config);
     }

     public function onDroideformsBeforeLayout(&$id_form, &$js, &$params, &$validacao, &$custom_vars)
     {
       //secret 6LfLohEUAAAAAB6AkDvfy9XN9h_LHIX-7CkhOfYm
       //$custom_vars['capcha'] = recaptcha_get_html('6LfLohEUAAAAAHT77DLWUDErEPD6ke9zBfTAege1', $this->erros);
       $custom_vars['capcha'] = $this->recaptcha->html();
     }

     public function onDroideformsAddvalidate(&$post, &$validFiltros, &$errors, &$log)
     {
       foreach ($validFiltros['field_name'] as $k => $fild_name) {

         if($fild_name == 'g-recaptcha-response'){

           $response = $this->recaptcha->response($post['g-recaptcha-response']);

           if(!$response->success)
           {
             $errors[] = $validFiltros['text_validador'][$k];
           }

         }
       }

     }

    //  private function validCaptcha($post,$errors,$validador)
    //  {
     //
    //   return $this->recaptcha->response($post);
     //
    //  }

}
