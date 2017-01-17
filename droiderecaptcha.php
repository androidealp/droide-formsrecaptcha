<?php

defined('_JEXEC') or die ();

//require('lip/recaptchalib.php');

include_once (JPATH_ROOT.DS.'plugins'.DS.'droideforms'.DS.'droiderecaptcha'.DS.'lib'.DS.'droide-recaptcha.v2.php');

/**
 * Plugin para droideforms que utiliza o droide-recaptcha com a v2 da api do google recapchat
 * @example https://github.com/androidealp/droide-formsrecaptcha - url da extensão
 * @author André Luiz Pereira <andre@next4.com.br>
 */
class plgDroideformsDroiderecaptcha extends JPlugin{

  public $erros = null;
  public $recaptcha = '';
    public function __construct(&$subject, $config)
     {
        $this->recaptcha = new DroideRecaptcha($this->params->get('site_key',''), $this->params->get('secret_key',''));

        parent::__construct($subject, $config);
     }

     /**
      * Metodo para tratar Trigger antes de carregar o layout
      * @author André Luiz Pereira <andre@next4.com.br>
      * @param int $id_form - id do formulário
      * @param string $js - script de chamada para ajax
      * @param array $params - parametros da extensão
      * @param array $validacao - parametros da validacao
      * @param array $custom_vars - variaveis customizadas de outros plugins
      * @return void
      */
     public function onDroideformsBeforeLayout(&$id_form, &$js, &$params, &$validacao, &$custom_vars)
     {
       //secret 6LfLohEUAAAAAB6AkDvfy9XN9h_LHIX-7CkhOfYm
       //$custom_vars['capcha'] = recaptcha_get_html('6LfLohEUAAAAAHT77DLWUDErEPD6ke9zBfTAege1', $this->erros);
       $custom_vars['capcha'] = $this->recaptcha->html();
     }

     /**
      * Adicione o Trigger para validar o captcha
      * @author André Luiz Pereira <andre@next4.com.br>
      * @param array $post - dados vindos pelo post
      * @param array $validFiltros - parametros da validacao
      * @param array $errors - array para inserir possiveis erros ocorridos
      * @param array $custom_vars - variaveis customizadas de outros plugins
      * @return void
      */
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

}
