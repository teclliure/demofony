<?php

/**
 * Doctrine form base class that makes it pretty easy to embed one or multiple related forms including creation forms.
 *
 * @package    ahDoctrineEasyEmbeddedRelationsPlugin
 * @subpackage form
 * @author     Daniel Lohse <info@asaphosting.de>
 * @author     Krzysztof Kotowicz <kkotowicz at gmail dot com>
 * @author     Gadfly <gadfly@linux-coders.org>
 * @author     Fabrizio Bottino <fabryb@fabryb.com>
 */
abstract class ahBaseFormDoctrine extends sfFormDoctrine
{
  protected
    $scheduledForDeletion = array(), // related objects scheduled for deletion
    $embedRelations = array(),       // so we can check which relations are embedded in this form
    $defaultRelationSettings = array(
        'considerNewFormEmptyFields' => array(),
        'noNewForm' => false,
        'newFormLabel' => null,
        'newFormClass' => null,
        'newFormClassArgs' => array(),
        'formClass' => null,
        'formClassArgs' => array(),
        'displayEmptyRelations' => false,
        'newFormAfterExistingRelations' => false,
        'customEmbeddedFormLabelMethod' => null,
        'formFormatter' => null,
        'multipleNewForms' => false,
        'newFormsInitialCount' => 2,
        'newFormsContainerForm' => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
        'newRelationButtonLabel' => '+',
        'newRelationAddByCloning' => true,
        'newRelationUseJSFramework' => 'jQuery'
    );

  protected function addDefaultRelationSettings(array $settings)
  {
    return array_merge($this->defaultRelationSettings, $settings);
  }

  public function embedRelations(array $relations)
  {
    $this->embedRelations = $relations;

    $this->getEventDispatcher()->connect('form.post_configure', array($this, 'listenToFormPostConfigureEvent'));

    foreach ($relations as $relationName => $relationSettings)
    {
      $relationSettings = $this->addDefaultRelationSettings($relationSettings);

      $relation = $this->getObject()->getTable()->getRelation($relationName);
      if (!$relationSettings['noNewForm'])
      {
        $containerName = 'new_'.$relationName;
        $formLabel = $relationSettings['newFormLabel'];
        if (!$relation->isOneToOne())
        {
          if ($relationSettings['multipleNewForms']) // allow multiple new forms for this relation
          {
            $newFormsCount = $relationSettings['newFormsInitialCount'];

            $subForm = $this->newFormsContainerFormFactory($relationSettings, $containerName);
            for ($i = 0; $i < $newFormsCount; $i++)
            {
              // we need to create new forms with cloned object inside (otherwise only the last new values would be saved)
              $newForm = $this->embeddedFormFactory($relationName, $relationSettings, $relation, $i + 1);
              $subForm->embedForm($i, $newForm);
            }
            $subForm->getWidgetSchema()->setLabel($formLabel);
            $this->embedForm($containerName, $subForm);
          }
          else // just a single new form for this relation
          {
            $newForm = $this->embeddedFormFactory($relationName, $relationSettings, $relation, $formLabel);
            $this->embedForm($containerName, $newForm);
          }
        }
        elseif ($relation->isOneToOne() && !$this->getObject()->relatedExists($relationName))
        {
          $newForm = $this->embeddedFormFactory($relationName, $relationSettings, $relation, $formLabel);
          $this->embedForm($containerName, $newForm);
        }
      }
      
      $formClass = (null === $relationSettings['formClass']) ? $relation->getClass().'Form' : $relationSettings['formClass'];
      $formArgs = (null === $relationSettings['formClassArgs']) ? array() : $relationSettings['formClassArgs'];
      if ((isset($formArgs[0]) && !array_key_exists('ah_add_delete_checkbox', $formArgs[0])) || !isset($formArgs[0]))
      {
        $formArgs[0]['ah_add_delete_checkbox'] = true;
      }
      
      if ($relation->isOneToOne())
      {
        $form = new $formClass($this->getObject()->$relationName, $formArgs[0]);
        $this->embedForm($relationName, $form);
        
        //maybe we need this: if (!$this->getObject()->relatedExists($relationName))
        unset($this[$relation->getLocalColumnName()]);
      }
      else
      {
        $subForm = new sfForm();
        
        foreach ($this->getObject()->$relationName as $index => $childObject)
        {
          $form = new $formClass($childObject, $formArgs[0]);
          
          $subForm->embedForm($index, $form);
          // check if existing embedded relations should have a different label
          if (null === $relationSettings['customEmbeddedFormLabelMethod'] || !method_exists($childObject, $relationSettings['customEmbeddedFormLabelMethod']))
          {
            $subForm->getWidgetSchema()->setLabel($index, (string)$childObject);
          }
          else
          {
            $subForm->getWidgetSchema()->setLabel($index, $childObject->$relationSettings['customEmbeddedFormLabelMethod']());
          }
        }
        
        $this->embedForm($relationName, $subForm);
      }

      if ($relationSettings['formFormatter']) // switch formatter
      {
        $widget = $this[$relationName]->getWidget()->getWidget();
        $widget->setFormFormatterName($relationSettings['formFormatter']);
        // not only we have to change formatter name
        // but also recreate schemadecorator as there is no setter for decorator in sfWidgetFormSchemaDecorator :(
        $this->widgetSchema[$relationName] = new sfWidgetFormSchemaDecorator($widget, $widget->getFormFormatter()->getDecoratorFormat());
      }

      /*
       * Unset the relation form(s) if:
       * (1. One-to-many relation and there are no related objects yet (count of embedded forms is 0) OR
       * 2. One-to-one relation and embedded form is new (no related object yet))
       * AND
       * (3. Option `displayEmptyRelations` was either not set by the user or was set by the user and is false)
       */
      if (
        (
          (!$relation->isOneToOne() && count($this->getEmbeddedForm($relationName)->getEmbeddedForms()) === 0) ||
          ($relation->isOneToOne() && $this->getEmbeddedForm($relationName)->isNew())
        ) &&
        !$relationSettings['displayEmptyRelations']
      )
      {
        unset($this[$relationName]);
      }

      if (
        $relationSettings['newFormAfterExistingRelations'] &&
        isset($this[$relationName]) && isset($this['new_'.$relationName])
      )
      {
        $this->getWidgetSchema()->moveField('new_'.$relationName, sfWidgetFormSchema::AFTER, $relationName);
      }
    }

    $this->getEventDispatcher()->disconnect('form.post_configure', array($this, 'listenToFormPostConfigureEvent'));
  }

  public function listenToFormPostConfigureEvent(sfEvent $event)
  {
    $form = $event->getSubject();

    if ($form instanceof sfFormDoctrine && $form->getOption('ah_add_delete_checkbox', false) && !$form->isNew())
    {
      $form->setWidget('delete_object', new sfWidgetFormInputCheckbox(array('label' => 'Delete')));
      $form->setValidator('delete_object', new sfValidatorPass());

      return $form;
    }

    return false;
  }

  /**
   * Here we just drop the embedded creation forms if no value has been
   * provided for them (this simulates a non-required embedded form),
   * please provide the fields for the related embedded form in the call
   * to $this->embedRelations() so we don't throw validation errors
   * if the user did not want to add a new related object
   *
   * @see sfForm::doBind()
   */
  protected function doBind(array $values)
  {
    foreach ($this->embedRelations as $relationName => $keys)
    {
      $keys = $this->addDefaultRelationSettings($keys);

      if (!$keys['noNewForm'])
      {
        $containerName = 'new_'.$relationName;

        if ($keys['multipleNewForms']) // just a single new form for this relation
        {
          if (array_key_exists($containerName, $values))
          {
            foreach ($values[$containerName] as $index => $subFormValues)
            {
              if ($this->isNewFormEmpty($subFormValues, $keys))
              {
                unset($values[$containerName][$index], $this->embeddedForms[$containerName][$index]);
                unset($this->validatorSchema[$containerName][$index]);
              }
              else
              {
                // if new forms were inserted client-side, embed them here
                if (!isset($this->embeddedForms[$containerName][$index]))
                {
                  // create and embed new form
                  $relation = $this->getObject()->getTable()->getRelation($relationName);
                  $addedForm = $this->embeddedFormFactory($relationName, $keys, $relation, ((int) $index) + 1);
                  $ef = $this->embeddedForms[$containerName];
                  $ef->embedForm($index, $addedForm);
                  // ... and reset other stuff (symfony loses all this since container form is already embedded)
                  $this->validatorSchema[$containerName] = $ef->getValidatorSchema();
                  $this->widgetSchema[$containerName] = new sfWidgetFormSchemaDecorator($ef->getWidgetSchema(), $ef->getWidgetSchema()->getFormFormatter()->getDecoratorFormat());
                  $this->setDefault($containerName, $ef->getDefaults());
                }
              }
            }
          }

          $this->validatorSchema[$containerName] = $this->embeddedForms[$containerName]->getValidatorSchema();

          // check for new forms that were deleted client-side and never submitted
          foreach (array_keys($this->embeddedForms[$containerName]->embeddedForms) as $index)
          {
            if (!array_key_exists($index, $values[$containerName]))
            {
                unset($this->embeddedForms[$containerName][$index]);
                unset($this->validatorSchema[$containerName][$index]);
            }
          }

          if (count($values[$containerName]) === 0) // all new forms were empty
          {
            unset($values[$containerName], $this->validatorSchema[$containerName]);
          }
        }
        else
        {
          if (!array_key_exists($containerName, $values) || $this->isNewFormEmpty($values[$containerName], $keys))
          {
            unset($values[$containerName], $this->validatorSchema[$containerName]);
          }
        }
      }

      if (isset($values[$relationName]))
      {
        $oneToOneRelationFix = $this->getObject()->getTable()->getRelation($relationName)->isOneToOne() ? array($values[$relationName]) : $values[$relationName];
        foreach ($oneToOneRelationFix as $i => $relationValues)
        {
          if (isset($relationValues['delete_object']) && $relationValues['id'])
          {
            $this->scheduledForDeletion[$relationName][$i] = $relationValues['id'];
          }
        }
      }
    }
    
    parent::doBind($values);
  }

  /**
   * Updates object with provided values, dealing with eventual relation deletion
   *
   * @see sfFormDoctrine::doUpdateObject()
   */
  protected function doUpdateObject($values)
  {
    if (count($this->getScheduledForDeletion()) > 0)
    {
      foreach ($this->getScheduledForDeletion() as $relationName => $ids)
      {
        $relation = $this->getObject()->getTable()->getRelation($relationName);
        foreach ($ids as $index => $id)
        {
          if ($relation->isOneToOne())
          {
            unset($values[$relationName]);
          }
          else
          {
            unset($values[$relationName][$index]);
          }

          if (!$relation->isOneToOne())
          {
            unset($this->object[$relationName][$index]);
          }
          else
          {
            $this->object->clearRelated($relationName);
          }

          Doctrine::getTable($relation->getClass())->findOneById($id)->delete();
        }
      }
    }

    parent::doUpdateObject($values);
    
    // set foreign key here
  }
  
  public function getScheduledForDeletion()
  {
    return $this->scheduledForDeletion;
  }

  /**
   * Saves embedded form objects.
   * TODO: Check if it's possible to use embedRelations in one form and and also use embedRelations in the embedded form!
   *       This means this would be possible:
   *         1. Edit a user object via the userForm and
   *         2. Embed the groups relation (user-has-many-groups) into the groupsForm and embed that into userForm and
   *         2. Embed the permissions relation (group-has-many-permissions) into the groupsForm and
   *         3. Just for kinks, embed the permissions relation again (user-has-many-permissions) into the userForm
   *
   * @param mixed $con   An optional connection object
   * @param array $forms An array of sfForm instances
   *
   * @see sfFormObject::saveEmbeddedForms()
   */
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $con) $con = $this->getConnection();
    if (null === $forms) $forms = $this->getEmbeddedForms();

    foreach ($forms as $form)
    {
      if ($form instanceof sfFormObject)
      {
        /**
         * we know it's a form but we don't know what (embedded) relation it represents;
         * this is necessary because we only care about the relations that we(!) embedded
         * so there isn't anything weird happening
         */
        $relationName = $this->getRelationByEmbeddedFormClass($form);
        
        if ($relationName && isset($this->scheduledForDeletion[$relationName]) && array_key_exists($form->getObject()->getId(), array_flip($this->scheduledForDeletion[$relationName])))
        {
          continue;
        }
        
        $form->getObject()->save($con);
        $form->saveEmbeddedForms($con);
      }
      else
      {
        $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
      }
    }
  }

  /**
   * Get the used relation alias when given an embedded form
   *
   * @param sfForm $form A BaseForm instance
   */
  private function getRelationByEmbeddedFormClass($form)
  {
    foreach ($this->getObject()->getTable()->getRelations() as $relation)
    {
      $class = $relation->getClass();
      if ($form->getObject() instanceof $class)
      {
        return $relation->getAlias();
      }
    }

    return false;
  }
  
  /**
     * Get the used relation alias when given an object
     *
     * @param $object
     */
    private function getRelationAliasByObject($object)
    {
      foreach ($object->getTable()->getRelations() as $alias => $relation)
      {
        $class = $relation->getClass();
        if ($this->getObject() instanceof $class)
        {
          return $alias;
        }
      }
    }

  /**
   * Checks if given form values for new form are 'empty' (i.e. should the form be discarded)
   * @param array $values
   * @param array $keys settings for the embedded relation
   * @return bool
   */
  protected function isNewFormEmpty(array $values, array $keys)
  {
    if (count($keys['considerNewFormEmptyFields']) == 0 || !isset($values)) return false;

    $emptyFields = 0;
    foreach ($keys['considerNewFormEmptyFields'] as $key)
    {
      if (is_array($values[$key]))
      {
        if (count($values[$key]) === 0)
        {
          $emptyFields++;
        }
        elseif (array_key_exists('tmp_name', $values[$key]) && $values[$key]['tmp_name'] === '' && $values[$key]['size'] === 0)
        {
          $emptyFields++;
        }
      }
      elseif ('' === trim($values[$key]))
      {
        $emptyFields++;
      }
    }

    if ($emptyFields === count($keys['considerNewFormEmptyFields']))
    {
      return true;
    }

    return false;
  }

  /**
   * Creates and initializes new form object for a given relation.
   * @internal
   * @param string $relationName
   * @param array $relationSettings
   * @param Doctrine_Relation $relation
   * @param string $formLabel
   * @return sfFormDoctrine
   */
  private function embeddedFormFactory($relationName, array $relationSettings, Doctrine_Relation $relation, $formLabel = null)
  {
      $newFormObject = $this->embeddedFormObjectFactory($relationName, $relation);
      $formClass = (null === $relationSettings['newFormClass']) ? $relation->getClass().'Form' : $relationSettings['newFormClass'];
      $formArgs = (null === $relationSettings['newFormClassArgs']) ? array() : $relationSettings['newFormClassArgs'];
      $r = new ReflectionClass($formClass);

      /* @var $newForm sfFormObject */
      $newForm = $r->newInstanceArgs(array_merge(array($newFormObject), $formArgs));
      $newFormIdentifiers = $newForm->getObject()->getTable()->getIdentifierColumnNames();
      foreach ($newFormIdentifiers as $primaryKey)
      {
        unset($newForm[$primaryKey]);
      }
      unset($newForm[$relation->getForeignColumnName()]);

      // FIXME/TODO: check if this even works for one-to-one
      // CORRECTION 1: Not really, it creates another record but doesn't link it to this object!
      // CORRECTION 2: No, it can't, silly! For that to work the id of the not-yet-existant related record would have to be known...
      // Think about overriding the save method and after calling parent::save($con) we should update the relations that:
      //   1. are one-to-one AND
      //   2. are LocalKey :)
      if (null !== $formLabel)
      {
        $newForm->getWidgetSchema()->setLabel($formLabel);
      }

      return $newForm;
  }

  /**
   * Returns Doctrine Record object prepared for form given the relation
   * @param string $relationName
   * @param Doctrine_Relation $relation
   * @return Doctrine_Record
   */
  private function embeddedFormObjectFactory($relationName, Doctrine_Relation $relation)
  {
    if (!$relation->isOneToOne())
    {
      $newFormObjectClass = $relation->getClass();
      $newFormObject = new $newFormObjectClass();
      $newFormObject[$this->getRelationAliasByObject($newFormObject)] = $this->getObject();
    } else
    {
      $newFormObject = $this->getObject()->$relationName;
    }

    return $newFormObject;
  }

  /**
   * Create and initialize form that will embed 'newly created relation' subforms
   * If no object is given in 'newFormsContainerForm' parameter, it will
   * initialize custom form bundled with this plugin
   * @param array $relationSettings
   * @return sfForm (ahNewRelationsContainerForm by default)
   */
  private function newFormsContainerFormFactory(array $relationSettings, $containerName)
  {
    $subForm = $relationSettings['newFormsContainerForm'];

    if (null === $subForm)
    {
      $subForm = new ahNewRelationsContainerForm(null, array(
        'containerName' => $containerName,
        'addByCloning' => $relationSettings['newRelationAddByCloning'],
        'useJSFramework' => $relationSettings['newRelationUseJSFramework'],
        'newRelationButtonLabel' => $relationSettings['newRelationButtonLabel']
      ));
    }

    if ($relationSettings['formFormatter']) {
      $subForm->getWidgetSchema()->setFormFormatterName($relationSettings['formFormatter']);
    }

    unset($subForm[$subForm->getCSRFFieldName()]);
    return $subForm;
  }
}
