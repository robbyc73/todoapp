<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppHelloWorldCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:hello-world')
            ->setDescription('simple hello world cmd')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description', 'World')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln('Hello '.$argument);
    }

}
