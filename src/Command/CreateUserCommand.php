<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Repository\User\UserRepositoryInterface;
use App\Utils\PasswordUtil;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class CreateUserCommand extends Command
{
    private $passwordEncoder;
    private $userRepository;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepositoryInterface $userRepository,
        string $name = null
    ) {
        parent::__construct($name);

        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->addArgument(
                'email',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'password',
                InputArgument::OPTIONAL
            )
            ->addOption(
                'is-admin',
                null,
                InputOption::VALUE_OPTIONAL,
                '',
                false
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting...');

        $email = $input->getArgument('email');
        $pass = $input->getArgument('password');
        $needGeneratePass = null === $pass;

        if ($needGeneratePass) {
            $pass = PasswordUtil::generate();
        }

        $user = new User($email);

        $passwordHash = $this->passwordEncoder->encodePassword($user, $pass);

        $user->setPassword($passwordHash);

        if ($input->getOption('is-admin')) {
            $user->grantAdminAccess();
        }

        try {
            $this->userRepository->save($user);
        } catch (UniqueConstraintViolationException $e) {
            $output->writeln(\sprintf('<error>User already exists with given email "%s"</error>', $email));

            return 1;
        }

        if ($needGeneratePass) {
            $output->writeln(\sprintf('<info>Password: %s</info>', $pass));
        }

        $output->writeln('User successfully created!');
    }
}
