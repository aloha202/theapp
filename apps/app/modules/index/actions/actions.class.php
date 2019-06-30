<?php

/**
 * index actions.
 *
 * @package    cms
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }


  public function executeLoad(sfWebRequest $request){
      $this->getResponse()->setContentType('text/javascript');
      return $this->renderPartial('index/load.js');
  }
}
