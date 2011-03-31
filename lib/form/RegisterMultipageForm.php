<?php
class RegisterMultipageForm extends psPageableForm
{
    public function setup()
    {
        //set name format for all forms
        $this->setNameFormat('register[%s]');
 
        $flag = false;
 
        //If $flag is false, name format will be merged with global pageable form name format.
        //for example: name format for SampleForm is 'sample_form[%s]'
        //merged name format will be 'form[sample_form][%s]', if $flag equals false
        //otherwise name format will be 'form[%s]'
 
        $this->setUseGlobalNamespace($flag); //must be set before addForm/addForms/setForm/setForms methods call!
        $this->addForm(new RegisterForm(array(), array(), false));//disable csrf protection for all forms except last
        $this->addForm(new ProfileForm());//form for last page
    }
}
