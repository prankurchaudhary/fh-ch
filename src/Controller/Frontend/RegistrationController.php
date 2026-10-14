<?php

namespace App\Controller\Frontend;

use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\DataObject\WebsiteUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\City\Listing as CityListing;
use App\Form\RegistrationFormType;
use App\Service\MailerService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\WebsiteUser\Listing;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Uid\Uuid;
use App\Service\EmailService;


class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'frontend_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        MailerService $mailer, EmailService $emailService
    ): Response {
        // Load active cities from Pimcore
        $cities = new CityListing();
        $cities->setCondition('active = 1');
        $cities->setOrderKey('name');
        $cities->setOrder('ASC');
        $errors = [];
        $success = false;

        if ($request->isMethod('POST')) {
            //print_r($request->request); exit;

            $email     = trim($request->request->get('email'));
            $firstName = trim($request->request->get('firstName'));
            $lastName  = trim($request->request->get('lastName'));
            $city      = trim($request->request->get('city'));
            $password  = trim($request->request->get('password'));
            $subscribeNewsletter = (bool) $request->request->get('newsletter');
             // --- Validation ---
            if (empty($email)) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please enter a valid email.";
            }

            if (empty($firstName)) {
                $errors['firstName'] = "First name is required.";
            }

            if (empty($lastName)) {
                $errors['lastName'] = "Last name is required.";
            }

            if (empty($city)) {
                $errors['city'] = "Please select a city.";
            }

            if (!$password) {
                $errors['password'] = "Password is required";
            } elseif (strlen($password) < 6) {
                $errors['password'] = "Password must be at least 6 characters";
            }
            if (empty($errors)) {
                // Check if email already exists
                $existing = WebsiteUser::getByEmail($email, 1);
                if ($existing) {
                    $this->addFlash('error', 'Email already registered.');
                    return $this->redirectToRoute('frontend_register');
                }

                // Find or create folder "Site Users"
                $folder = Folder::getByPath('/Site Users');
                if (!$folder) {
                    $folder = new Folder();
                    $folder->setKey('Site Users');
                    $folder->setPath('/');
                    $folder->save();
                }

                // Create WebsiteUser object
                $user = new WebsiteUser();
                $user->setParent($folder);
                $user->setKey(uniqid('user-'));
                $user->setPublished(true);

                $user->setEmail($email);
                $user->setFirstname($firstName);
                $user->setLastname($lastName);
                $user->setHandle($firstName.'-'.$lastName);
                // Load city object from submitted ID
                if (!empty($city)) {                                    
                    $cityObj = City::getById($city);
                    
                    if ($cityObj instanceof City) {
                       // $user->setCity($cityObj);
                    
                    }
                }          
                $user->setSubscribeForNewsletter($subscribeNewsletter);

            // hash & save password
                $plainPassword = $request->request->get('password');
                $hashedPassword = $passwordHasher->hashPassword(
                    new \App\Security\WebsiteUserAdapter($user),
                    $plainPassword
                );

                $user->setPassword($hashedPassword);
                

                // token
                $token = Uuid::v4()->toRfc4122();
                $user->setEmailVerificationToken($token);
                $user->setTokenExpiresAt(\Carbon\Carbon::now()->addHours(24));
                $user->setEmailVerified(false);
                $user->save();  
                
                $verificationLink = $this->generateUrl(
                    'frontend_verify_email',
                    ['token' => $token],
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $mailer->sendVerificationEmail(
                    $user,
                    $verificationLink
                );
                // SEND EMAIL USING PIMCORE DOCUMENT
                // $emailService->sendEmail(
                //     '/Emails/welcome-mail',
                //     $email,
                //     [
                //         'user' => $user,
                //         'verificationUrl' => $verificationLink
                //     ],
                //     'Welcome to Chowzter',
                //     'prankurchaudhary@gmail.com'
                // );
                $success = true;

                $this->addFlash('success', 'Registration successful! Check your email to verify your account.');

                return $this->redirectToRoute('frontend_login');
            }
        }

        return $this->render('frontend/auth/register.html.twig', [
            'cities' => $cities,
            'errors' => $errors,
            'success' => $success
        ]);
    }

    #[Route('/verify-email/{token}', name: 'frontend_verify_email')]
    public function verify(string $token, Request $request): Response
    {
        $request->getSession()->start();
        $token = $request->get('token');
        print $token; 
            
        if (!$token) {
            $this->addFlash('error', 'Invalid verification link.');            
            return $this->redirectToRoute('frontend_login');
        }

        $user = new WebsiteUser\Listing();
        $user->setCondition('emailVerificationToken = ?', [$token]);
        $user = $user->load();
        $userObj = $user[0] ?? null; 

        if (!$userObj) {
            //print "came here"; die;
            $this->addFlash('error', 'Invalid or expired token.');
            
            return $this->redirectToRoute('frontend_login');
        }


        // Check expiry
        if ($userObj->getTokenExpiresAt() < new \DateTimeImmutable()) {
            $this->addFlash('error', 'Token expired. Please request a new verification email.');
            return $this->redirectToRoute('frontend_login');
        }
        //print "here"; die;

        $userObj->setEmailVerified(true);
        $userObj->setEmailVerificationToken(null);
        $userObj->setTokenExpiresAt(null);
        $userObj->save();

        $this->addFlash('success', 'Email verified successfully! You can now log in.');
        return $this->redirectToRoute('frontend_login');
    }

    #[Route('/test-mail')]
    public function testMail(MailerInterface $mailer): Response
    {
        // $email = (new Email())
        //     ->from('prankurchaudhary@gmail.com')
        //     ->to('prankur.c@gmail.com')
        //     ->subject('SMTP Test')
        //     ->text('This is a test email');

        // $mailer->send($email);

        // return new Response('Mail sent');

        // PIMCORE MAIL TEST
        //dynamic parameters
        $params = array('firstName' => 'Pim',
                        'lastName' => 'Core',
                        
                        );
        
        //sending the email
        $mail = new \Pimcore\Mail();
        $mail->to('prankur.c@gmail.com');
        $mail->setDocument('/Emails/welcome-mail');
        $mail->setParams($params);
        $mail->send();
        return new Response('Mail sent');


    }
    #[Route('/forgot-password', name: 'frontend_forgot_password')]
    public function forgotPassword(Request $request, MailerService $mailer): Response
    {
        $request->getSession()->start();

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');

            $list = new WebsiteUser\Listing();
            $list->setCondition('email = ?', [$email]);
            $list->setLimit(1);

            $user = $list->load()[0] ?? null;

            if ($user) {
                $token = \Symfony\Component\Uid\Uuid::v4()->toRfc4122();

                $user->setPasswordResetToken($token);
                $user->setPasswordResetExpiresAt(
                    \Carbon\Carbon::now()->addHours(24)
                );
                $user->save();

                // send email (pseudo)
                // https://your-site/reset-password/{token}
                $verificationLink = $this->generateUrl(
                    'frontend_reset_password',
                    ['token' => $token],
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $mailer->sendResetPasswordEmail(
                    $user,
                    $verificationLink
                );
            }

            // Always show success (avoid email enumeration)
            $this->addFlash('success', 'If the email exists, a reset link has been sent.');
            return $this->redirectToRoute('frontend_login');
        }

        return $this->render('frontend/auth/forgot_password.html.twig');
    }

    #[Route('/reset-password/{token}', name: 'frontend_reset_password', priority: 10, 
    requirements: [
        'token' => '[0-9a-f\-]{36}'
    ])]
    public function resetPassword(
        string $token,
        Request $request,
        UserPasswordHasherInterface $hasher
    ): Response {
        $user  = $this->getUser();
        //dd($user);
        if ($user) {
                if ($user instanceof WebsiteUser) {
                    $this->addFlash('info', 'You are already logged in.');
                    return $this->redirectToRoute('frontend_login');
            }
        }
        $request->getSession()->start();

        $list = new WebsiteUser\Listing();
        $list->setCondition('passwordResetToken = ?', [$token]);
        $list->setLimit(1);

        $user = $list->load()[0] ?? null;

        if (!$user || $user->getPasswordResetExpiresAt() < \Carbon\Carbon::now()) {
            $this->addFlash('error', 'Invalid or expired reset link.');
            return $this->redirectToRoute('frontend_login');
        }

        if ($request->isMethod('POST')) {
            $password = $request->request->get('password');

            $hashed = $hasher->hashPassword(new \App\Security\WebsiteUserAdapter($user),
                    $password);

            $user->setPassword($hashed);
            $user->setPasswordResetToken(null);
            $user->setPasswordResetExpiresAt(null);
            $user->save();

            $this->addFlash('success', 'Password reset successful. Please login.');
            return $this->redirectToRoute('frontend_login');
        }

        return $this->render('frontend/auth/reset_password.html.twig', [
            'token' => $token
        ]);
    }

}
