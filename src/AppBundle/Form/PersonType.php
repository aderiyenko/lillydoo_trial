<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.19
 * Time: 10:15
 */

namespace AppBundle\Form;

use AppBundle\Form\Transformers\DatetimeToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Intl\Intl;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Intl::getRegionBundle()->getCountryNames();

        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('street_address', TextType::class)
            ->add('zip', TextType::class)
            ->add('city', TextType::class)
            ->add('country', CountryType::class, [
                'choices' => array_flip($countries)
            ])
            ->add('phone', TextType::class)
            ->add('dob', TextType::class, [
                'label' => 'Birthday',
                'attr' => [
                    'class' => 'datepicker'
                ],
            ])
            ->add('email', EmailType::class)
            ->add('picture', FileType::class, [
                'data_class' => null,
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Upload a photo'
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'waves-effect waves-light btn'
                ],
            ])
        ;

        $builder->get('dob')->addModelTransformer(new DatetimeToStringTransformer());
    }
}