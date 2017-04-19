<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class jobPostUpdateClass extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function jobPostUpdate()
        {
          $tempDate = $_POST['expiryDate'];
          $expiryDate = date('Y-m-d H:i:s', strtotime($tempDate));

          DB::insert('insert into jobPostDB (userPK, postPurpose, recruiterName, workField, companyInfo, position, jobDesc, workLocation, jobType, jobPeriod, earning, benefits, expiryDate, education, experience, extraDesc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',array($_SESSION['userPK'],$_POST['postPurpose'],$_POST['recruiterName'],$_POST['workField'],$_POST['companyInfo'],$_POST['position'],$_POST['jobDesc'],$_POST['workLocation'],$_POST['jobType'],$_POST['jobPeriod'],$_POST['earning'],$_POST['benefits'],$expiryDate,$_POST['education'],$_POST['experience'],$_POST['extraDesc']));


        }
      }

      $A = new jobPostUpdateClass();
      $A->jobPostUpdate();

      ?>
