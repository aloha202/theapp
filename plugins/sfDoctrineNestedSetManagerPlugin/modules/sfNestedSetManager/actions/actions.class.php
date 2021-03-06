<?php
/**
 * sfNestedSetManagerActions 
 * 
 * @uses sfActions
 * @package 
 * @version $id$
 * @copyright 2006-2007 Jonathan H. Wage
 * @author Jonathan H. Wage <jonwage@gmail.com> 
 * @license See LICENSE that came packaged with this software
 */
class sfNestedSetManagerActions extends sfActions
{
  public function getTree($model, $rootId = 0)
  {
    if( $rootId )
    {
      $root = Doctrine::getTable($model)->getTree()->findRoot($rootId);
    
      return Doctrine::getTable($model)->getTree()->fetchBranch($root->getId()); 
    } else {
      return Doctrine::getTable($model)->getTree()->fetchTree();
    }
  }

  public function executeAdd_child()
  {
    $parent_id = $this->getRequestParameter('parent_id');
    $model = $this->getRequestParameter('model');
    $root = $this->getRequestParameter('root');

    $record = Doctrine::getTable($model)->find($parent_id);

    $child = new $model;
    $record->getNode()->addChild($child);
    
    $this->records = $this->getTree($model, $root);
  }
  
  public function executeAdd_root()
  {
    $model = $this->getRequestParameter('model');
    $tree = $this->getTree($model);
    
    $root = new $model;

    Doctrine::getTable($model)->getTree()->createRoot($root);
    $this->records = $this->getTree($model);
  }

  public function executeEdit_field()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $field = $this->getRequestParameter('field');
    $value = $this->getRequestParameter('value');

    $record = Doctrine::getTable($model)->find($id);
    $record->set($field, $value);
    $record->save();

    return sfView::NONE;
  }

  public function executeDelete()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $root = $this->getRequestParameter('root');
    
    $record = Doctrine::getTable($model)->find($id);
    $record->getNode()->delete();
  
    $this->records = $this->getTree($model, $root);
  }

  public function executeMove()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $direction = $this->getRequestParameter('direction');
    $root = $this->getRequestParameter('root');
    
    $record = Doctrine::getTable($model)->find($id);
    
    if( $direction == 'up' )
    {
      $prev = $record->getNode()->getPrevSibling();
      $record->getNode()->moveAsPrevSiblingOf($prev);
    }
    else if( $direction == 'down' )
    {
      $next = $record->getNode()->getNextSibling();
      $record->getNode()->moveAsNextSiblingOf($next);
    }
    
    $this->records = $this->getTree($model, $root);
  }

  public function executeMove_to()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $root = $this->getRequestParameter('root');
    
    $record = Doctrine::getTable($model)->find($id);
  
    $this->records = $this->getTree($model, $root);
  }

  public function executeDo_move_to()
  {
    $id = $this->getRequestParameter('id');
    $to_id = $this->getRequestParameter('to_id');
    $model = $this->getRequestParameter('model');
    $root = $this->getRequestParameter('root');
    
    $record = Doctrine::getTable($model)->find($id);
    $record_to = Doctrine::getTable($model)->find($to_id);

    $record->getNode()->moveAsFirstChildOf($record_to);
    $this->records = $this->getTree($model, $root);
  }
}
