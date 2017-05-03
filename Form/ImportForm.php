<?php

namespace Qweluke\CSVImporterBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'form.file',
                'required' => true,
                'translation_domain' => 'qwelukecsvimporter',
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'mimeTypes' => ['text/csv', 'text/plain']
                    ])
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'qwelukecsvimporter'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'import';
    }
}
