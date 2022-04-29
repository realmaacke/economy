<?php 
include('autoload.php');

$chart = Currency::Chart();
$most_spent = Currency::HighestSpent();
$balance = Currency::CurrentBalance();
$currency = Currency::showCurrency();

$transactions = Currency::TotalTransactions();

$percentage = Currency::get_percentage($balance[0]["ammount"], $most_spent);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Visual/style.css">
    <title>Economy</title>
</head>
<body>

<div class="container">


    <div class="row">
        <div class="section-box">

        <!-- SMALL BOXES START -->
            <div class="section-small-boxes">

                <div class="row-no-center">
    
                    <div class="card-body">

                        <div class="card-title">
                            <p>Balance</p>
                        </div>

                        <div class="card-main">

                            <h2><?php echo $balance[0]['ammount'], " ",$currency; ?></h2>

                        </div>

                        <div class="card-bottom">

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="card-title">
                            <p>Transactions</p>
                        </div>

                        <div class="card-main">

                            <h2><?php echo $transactions; ?></h2>

                        </div>

                        <div class="card-bottom">
                            <p> <span style="color: green">10.57% </span> More since Last Month</p>
                        </div>

                    </div>

                </div>

                <div class="row-no-center">
                    
                    <div class="card-body">

                        <div class="card-title">
                            <p>Highest spent</p>
                        </div>

                        <div class="card-main">

                            <h2><?php echo $most_spent, " SEK"; ?></h2>

                        </div>

                        <div class="card-bottom">
                            <p> <span style="color: green"><?php echo $percentage; ?>%  </span> More than current balance</p>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="card-title">
                            <p>Empty</p>
                        </div>

                        <div class="card-main">

                            <h2>0000 SEK</h2>

                        </div>

                        <div class="card-bottom">
                            <p> <span style="color: green">0.00% </span> Since Last Month</p>
                        </div>

                    </div>
                </div>



            </div>

            <!-- SMALL BOXES END -->

            <!-- Transactions table start -->

                <div class="transactions-table">
                    <!-- title start -->
                    <div class="transactions-title">
                        <div>Name of transaction</div>
                        <div>Date of purchase</div>
                        <div>Cost of purchase</div>
                    </div>
                    <!-- title ends -->

                    <!-- transaction orders start -->
                    <?php 
                    
                    echo Currency::DisplayTransactions();
                    
                    ?>
                    
                    <!-- transaction orders ends -->
                </div>

            <!-- transactions table end -->
        </div>
    </div>

    <div class="row">

        <div class="section-box">

            <div class="selection-settings">
                    <!-- SETTINGS SQUARES START -->
                    <div class="row-no-center">

                        <div class="card-body">
                            <div class="card-title">
                                <p>SET BALANCE</p>
                            </div>

                            <div class="card-main">
                                <input type="text" name="" placeholder="Amount of money" id="">
                                <input type="submit" value="CHANGE">
                            </div>

                            <div class="card-bottom">
                                <p>123</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-title">
                                <p>ADD TRANSACTION</p>
                            </div>

                            <div class="card-main">
                                <h2>TXT</h2>
                            </div>

                            <div class="card-bottom">
                                <p>123</p>
                            </div>
                        </div>


                    </div>

                    <div class="row-no-center">

                        <div class="card-body">
                            <div class="card-title">
                                <p>RESET ALL DATA</p>
                            </div>

                            <div class="card-main">
                                <h2>TXT</h2>
                            </div>

                            <div class="card-bottom">
                                <p>123</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-title">
                                <p>RESET TRANSACTIONS</p>
                            </div>

                            <div class="card-main">
                                <h2>TXT</h2>
                            </div>

                            <div class="card-bottom">
                                <p>123</p>
                            </div>
                </div>
            </div>
                     <!-- SETTINGS SQUARES ENDS -->
            </div>

                <div class="selection-diagram" id="chartContainer">

                </div>
        </div>
    </div>




</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	//theme: "light2",
	title:{
		text: "Transactions"
	},
	axisX:{
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: "COST",
		includeZero: true,
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: "area",
		dataPoints: <?php echo $chart ?>
	}]
});
chart.render();
 
}
</script>
</body>
</html>