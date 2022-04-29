<?php

class Currency
{

    public static function showCurrency()
    {
        $result = DB::query('SELECT type_of_currency FROM preferences LIMIT 1')[0]['type_of_currency'];
        
        return $result;
    }


    public static function UpdateBalance($balance, $from, $till)
    {
        $verify = DB::query('SELECT * FROM balance');
        $message = "";

        if(count($verify) == 0)
        {
            $message = "There is no balance to update";
        }
        else 
        {
            $update = DB::query('UPDATE balance SET id=NULL ammount=:balance from=:from till=:till', array(':balance'=>$balance, ':from'=>$from, ':till'=>$till));
            $message = "Success";
        }

    
        return $message;
    }


    public static function add_transaction($name, $date, $cost)
    {
        if(db::query('INSERT INTO transaction VALUES(NULL, :name, :cost)', array(':name'=>$name, ':cost'=>$cost))){
            return true;
        }else {
            return false;
        }
    }


    public static function DisplayTransactions()
    {
        $result = DB::query('SELECT * FROM transaction');
        $currency = DB::query('SELECT type_of_currency FROM preferences')[0]['type_of_currency'];
        foreach($result as $r)
        {

            echo '<div class="transactions-rows">
                    <div>'.ucwords($r['name']).'</div>
                    <div>'.$r['date'].'</div>
                    <div>'.$r['cost'].' '.$currency.'</div>
                    </div>';
        }
    }

    public static function SwapCurrency($currency)
    {
        DB::query('UPDATE preferences SET type_of_currency =:currency', array(':currency'=>$currency));
    }


    public static function Chart()
    {
        $transactions = DB::query('SELECT * FROM transaction');
        $dataPoints = array();
        
        foreach($transactions as $t){
            $temparray = array("label"=>$t['date'], "y"=> $t['cost']);
            array_push($dataPoints, $temparray);
        }

        return json_encode($dataPoints, JSON_NUMERIC_CHECK);
    }

    public static function HighestSpent()
    {
        $transactions = DB::query('SELECT * FROM transaction');

        $object = array();
        foreach($transactions as $t)
        {
            array_push($object, $t['cost']);
        }

        $most = max($object);

        return $most;

    }

    public static function CurrentBalance()
    {
        return DB::query('SELECT ammount FROM balance');
    }

    public static function TotalTransactions(){
        $result = DB::query('SELECT * FROM transaction');
        $times = 0;

        foreach($result as $r)
        {
            $times++;
        }

        return $times;
    }

    public static function get_percentage($number, $total)
    {
      if ( $total > 0 ) {
       return round(($number * 100) / $total, 2);
      } else {
        return 0;
      }
    }


}