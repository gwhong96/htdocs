<!-- 게시글 작성 및 수정 폼 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
 ?>
<!doctype html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="./css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./js/init-alpine.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script type="text/javascript" src="../se2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
  <h3><a href="./list.php"><img src="../img/logo.svg"/></a></h3>
  <?php
  $boardInfo = array();
  $boardID = '';

  if(isset($_GET['boardID'])){
    $boardID = $_GET['boardID'];
    $sql = "SELECT m.memberID FROM member m JOIN board b ON (m.memberID = b.memberID) WHERE boardID = "."$boardID";
    $result2 = $dbConnect -> query($sql);
    $boardInfo2 = $result2 -> fetch_array(MYSQLI_ASSOC);

    $sql_up = "SELECT * FROM upload_file WHERE boardID = {$boardID}";
    $result_up = $dbConnect -> query($sql_up);
    $uploadInfo = $result_up -> fetch_array(MYSQLI_ASSOC);

    if($boardInfo2['memberID'] == $_SESSION['memberID']){//현재 로그인 계정과 게시글 작성자가 같을때
      echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>Write</h4>";
      $boardID = $_GET['boardID'];
      $sql = "select * from board where boardID = {$boardID}";
      $result = $dbConnect -> query($sql);
      $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
    }else{
      echo "수정 권한이 없습니다."."<br>";

      echo "<a href = './list.php'> 게시글 목록으로 돌아가기</a>";
      exit;
    }
  }else{
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>게시글 작성</h4>";
  }
   ?>
<div class="flex items-center justify-center p-6 sm:p-12">
   <div class="w-full" style = "padding-left:20%">
   <form name = "boardWrite" method = "post" action = "./write_ok.php" enctype="multipart/form-data">
     <input type="hidden" value='<?=$boardID?>' name = "boardID">
     <label class="block text-sm">
       <span class="text-gray-700 dark:text-gray-400">Title</span>
     <br>
     <input style = "background-color : lightgray" type = "text" name = "title" class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required value = "<?= (isset($boardInfo['title']) ? $boardInfo['title'] : '') ?>"></input>
    </label>
     <br>
     <label class="block text-sm">
     <span class="text-gray-700 dark:text-gray-400">Content</span>
     <br>
     <textarea name="content" id="ir1" rows="10" cols="100"><?= (isset($boardInfo['content']) ? $boardInfo['content'] : '') ?></textarea>
     <!-- <textarea style = "background-color : lightgray" name = "content" cols = "80" rows = "10" required><?= (isset($boardInfo['content']) ? $boardInfo['content'] : '') ?></textarea> -->
    </label>
     <br>
     <label class="block text-sm">
     <span class="text-gray-700 dark:text-gray-400">Upload File</span>
     <input style="background:gray" type="file" name="upfile[]" multiple='multiple' class="items-center px-4 py-2 text-sm font-medium text-white rounded-lg" > </input>
    </label>
     <!-- 다중 첨부파일 추가 -->
     <br>
     <span class="text-gray-700 dark:text-gray-400">Lock</span>
     <?php
     if(isset($boardInfo['disYN'])){//게시글 수정일때

       if($boardInfo['disYN'] == 'N'){
         $checkYN = "checked";//기존 공개여부가 N이면 체크
       }else{
         $checkYN = "";
       }
     }else{$checkYN = "";}//게시글 작성일땐 체크 안함
     ?>
     <input type = "checkbox" name = "disYN" value = "N" <?= $checkYN ?>/><br>
     <span class = "text-gray-700 dark:text-gray-400">Password</span>
     <input style = "background-color : lightgray" type = "password" name = "boardPW">
     <button id="savebutton" style = "background:gray; float:right; margin-right:45%" class="items-center px-4 py-2 text-sm font-medium text-white rounded-lg" type = "submit">저장</button>
   </form>
</div>
</div>

     <!--작성 완료-->

</body>
<script type="text/javascript">

$(function(){    //전역변수선언
      var editor_object = [];
           nhn.husky.EZCreator.createInIFrame({
            oAppRef: editor_object,
            elPlaceHolder: "ir1",
            sSkinURI: "../se2/SmartEditor2Skin.html",
            htParams : {// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                  bUseToolbar : true,// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                  bUseVerticalResizer : true,// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                  bUseModeChanger : true,
     }    
   });
   //전송버튼 클릭이벤트
   $("#savebutton").click(function(){//id가 smarteditor인 textarea에 에디터에서 대입
             editor_object.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
     // 이부분에 에디터 validation 검증
     //폼 submit
     $("#form").submit();
    })
})




</script>
</html>
