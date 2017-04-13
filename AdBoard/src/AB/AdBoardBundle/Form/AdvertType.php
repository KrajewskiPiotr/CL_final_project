<?php

namespace AB\AdBoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AB\AdBoardBundle\Entity\Advert;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title')
                ->add('description')
                ->add('creationTime')
                ->add('image', FileType::class, array( 'label' => 'Add image', 'data_class' => null))
                ->add('user')
                ->add('category', EntityType::class, array(
                'class' => 'AB\AdBoardBundle\Entity\Category',
                'choice_label' => 'name',
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Advert::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ab_adboardbundle_advert';
    }


}
