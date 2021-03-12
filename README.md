  ##Duplitrade

#### In the Project:
Apache/2.4.46 (Ubuntu)<br>
PHP:8.0.2<br>
MYSQL:8.0.23<br>
Composer: 2.0.8<br>
Composer packages: 1.Autoload, 2.bramus_router

###Read csv file and save data in DB

1.For db normalize I created 5 tables
  tickets, trading_rooms, types, instruments and statuses
2.For file reading I use CsvReader class src/CsvReader/CsvReader.php .

For speed improvement i tried to use the "Function Generator"
but with no success. The running time of the script has not decreased

3.For preparing data to insert i use DataSeparatot src/DataSeparator/DataSeparator.php .

 This component creates 5 assoc. arrays for each table
 
4.For aggregate data and create objects i use CsvProcessingController
src/Controllers/CsvProcessingController.php

5.For save data into DB i use Models src/Models. Each model implemented IModel
interface, and extends abstract class MainModel.
All models use DbConnection module src/Db/DbConnection

6.For prepare data to Tickets and alert_tickets tables i use TicketsModelHelperTrait
src/Traits/TicketsModelHelperTrait.php

###Calculate monthly profit and save the result into DB

1. For initialise the process i use ProfitCalculationController 
src/Controllers/ProfitCalculationController.php
This controller use models: TicketsModel src/Models/TicketsModel.php and ProfitCalculateTableModel 
   src/Models/ProfitCalculateTableModel.php
