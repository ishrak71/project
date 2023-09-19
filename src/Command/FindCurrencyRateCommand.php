<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


use App\Service\ConversionClass;
use App\Service\CsvGenerator;


#[AsCommand(
    name: 'app:findCurrencyRate',
    description: 'Finds currency rates ',
    hidden:false,
    aliases: ['app:find-rate']
)]



class FindCurrencyRateCommand extends Command
{

    public function __construct()
    {
        parent::__construct();

    }

    protected function configure(): void
    {
        $this


            // $amountToConvert, $cuurencyInput, $cuurencyOutput
            ->setDescription('Description of your command')
            ->addArgument('amount', InputArgument::REQUIRED, 'Amount To Convert')
            ->addArgument('cuurencyInput', InputArgument::REQUIRED, 'Curency Label which is going to be converted -- AUD USD EUR NZD GBP ')
            ->addArgument('cuurencyOutput', InputArgument::REQUIRED, 'Curreny Label in which the amount will be converted into -- AUD USD EUR NZD GBP')

            
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $amountToConvert = $input->getArgument('amount');
        $cuurencyInput = $input->getArgument('cuurencyInput');
        $cuurencyOutput = $input->getArgument('cuurencyOutput');


        //Create an instance of ConversionClass 
        $myNewInstance = new ConversionClass;

        //The returned value from the method is saved in the variable
        $totalAmount = $myNewInstance->getTheCurrencyCombination($amountToConvert, $cuurencyInput, $cuurencyOutput ); //total

        // An array to save all the information input by user and the results after the input values are processed 
        $arr = array([$amountToConvert, $cuurencyInput, $cuurencyOutput, $totalAmount]);

        //This allows us to determine which rate should be used
        $rate = $cuurencyInput . '-' . $cuurencyOutput;

        //create a file name based on the currency combination
        $filename = ($rate .'-' . $amountToConvert . '.csv');

        //create a CSV file with data from $arr inside $filename
        $csvGenerator = new CsvGenerator();
        if ($csvGenerator->generateCSV($arr, $filename)) {
            echo "CSV file generated successfully!";
        } else {
            echo "Failed to generate CSV file.";
        }

       

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
