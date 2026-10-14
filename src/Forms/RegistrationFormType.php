<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\City\Listing as CityListing;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Pimcore\Model\DataObject\WebsiteUser;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Load all city objects
        $cities = new CityListing();
        $cities->setOrderKey("name");
        $cities->setOrder("ASC");

        $cityChoices = [];
        foreach ($cities as $city) {
            $cityChoices[$city->getName()] = $city->getId(); // label => object ID
        }

        $builder
            ->add('email', EmailType::class, ['required' => true])
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('city', ChoiceType::class, [
                'choices' => $cityChoices,
                'placeholder' => 'Select City',
                'required' => true,
            ])
            ->add('subscribeForNewsletter', CheckboxType::class, [
                'required' => false,
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
            'data_class' => WebsiteUser::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
        }
}
