<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    #bugForm{
      text-align: left;
      width: 800px;
      margin-left: auto;
      margin-right: auto;
    }
    .contentsFrame{
      margin-bottom: 30px;
    }
    .label{
      font-size: 1.3rem;
      color: #262626 ;
      font-weight: 400;
    }

    .inputHint{
      margin-bottom: 0px;
      margin-top: 0.5rem;
      font-size: 0.8rem;
      font-weight: 200;
    }
    #title, #description{
      width: 100%;
      resize: none;
      overflow-y: auto;
    }
    #title{
      height: 50px;
      border-color: #999;
    }
    #description{
      height: 100px;
      border-color: #999;
    }
    h1{
      border-bottom: 3px solid #000;
      margin: 0;
      margin-bottom: 0.5rem;
    }
    #submitBt{
      margin-left: auto;
      margin-right: auto;
      display: block;
      background-color: white;
      color: black;
      font-size: 1rem !important;
      width: 100px;
      height: 30px;
      border: 1px solid #e6e6e6 ;
      border-radius: 3px;
      transition: 0.15s all;
    }
  </style>

</head>
<body>

  <link rel="stylesheet" type ="text/css" href="css/informationEdit.css">
  <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
  <div id = "header">
    <?php
    include_once('../resources/views/header.php');
    ?> 
  </div>

  <div id = "uploadContent">
    <form id="bugForm" action="/bugSend" method="POST">

      <h1>버그 리포트</h1>

      <div class="contentsFrame">
        <label class="label inputLabel">분류</label><br>
        <input id="bugRadio" type="radio" name="issue" value="bug" checked>버그<br>
        <input id="improvementRadio" type="radio" name="issue" value="improvement">개선사항/건의<br>
        <input id="chatRadio" type="radio" name="issue" value="chat">개발자와 대화 요청<br>
      </div>
      
      <div class="contentsFrame">
        <label class="label inputLabel">제목</label>
        <p class="inputHint">관련 제목을 간결하게 한 문장으로 써주십시오.</p>
        <textarea id="title" name="title"></textarea>
      </div>

      <div class="contentsFrame">
        <label class="label inputLabel">내용</label>
        <p class="inputHint">내용을 자세히 작성해주십시오. <br>(버그 제보: 어떤 페이지에서 어떠한 버그가 일어나는지 상세히 적어주시면 수정시간이 단축됩니다.)</p>
        <textarea id="description" name="description"></textarea>
      </div>

      <div class="contentsFrame">
        <label class="label inputLabel">브라우저 종류</label>
        <p class="inputHint">사용하고 있는 브라우저의 종류를 선택해 주십시오.<br>
          <input id="bugRadio" type="radio" name="browser" value="Internet Explorer" checked>Internet Explorer<br>
          <input id="improvementRadio" type="radio" name="browser" value="Chrome">Chrome<br>
          <input id="chatRadio" type="radio" name="browser" value="Firefox">Mozila Firefox<br>
          <input id="chatRadio" type="radio" name="browser" value="Safari">Safari<br>
          <input id="chatRadio" type="radio" name="browser" value="Opera">Opera<br>
        </div>

        <input id="submitBt" type="submit">

      </form>

    </div>

    <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type = "text/javascript" src = "js/informationEdit.js"></script>
    <script type="text/javascript"></script>
  </body>
  </html>
