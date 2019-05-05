<?php


namespace App\Command;


use App\UserAge\UserAgeCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;


class AgeCalculator extends Command
{
    protected static $defaultName = 'app:age:calculator';

    private $userAge;

    public function __construct(UserAgeCalculator $userAge)
    {
        $this->userAge = $userAge;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Calculates age by given birthday')
            ->setHelp('This command calculates user age by given birthday. If option --adult setted writes if user 
            adult');

        $this
            // configure an argument
            ->addArgument('birthday', InputArgument::REQUIRED, 'The birthday of the user.')
            // ...
        ;

        $this
            // ...
            ->addOption(
                'adult',
                null,
                InputOption::VALUE_NONE,
                'Is user adult or not?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $birthday = $input->getArgument('birthday');
        $optionValue = $input->getOption('adult');
        $age = $this->userAge->getAge($birthday);

        $io = new SymfonyStyle($input, $output);
        $io->newLine();

        $io->note('I am '. $age .' years old');

        $io->newLine();

        if ($optionValue !== false)
        {
            if ($this->userAge->isAdult($age))
            {
                $io->success('Am I an adult ?  ----  YES !!');

            }else{

                $io->warning('Am I an adult ?  ----  NO !!!');


            }


        }
        $io->newLine();
    }
}