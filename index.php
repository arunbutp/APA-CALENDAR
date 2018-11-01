<?Php
   $start_year=1986; // Starting year for dropdown list box
   $end_year=2020;  // Ending year for dropdown list box
   ?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
   <head>
      <title>Calendar Assignment</title>
      <script src="cal.js"></script>
      <link rel="stylesheet" type="text/css" href="cal.css">
   </head>
<body>
   <?Php
      @$month=$_GET['month'];
      @$year=$_GET['year'];
      
      if(!($month <13 and $month >0)){
      $month =date("m");  // Current month as default month
      }
      
      if(!($year <=$end_year and $year >=$start_year)){
      $year =date("Y");  // Set current year as default year 
      }
      
      $d= 2; // To Finds today's date
      //$no_of_days = date('t',mktime(0,0,0,$month,1,$year)); //This is to calculate number of days in a month
      $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);//calculate number of days in a month
      
      $j= date('w',mktime(0,0,0,$month,1,$year)); // This will calculate the week day of the first day of the month
      //echo $j;
      $adj=str_repeat("<td style='color:green'>*&nbsp;</td>",$j);  // Blank starting cells of the calendar 
      $blank_at_end=42-$j-$no_of_days; // Days left after the last day of the month
      if($blank_at_end >= 7){$blank_at_end = $blank_at_end - 7 ;} 
      $adj2=str_repeat("<td style='color:green'>*&nbsp;</td>",$blank_at_end); // Blank ending cells of the calendar
      
      /// Starting of top line showing year and month to select ///////////////
      echo "<form action='self' method='post'>";
      echo "<table class='main'><td colspan=6 >
      <select name=month value='' onchange=\"reload(this.form)\" id=\"month\">
      <option value=''>Select Month</option>";
      for($p=1;$p<=12;$p++){
      
      $dateObject   = DateTime::createFromFormat('!m', $p);
      $monthName = $dateObject->format('F');
      if($month==$p){
      echo "<option value=$p selected>$monthName</option>";
      }else{
      echo "<option value=$p>$monthName</option>";
      }
      }
      echo "</select>
      <select name=year value='' onchange=\"reload(this.form)\" id=\"year\">Select Year</option>
      ";
      for($i=$start_year;$i<=$end_year;$i++){
      if($year==$i){
      echo "<option value='$i' selected>$i</option>";
      }else{
      echo "<option value='$i'>$i</option>";
      }
      }
      echo "</select>";
      echo " </td><td align='center'></td></tr></table></form>";                
      echo "<table class='main'><tr style='background-color: #7a7aa0;'><td colspan=7  align='center' >";
      for($p=1;$p<=12;$p++){
      $dateObject   = DateTime::createFromFormat('!m', $p);
      $monthName = $dateObject->format('F');
      if($month==$p){
      echo $monthName."-";
      }
      }
      
      for($i=$start_year;$i<=$end_year;$i++){
      if($year==$i){
      echo $i;
      }
      }        
      
      echo " </td></tr><tr>";
      echo "<th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr><tr>";
      
      ////// End of the top line showing name of the days of the week//////////
      
      //////// Starting of the days//////////
      for($i=1;$i<=$no_of_days;$i++){
      $pv="'$month'".","."'$i'".","."'$year'";
      echo $adj."<td><a href='#' onclick=\"post_value($pv);\">$i</a>"; // This will display the date inside the calendar cell
      echo " </td>";
      $adj='';
      $j ++;
      if($j==7){echo "</tr><tr>"; // start a new row
      $j=0;}
      
      }
      echo $adj2;   // Blank the balance cell of calendar at the end  
      echo "</tr></table>";
      ?>
</body>
</html>