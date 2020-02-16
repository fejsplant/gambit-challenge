<?php
//actionTest();
    if (isset($_POST['callFunction']) )
    {
        $toCall = $_POST['callFunction'];

        switch ($toCall) {
            case 'getRawData':
                echo getRawData();
                break;
            case 'getFileDate':
                echo getFileDate();
                break;
            case 'getFlowRate':
                echo getFlowRate();
                break;
            case 'createTable':
                echo json_encode(getParsedArray());
                break;
        }
    }

     function getRawData(){

        $return  = file_get_contents('http://tuftuf.gambitlabs.fi/feed.txt');
        echo json_encode($return);

    }

    function getFileDate(){
        $rawData  = file_get_contents('http://tuftuf.gambitlabs.fi/feed.txt');
        $rawArray = explode("\n",$rawData);
        echo json_encode($rawArray[0]);
    }

    /*Singele flowrate fetch and conversion POC test*/
    function getFlowRate(){
        $rawData  = file_get_contents('http://tuftuf.gambitlabs.fi/feed.txt');
        $rawArray = explode("\n",$rawData);
        $reg1FlowRlow = explode(":",$rawArray[1])[1];
        $reg2FlowRhigh =  explode(":",$rawArray[2])[1];
        $converted =  convertreal4( $reg2FlowRhigh ,$reg1FlowRlow);

        echo json_encode(getParsedArray());
    }

    function getParsedArray($rawDataArray = null){

        $parsedArray = [];

        if(!isset($rawDataArray)){
            $rawDataArray  = getRawDataArray();
        }
        $parsedArray["date"] = $rawDataArray[0];
        $reg1FlowRlow = explode(":",$rawDataArray[1])[1];
        $reg2FlowRhigh =  explode(":",$rawDataArray[2])[1];
        $converted =  convertreal4( $reg2FlowRhigh ,$reg1FlowRlow);
        $parsedArray[] = ["format"=>"real4","regs"=>"1-2","orig"=>$reg2FlowRhigh .$reg1FlowRlow ,"converted"=>$converted,"unit"=>"m^3/h","name"=>"Flow Rate"];

        $regLow = explode(":",$rawDataArray[3])[1];
        $regHigh =  explode(":",$rawDataArray[4])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"3-4","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"GJ/h","name"=>"Energy Flow Rate"];

        $regLow = explode(":",$rawDataArray[5])[1];
        $regHigh =  explode(":",$rawDataArray[6])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"5-6","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"m/s","name"=>"Velocity"];

        $regLow = explode(":",$rawDataArray[7])[1];
        $regHigh =  explode(":",$rawDataArray[8])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"7-8","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"m/s","name"=>"Fluid sound speed "];

        $regLow = explode(":",$rawDataArray[9])[1];
        $regHigh =  explode(":",$rawDataArray[10])[1];
        $converted =  convertLong( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"LONG","regs"=>"9-10","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"Unit is selected by M31, and depends on totalizer multiplier ","name"=>"Positive accumulator"];

        $regLow = explode(":",$rawDataArray[11])[1];
        $regHigh =  explode(":",$rawDataArray[12])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"11-12","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"","name"=>"Positive decimal fraction "];

        $regLow = explode(":",$rawDataArray[13])[1];
        $regHigh =  explode(":",$rawDataArray[14])[1];
        $converted =  convertLong( $regLow ,$regHigh);
        $parsedArray[] = ["format"=>"LONG","regs"=>"13-14","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Negative accumulator"];

        $regLow = explode(":",$rawDataArray[15])[1];
        $regHigh =  explode(":",$rawDataArray[16])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"15-16","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Negative decimal fraction"];

        $regLow = explode(":",$rawDataArray[17])[1];
        $regHigh =  explode(":",$rawDataArray[18])[1];
        $converted =  convertLong( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"long","regs"=>"17-18","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Positive energy accumulator"];

        $regLow = explode(":",$rawDataArray[19])[1];
        $regHigh =  explode(":",$rawDataArray[20])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"19-20","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Positive energy decimal fraction "];

        $regLow = explode(":",$rawDataArray[21])[1];
        $regHigh =  explode(":",$rawDataArray[22])[1];
        $converted =  convertLong($regHigh,$regLow);
        $parsedArray[] = ["format"=>"LONG","regs"=>"21-22","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Negative energy accumulator"];


        $regLow = explode(":",$rawDataArray[23])[1];
        $regHigh =  explode(":",$rawDataArray[24])[1];
        $converted =  convertreal4($regHigh,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"23-24","orig"=>$regLow .$regHigh ,"converted"=>$converted,"unit"=>"NaN","name"=>"Negative energy decimal fraction"];

        $regLow = explode(":",$rawDataArray[25])[1];
        $regHigh =  explode(":",$rawDataArray[26])[1];
        $converted =  convertLong($regHigh,$regLow);
        $parsedArray[] = ["format"=>"LONG","regs"=>"25-26","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Net accumulator"];

        $regLow = explode(":",$rawDataArray[27])[1];
        $regHigh =  explode(":",$rawDataArray[28])[1];
        $converted =  convertreal4($regHigh,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"27-28","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Net decimal fraction"];

        $regLow = explode(":",$rawDataArray[29])[1];
        $regHigh =  explode(":",$rawDataArray[30])[1];
        $converted =  convertLong($regHigh,$regLow);
        $parsedArray[] = ["format"=>"LONG","regs"=>"29-30","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Net energy accumulator"];

        $regLow = explode(":",$rawDataArray[31])[1];
        $regHigh =  explode(":",$rawDataArray[32])[1];
        $converted =  convertreal4($regHigh,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"31-32","orig"=>$regHigh .$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Net energy decimal fraction"];

        $regLow = explode(":",$rawDataArray[33])[1];
        $regHigh =  explode(":",$rawDataArray[34])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"33-34","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"C","name"=>"Temperature #1/inlet"];

        $regLow = explode(":",$rawDataArray[35])[1];
        $regHigh =  explode(":",$rawDataArray[36])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"35-36","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"C","name"=>"Temperature #2/outlet"];

        $regLow = explode(":",$rawDataArray[37])[1];
        $regHigh =  explode(":",$rawDataArray[38])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"37-38","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Analog input AI3"];

        $regLow = explode(":",$rawDataArray[39])[1];
        $regHigh =  explode(":",$rawDataArray[40])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"40-39","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Analog input AI4"];

        $regLow = explode(":",$rawDataArray[41])[1];
        $regHigh =  explode(":",$rawDataArray[42])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"41-42","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Analog input AI5"];

        $regLow = explode(":",$rawDataArray[43])[1];
        $regHigh =  explode(":",$rawDataArray[44])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"43-44","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"mA","name"=>"Current input at AI3 "];

        /*here skipeed to reg 49 since 45-46 and 47-48 are identivcal to reg 43-44 according to the manual*/
        $regLow = explode(":",$rawDataArray[49])[1];
        $regHigh =  explode(":",$rawDataArray[50])[1];
        $convertedLow =  intToBCD($regLow);
        $convertedHigh =  intToBCD($regHigh);
        $converted = $convertedLow.$convertedHigh;
        $parsedArray[] = ["format"=>"BCD","regs"=>"49-50","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"System password "];


        $regLow = explode(":",$rawDataArray[51])[1];
        $converted =  intToBCD($regLow);
        $parsedArray[] = ["format"=>"BCD","regs"=>"51","orig"=> $regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Password for hardware"];

        $regLow = explode(":",$rawDataArray[53])[1];
        $regMid = explode(":",$rawDataArray[54])[1];
        $regHigh =  explode(":",$rawDataArray[55])[1];
        $convertedLow =  intToBCD($regLow);
        $convertedMid =  intToBCD($regMid);
        $convertedHigh =  intToBCD($regHigh);

        $converted = $convertedLow." ".$convertedMid." ".$convertedHigh;

        /*The manual is not very clear at this point
         * Could not maek heads or taile of time stamp. Valueis in them selves do not make sense ex 6152 775 9267 -> (SMHDMY lower first) seconds and or minutes are larger than 60
        *Tested converting via BDC to decimal and use it as a number for Unix timestamp but enden up in the year:
        */

        $parsedArray[] = ["format"=>"BCD","regs"=>"53-54-55","orig"=>$regHigh ." ".$regMid." ".$regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Calendar (date and time)"];

        $regLow = explode(":",$rawDataArray[56])[1];
        $converted =  intToBCD($regLow);
        $parsedArray[] = ["format"=>"BCD","regs"=>"56","orig"=> $regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Day+Hour for Auto-Save"];

        $regLow = explode(":",$rawDataArray[59])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"59","orig"=> $regLow ,"converted"=>$regLow ,"unit"=>"NaN","name"=>"Key to input"];

        $regLow = explode(":",$rawDataArray[60])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"60","orig"=> $regLow ,"converted"=>$regLow ,"unit"=>"NaN","name"=>"Go to Window #"];

        $regLow = explode(":",$rawDataArray[61])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"61","orig"=> $regLow ,"converted"=>$regLow ,"unit"=>"NaN","name"=>"LCD Back-lit lights for number of seconds "];

        /*Strange two 62 in manual*/
        $regLow = explode(":",$rawDataArray[62])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"62","orig"=> $regLow ,"converted"=>$regLow ,"unit"=>"NaN","name"=>"Times for the beeper and Pulses left for OCT  "];

        $regLow = explode(":",$rawDataArray[72])[1];
        $parsedArray[] = ["format"=>"BIT","regs"=>"62","orig"=> $regLow ,"converted"=>$regLow ,"unit"=>"NaN","name"=>"Error Code 16bits, see note 4 "];


        $regLow = explode(":",$rawDataArray[77])[1];
        $regHigh =  explode(":",$rawDataArray[78])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"77-78","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"Ohm","name"=>"PT100 resistance of inlet"];

        $regLow = explode(":",$rawDataArray[79])[1];
        $regHigh =  explode(":",$rawDataArray[80])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"79-80","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"Ohm","name"=>"PT100 resistance of outlet"];

        $regLow = explode(":",$rawDataArray[81])[1];
        $regHigh =  explode(":",$rawDataArray[82])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"81-82","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"micro s","name"=>"Total travel time"];


        $regLow = explode(":",$rawDataArray[83])[1];
        $regHigh =  explode(":",$rawDataArray[84])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"83-84","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"nano s","name"=>"Delta travel time"];

        $regLow = explode(":",$rawDataArray[85])[1];
        $regHigh =  explode(":",$rawDataArray[86])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"85-86","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"micro s","name"=>"Upstream travel time"];


        $regLow = explode(":",$rawDataArray[87])[1];
        $regHigh =  explode(":",$rawDataArray[88])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"87-88","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"micro s","name"=>"Downstream travel time"];

        $regLow = explode(":",$rawDataArray[89])[1];
        $regHigh =  explode(":",$rawDataArray[90])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"89-90","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"mA","name"=>"Output current"];

        $regLow = explode(":",$rawDataArray[92])[1];
        $converted =  convertToIntReg92($regLow);
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"92","orig"=> $regLow ,"converted"=>$converted,"unit"=>"NaN","name"=>"Working step and Signal Quality"];

        $converted = explode(":",$rawDataArray[93])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"93","orig"=> $regLow ,"converted"=>$converted,"unit"=>"Range 0-2047","name"=>"Upstream strength"];

        $converted = explode(":",$rawDataArray[94])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"94","orig"=> $regLow ,"converted"=>$converted,"unit"=>"Range 0-2047","name"=>"Downstream strength"];

        $regLow = explode(":",$rawDataArray[96])[1];
        $parsedArray[] = ["format"=>"INTEGER","regs"=>"96","orig"=> $regLow ,"converted"=> $regLow ,"unit"=>"0 : English，1:Chines","name"=>"Language used in user interface"];

        $regLow = explode(":",$rawDataArray[97])[1];
        $regHigh =  explode(":",$rawDataArray[98])[1];
        $converted =  convertreal4( $regHigh ,$regLow);
        $parsedArray[] = ["format"=>"real4","regs"=>"97-98","orig"=>$regHigh ." ".$regLow ,"converted"=>$converted,"unit"=>"mA","name"=>"The rate of the measured travel time by the calculated travel time"];

        $regLow = explode(":",$rawDataArray[99])[1];
        $regHigh =  explode(":",$rawDataArray[100])[1];
        $converted =  convertreal4( $regHigh ,$regLow);

        $parsedArray[] = ["format"=>"real4","regs"=>"99-100","orig"=>$regHigh ." ".$regLow. "     " ,"converted"=>$converted,"unit"=>"mA","name"=>"Reynolds number"];

        return $parsedArray;
    }



    function getRawDataArray(){

        $rawData  = file_get_contents('http://tuftuf.gambitlabs.fi/feed.txt');
        $rawArray = explode("\n",$rawData);

        return $rawArray;
    }
    /*real4 conversion*/
    function convertreal4($highW,$lowW) {

        if($highW == 0 && $lowW == 0){
            return 0;
        }

        $v = ($highW <<16| $lowW);
        $x = ($v & ((1 << 23) - 1)) + (1 << 23) * ($v >> 31 | 1);
        $exp = ($v >> 23 & 0xFF) - 127;

        return $x * pow(2, $exp - 23);
    }

    /*long conversion*/
    function convertLong($highW,$lowW) {

        $a =  ($highW <<16| $lowW);
        $packed =pack("l", $a);
        $unpacked = unpack("l",$packed);

        return reset($unpacked);
    }

    /*siganl quality reg 92 conversion*/
    function convertToIntReg92($regVal) {
        //test $regVal = 806 should return signalquality 38. Passed.
        $binVAl  = decbin($regVal);
        $rest = substr($binVAl, -8);
        $reg92Converted = bindec($rest);

        return $reg92Converted;
    }


    /*BCD 8421 encoding*/
    function intToBCD($regVAl){
        $digitArray = str_split($regVAl);

        $binVal = "";

        foreach( $digitArray as $key => $digit){

            switch ($digit) {
                case 0:
                    $binVal .= "0000";
                    break;
                case 1:
                    $binVal .= "0001";
                    break;
                case 2:
                    $binVal .= "0010";
                    break;
                case 3:
                    $binVal .= "0011";
                    break;
                case 4:
                    $binVal .= "0100";
                    break;
                case 5:
                     $binVal .= "0101";
                    break;
                case 6:
                    $binVal .= "0110";
                    break;
                case 7:
                    $binVal .= "0111";
                    break;
                case 8:
                    $binVal .= "1000";
                    break;
                case 9:
                    $binVal .= "1001";
                break;

                default:
                break;
            }
        }
        return $binVal;
    }

