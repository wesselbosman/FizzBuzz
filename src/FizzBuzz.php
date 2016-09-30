<?php
/**
 * Created by PhpStorm.
 * User: Wessel Bosman
 * Date: 9/30/2016
 * Time: 9:47 PM
 */
namespace FizzBuzz\Command {

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    use Symfony\Component\Console\Input\InputArgument;
    use Symfony\Component\Console\Question\ConfirmationQuestion;


    class FizzBuzzCommand extends Command
    {
        protected function configure()
        {
            $this
                //Input arguments for the FizzBuzz command that specifies the start and end of the range
                ->addArgument('Start', InputArgument::REQUIRED, 'The Start of the range we will iterate over')
                ->addArgument('End', InputArgument::REQUIRED, 'The End of the range we will iterate over')

                // The command to add to the script)
                ->setName('exec')

                // the short description shown while running "php bin/console list"
                ->setDescription("
                outputs each number from Start to End (inclusive) on a new line, subject to the following rules:
                if the number is divisible by 3, then the application prints \"Fizz\";
                if the number is divisible by 5, then the application prints \"Buzz\"; 
                if the number is divisible by 3 and 5 then the application prints \"FizzBuzz\". 
                The application will terminate after a single run.\n")

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp("Enter a start and end number for the application to print the Fizz/Buzz/FizzBuzz state of the number being iterated over")
            ;
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            /*
             * Get the input from the passed arguments and set them as variables for later use as
             * floor and ceiling values for the range we will define to itterate over.
            */

            $start = $input->getArgument('Start');
            $end = $input->getArgument('End');

            //Output the range to the console so that the user can easily be reminded of their input

            $output->writeln('Start: '.$start);
            $output->writeln('End: '.$end);

            //Create an array range of the numbers entered decrementing/incrementing by the step (1)

            $range = range($start,$end,1);

            //iterate over all the values in the array range
            foreach ($range as $value){

                //switch case using the modulus operator to determine if the values are divisible by 3 & 5, 3 and 5 respectively and writing the output to the console.
                switch ($value){
                    case abs($value % 3 == 0) && abs($value % 5 == 0):
                        $output->write($value.": ");
                        $output->write("FizzBuzz\n");
                        break;

                    case abs($value % 3) == 0:
                        $output->write($value.": ");
                        $output->write("Fizz\n");
                        break;

                    case abs($value % 5) == 0:
                        $output->write($value.": ");
                        $output->write("Buzz\n");
                        break;
                }
            }

            //To set the app apart from a standard PHP script, I ask the user for input into the console.

            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion('Application will now terminate, press any key', false);

            if (!$helper->ask($input, $output, $question)) {
                return;
            }
        }
    }
}

