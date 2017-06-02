<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class getRecentClass extends Controller
{
  public function getRecent()
  {

    $sentence = "select * from Recent order by recentPK desc limit 1";
    $a = DB::select($sentence);
    $artPKArr = array();
    $artPKArr[0] = 0;
    $artPKArr[1] = 0;
    $artPKArr[2] = 0;
    $artPKArr[3] = 0;
    foreach($a as $b){
      $artPKArr[0] = $b->artPK1;
      $artPKArr[1] = $b->artPK2;
      $artPKArr[2] = $b->artPK3;
      $artPKArr[3] = $b->artPK4;
    }
//================
        //bootstrap
        //================
    // <link href="css/gbscss/bootstrap.min.css" rel="stylesheet" type="text/css" />
    // <link href="css/gbscss/owl.carousel.css" rel="stylesheet">
    // <link href="css/gbscss/style.css" rel="stylesheet" type="text/css" />
    echo'
    <link href="css/works.css" rel="stylesheet" type="text/css" />
    <link href="css/worksPlus.css" rel="stylesheet" type="text/css" />


    <script src="js/gbsjs/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/gbsjs/superfish.min.js" type="text/javascript"></script>
    <script src="js/gbsjs/owl.carousel.js" type="text/javascript"></script>
    <script src="js/gbsjs/myscript.js" type="text/javascript"></script>

    ';

    // <!-- CONTAINER -->
    // <div class="container">
    //   <h2><b>Newest</b> Projects</h2>
    // </div><!-- //CONTAINER -->

    echo '<section id="projects02" class="padbot20">

    <div class="projects-wrapper" data-appear-top-offset="-200" data-animated="fadeInUp">
      <!-- PROJECTS SLIDER -->
      <div class="owl-demo owl-carousel projects_slider">';
        //================
        //bootstrap
        //================
        for($i = 0 ; $i < 4; $i++){
          if($artPKArr[$i]==0){
            break;
          }
          $Sentence2 = "select * from totalart where artPK = ".$artPKArr[$i];
          $getArts = DB::select($Sentence2);

          foreach($getArts as $getArt){
            $GLOBALS['artURL']=$getArt->ArtURL;
            $GLOBALS['uploaderName'] = $getArt->uploaderName;
            $GLOBALS['title'] = $getArt->title;
          }
          if(self::urlCheck($GLOBALS['artURL'])=="youtube"){

            $yvID = self::matchYoutubeUrl($GLOBALS['artURL']);
            $GLOBALS['artURL'] = "https://img.youtube.com/vi/".$yvID.'/hqdefault.jpg';

          }

          $Sentence3 = "select A.userPK ,Position, Name, checkCredit from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$artPKArr[$i];
          $getBridges = DB::select($Sentence3);

////////////////////////////
          // <!-- work1 -->
          echo '
          <div class="item">
            <div class="work_item">
              <a href="post?int='.$artPKArr[$i].'">
                <div class="work_img">
                  <img src="'.$GLOBALS['artURL'].'" alt="" />
                </div>
              </a>
              <p class="workTitle">'.$GLOBALS['title'].'</p>
              <div class="credit">
                <div class="position_Frame">';
                  $k = 0;
                  foreach($getBridges as $getBridge){
                    if($getBridge->checkCredit==1){
                      echo '<p class="position">'.$getBridge->Position.'</p>';
                    }else{
                      echo '<p class ="noCreditposition">'.$getBridge->Position.'</p>';
                    }
                    $k+=1;
                    /*
                    if($k >= 4){
                      break;
                    }
                    */
                  }
                  $Sentence2 = "select position from TagNotUser where artPK =".$artPKArr[$i];
                  $users2 = DB::select(DB::raw($Sentence2));
                  foreach($users2 as $user){
                    echo "<p class = 'noCreditposition'>".$user->position."</p>";
                  }

                  echo '</div>
                  <div class="splitter">
                  </div>
                  <div class="name_Frame">';
                    $k = 0;
                    foreach($getBridges as $getBridge){
                      if($getBridge->checkCredit==1){
                        echo '<a href = /anotherProfile?int='.$getBridge->userPK.'><p class="name">'.$getBridge->Name.'</p></a>';
                      }else{
                        echo '<a href = /anotherProfile?int='.$getBridge->userPK.'><p class="noCreditname">'.$getBridge->Name.'</p></a>';
                      }
                    /*
                    $k+=1;
                    if($k >= 4){
                      break;
                    }
                    */
                  }
                  $Sentence2 = "select tagUser from TagNotUser where artPK =".$artPKArr[$i];
                  $users2 = DB::select(DB::raw($Sentence2));
                  foreach($users2 as $user){
                    echo "<p class = 'noCreditname'>".$user->tagUser."</p>";
                  }

                  echo '</div>
                </div>';
              //   <!-- <div class="work_description">
              //   <div class="work_descr_cont">
              //     <a href="portfolio-post.html" >Ginger Beast</a>
              //     <span>17 March, 2041</span>
              //   </div>
              // </div> -->
                echo'</div>
              </div>
              ';
          // <!-- //work1 -->
            }
////////////////////////////
                // <p class="workReference">'.$GLOBALS['uploaderName'].'</p> 작성자 이름
        //     echo '<div class="RecentWork">
        //       <a href="/post?int='.$artPKArr[$i].'">
        //         <img class="RecentWorkPic" src="'.$GLOBALS['artURL'].'"></a>
        //         <p class = "workTitle">'.$GLOBALS['title'].'</p>
        //         <div class="credit">
        //           <div class="position_Frame">';

        //             $k = 0;
        //             foreach($getBridges as $getBridge){
        //               if($getBridge->checkCredit==1){
        //                 echo '<p class="position">'.$getBridge->Position.'</p>';
        //               }else{
        //                 echo '<p class ="noCreditposition">'.$getBridge->Position.'</p>';
        //               }
        //               $k+=1;
        //               /*
        //               if($k >= 4){
        //                 break;
        //               }
        //               */
        //             }
        //             $Sentence2 = "select position from TagNotUser where artPK =".$artPKArr[$i];
        //             $users2 = DB::select(DB::raw($Sentence2));
        //             foreach($users2 as $user){
        //               echo "<p class = 'noCreditposition'>".$user->position."</p>";
        //             }

        //           echo '</div>
        //           <div class="splitter">
        //           </div>
        //           <div class="name_Frame">';
        //           $k = 0;
        //           foreach($getBridges as $getBridge){
        //             if($getBridge->checkCredit==1){
        //               echo '<a href = /anotherProfile?int='.$getBridge->userPK.'><p class="name">'.$getBridge->Name.'</p></a>';
        //             }else{
        //               echo '<a href = /anotherProfile?int='.$getBridge->userPK.'><p class="noCreditname">'.$getBridge->Name.'</p></a>';
        //             }
        //             $k+=1;
        //             /*
        //             if($k >= 4){
        //               break;
        //             }
        //             */
        //           }
        //           $Sentence2 = "select tagUser from TagNotUser where artPK =".$artPKArr[$i];
        //           $users2 = DB::select(DB::raw($Sentence2));
        //           foreach($users2 as $user){
        //             echo "<p class = 'noCreditname'>".$user->tagUser."</p>";
        //           }

        //           echo '</div>
        //         </div>
        //     </div>';

        // }

            echo '</div></div></section>';
            echo '<input id = "getrecent0" type = "hidden" value='.$artPKArr[0].'>
            <input id = "getrecent1" type = "hidden" value='.$artPKArr[1].'>
            <input id = "getrecent2" type = "hidden" value='.$artPKArr[2].'>
            <input id = "getrecent3" type = "hidden" value='.$artPKArr[3].'>
            ';
          }

          public function urlCheck($url){
            if(self::matchYoutubeUrl($url) != false){
              return "youtube";
            }else{
              return "image";
            }
          }

          public function matchYoutubeUrl($url) {
            $p = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i';
            if(preg_match($p,$url,$matches)==1){
          return $matches[1]; // returns Youtube ID
        }
        return false;
      }

    }
    $B = new getRecentClass();
    $B->getRecent();

    ?>
