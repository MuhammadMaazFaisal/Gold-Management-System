

<?php

  // $user_id = $_SESSION['user_id'];
  
  // if(!isset($_SESSION['user_id']))
  // {
  //   //User not logged in. Redirect them back to the login page.
  //   header('Location: login.php');
  //   exit; 
  // }

  $journal_title= $journal_url= $journal_code= $journal_type= $journaltype_code= $issn_online= $issn_print= $aims_scope=$journal_impact_factor=$journal_status="";
  






      $journal_code ="CMC";
     
   

         
       
    
        $jcode=strtoupper($journal_code);
        //adding file in the directory
        if (file_exists('article-archive/accepted-articles/'.$jcode)) {
        //   mkdir('article-archive/accepted-articles/'.$jcode, 0777, true);
          chmod('article-archive/accepted-articles/'.$jcode, 0777);
      }
      if (file_exists('article-archive/published-articles/'.$jcode)) {
        // mkdir('article-archive/published-articles/'.$jcode, 0777, true);
        chmod('article-archive/published-articles/'.$jcode, 0777);
    }
       ?>
