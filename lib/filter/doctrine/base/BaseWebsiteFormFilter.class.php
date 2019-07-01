<?php

/**
 * Website filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWebsiteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'namespace' => new sfWidgetFormFilterInput(),
      'url'       => new sfWidgetFormFilterInput(),
      'is_secure' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'namespace' => new sfValidatorPass(array('required' => false)),
      'url'       => new sfValidatorPass(array('required' => false)),
      'is_secure' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('website_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Website';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'namespace' => 'Text',
      'url'       => 'Text',
      'is_secure' => 'Boolean',
    );
  }
}
