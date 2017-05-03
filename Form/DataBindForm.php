<?php

namespace Qweluke\CSVImporterBundle\Form;

use Qweluke\CSVImporterBundle\Form\Type\ColumnBindingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataBindForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = $options['entityFields'];

        /** remove 'id' field as this is autoincrement column */
        if (($key = array_search('id', $fields)) !== false) {
            unset($fields[$key]);
        }

        /** set all required fields to lowercase so we could easly use in_array */
        $requiredFields = array_map('strtolower', $options['requiredFields']);

        /** flip key|value */
        $choices = array_flip($options['csvColumns']);

        $builder->add('columns', CollectionType::class, [
            'entry_type' => ColumnBindingType::class,
            'entry_options' => [
                'requiredFields' => $requiredFields,
                'choices' => $choices
            ],
            'data' => call_user_func(function() use ($fields) {
                /** convert singledimensional array to multidimensional */
                $data = [];
                foreach ($fields as $field) {
                     $data[] = ['column' => $field];
                }
                return $data;
            }),

            'mapped' => false,
        ]);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'qwelukecsvimporter',
            'entityFields' => [],
            'csvColumns' => [],
            'requiredFields' => []
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'databinding';
    }
}
