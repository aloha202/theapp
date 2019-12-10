<?php

/**
 * WebsiteProject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class WebsiteProject extends BaseWebsiteProject
{
    public function getCodebase(){
        if($this->codebase_type == 'input'){
            return $this->getCodebaseInput() . "\n";
        }else if($this->codebase_type == 'file'){
            $file = sfConfig::get('sf_data_dir') . '/codebase' . $this->codebase_file;
            if(!file_exists($file)){
                $code = "\$content.append('File {$file} does not exist')";
            }else{
                $code = file_get_contents($file);
            }
            $code .= "\n";
            return $code;
        }
    }

    public function getWebsite()
    {
        if($this->website_id) {
            return $this->_get('Website'); // TODO: Change the autogenerated stub
        }
        return 'All';
    }
}
