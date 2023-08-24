<?php

namespace App\Command;

use RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:config-env',
    description: 'Configure the environment by interactively generating .env.local',
)]
class ConfigEnvCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Create .env.local from scratch even if it exists')
            ->addOption('no-logo',null, InputOption::VALUE_NONE, 'Don\'t show logo.');
        }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        if(!$input->getOption('no-logo')) $io->text($this->getLogo());

        // check if .env.local exist if not, this will help you create one.
        if (!$this->checkEnvLocal($input, $output)) {
            $io->error("Erreur lors de la création de .env.local");
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }

    protected function checkEnvLocal(InputInterface $input, OutputInterface $output): bool
    {
        $res = false;
        $io = new SymfonyStyle($input, $output);
        $filesystem = new Filesystem();
        $forceOption = $input->getOption('force');
        $fileExist = $filesystem->exists('.env.local');
        if (!$fileExist || $forceOption) {
            $helper = new QuestionHelper();
            if ($forceOption) {
                $io->text("Création d'une nouvelle DATABASE_URL: ");
            } else {
                $question = new Question('Le fichier .env.local n\'existe pas. Voulez-vous le créer ? (y/n) [y]', 'y');
                $answer = $helper->ask($input, $output, $question);
                if ($answer !== 'y') {
                    $io->warning('Opération annulée.');
                    return $res;
                }
            }


            $userName = $helper->ask($input, $output, new Question('Nom d\'utilisateur MySQL [root] : ', 'root'));
            $passWord = $helper->ask($input, $output, new Question("Mot de passe MySQL [''] : ", ""));
            $dbname = $helper->ask($input, $output, new Question('Nom de la base de donnée [shopper-square] : ', 'shopper-square'));
            $port = $helper->ask($input, $output, new Question('Numéro de port MySQL [3306] : ', '3306'));
            $dataBaseUrl = "mysql://$userName:$passWord@localhost:$port/$dbname\n";
            $envContent = "DATABASE_URL=$dataBaseUrl";
            try {
                $filesystem->dumpFile('.env.local', $envContent);
                if($forceOption) $io->success('La phrase de connection à été créer avec succées.');
                if(!$fileExist) $io->success('Le fichier .env.local a été créé avec succès.');
                $res = true;
            } catch (RuntimeException $e) {
                $io->error('Une erreur est survenue lors de la création du fichier .env.local : ' . $e->getMessage());
            }
        } else {
            $io->info(".env.local Existe déja.");
            $res = true;
        }
        return $res;
    }

    protected function getLogo(): string
    {
        // show logo project
        return "
        ███████╗██╗  ██╗ ██████╗ ██████╗ ██████╗ ███████╗██████╗       ███████╗ ██████╗ ██╗   ██╗ █████╗ ██████╗ ███████╗
        ██╔════╝██║  ██║██╔═══██╗██╔══██╗██╔══██╗██╔════╝██╔══██╗      ██╔════╝██╔═══██╗██║   ██║██╔══██╗██╔══██╗██╔════╝
        ███████╗███████║██║   ██║██████╔╝██████╔╝█████╗  ██████╔╝█████╗███████╗██║   ██║██║   ██║███████║██████╔╝█████╗  
        ╚════██║██╔══██║██║   ██║██╔═══╝ ██╔═══╝ ██╔══╝  ██╔══██╗╚════╝╚════██║██║▄▄ ██║██║   ██║██╔══██║██╔══██╗██╔══╝  
        ███████║██║  ██║╚██████╔╝██║     ██║     ███████╗██║  ██║      ███████║╚██████╔╝╚██████╔╝██║  ██║██║  ██║███████╗
        ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝     ╚══════╝╚═╝  ╚═╝      ╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝                                                                                                               
        ";
    }
}
