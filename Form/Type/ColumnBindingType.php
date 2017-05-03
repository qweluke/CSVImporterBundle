<?php
/**
 * Created by PhpStorm.
 * User: Łukasz Malicki
 * Date: 2017-05-02
 * Time: 10:48 PM
 */

namespace Qweluke\CSVImporterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ColumnBindingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $requiredFields = $options['requiredFields'];
        $choices = $options['choices'];

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($choices, $requiredFields) {
                $form = $event->getForm();
                $data = $event->getData();

                $columnName = $data['column'];

                $required = false;

                $checkboxOption = [
                    'required' => false
                ];

                if (in_array(strtolower($columnName), $requiredFields)) {
                    $required = true;

                    $checkboxOption = [
                        'required' => true,
                        'data' => true
                    ];
                }

                $formOptions = array(
                    'empty_data' => null,
                    'choices' => $choices,
                    'required' => $required,
                );

                // create the field, this is similar the $builder->add()
                // field name, field type, data, options
                $form->add('checkbox', CheckboxType::class, $checkboxOption);

                $form->add('mappedChoice', ChoiceType::class, $formOptions);
            }
        );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'field' => '',
            'requiredFields' => [],
            'choices' => [],
        ]);
    }
}