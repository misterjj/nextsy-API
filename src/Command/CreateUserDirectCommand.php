<?php

namespace App\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

#[AsCommand(
    name: 'app:create-user-direct',
    description: 'Créer un utilisateur directement en base de données',
)]
class CreateUserDirectCommand extends Command
{
    public function __construct(
        private readonly Connection                     $connection,
        private readonly PasswordHasherFactoryInterface $passwordHasherFactory
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l\'utilisateur')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe en clair')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Créer un administrateur');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');

        // Hasher le mot de passe
        $passwordHasher = $this->passwordHasherFactory->getPasswordHasher('App\Entity\User');
        $hashedPassword = $passwordHasher->hash($plainPassword);

        // Définir les rôles
        $roles = ['ROLE_USER'];
        if ($input->getOption('admin')) {
            $roles[] = 'ROLE_ADMIN';
        }
        $rolesJson = json_encode($roles);

        try {
            // Insérer directement en base
            $this->connection->insert('user', [
                'email' => $email,
                'password' => $hashedPassword,
                'roles' => $rolesJson
            ]);

            $io->success(sprintf('Utilisateur "%s" créé avec succès en base de données !', $email));
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('Erreur lors de l\'insertion : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}