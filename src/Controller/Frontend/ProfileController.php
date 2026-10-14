<?php

namespace App\Controller\Frontend;

use App\Security\WebsiteUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[Route('/profile')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('', name: 'frontend_profile')]
    public function view(): Response
    {
        /** @var WebsiteUser $user */
        $user = $this->getUser();

        return $this->render('frontend/profile/view.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit', name: 'frontend_profile_edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        /** @var WebsiteUser $user */
        $user = $this->getUser();

        // Create profile edit form
        $form = $this->createFormBuilder($user)
            ->add('fullName', TextType::class, [
                'required' => true,
                'label' => 'Full Name'
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email Address'
            ])
            ->add('currentPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Current Password (only if changing)',
            ])
            ->add('newPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'New Password',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Update Profile'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();

            // Handle password change only if entered
            if ($newPassword) {
                if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $this->addFlash('error', 'Current password is incorrect');
                    return $this->redirectToRoute('frontend_profile_edit');
                }

                $hashed = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashed);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Profile updated successfully.');

            return $this->redirectToRoute('frontend_profile');
        }

        return $this->render('frontend/profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
