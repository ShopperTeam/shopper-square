<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:start',
    description: 'Start development tools: Symfony, npm dev-server, npm watch',
)]
class RunDevCommand extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $io->text($this->getLogo());


        $this->launchInNewTerminal('symfony server:start', 'Symfony Server');

        $this->launchInNewTerminal('npm run build', 'npm build');

        $this->launchInNewTerminal('npm run dev-server', 'npm dev-server');

        $this->launchInNewTerminal('npm run watch', 'npm watch');

        $io->success("Mode <DEV/> activé");

        return Command::SUCCESS;
    }

    private function launchInNewTerminal($command, $title, $autoClose = true)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $process = new Process([
                'cmd.exe',
                '/C',
                'start',
                'cmd.exe',
                '/K',
                'title ' . $title . ' && ' . $command . ($autoClose ? ' && exit' : '')
            ]);
        } else {
            $commandWithExit = $command . ($autoClose ? ' && exit' : '');
            $process = new Process(['gnome-terminal', '--', 'bash', '-c', $commandWithExit]);
        }

        $process->setTimeout(null);
        $process->start();
        return $process;
    }
    
    protected function getLogo():string{
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
