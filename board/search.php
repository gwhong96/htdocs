<!--검색 폼-->
<br><br>
<form name = "search" method = "get" action = "./list.php">
  <br>
  <input style = "background:lightgray" class="items-center px-3 py-1 text-sm font-medium rounded-lg" value="<?= (isset($searchKeyword) ? $searchKeyword : '') ?>" type = "text" name = "searchKeyword" placeholder = "검색어 입력" required/>
  <select style = "background:gray" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" name = "option" required>
  <option value = "title">제목</option>
  <option value = "content">내용</option>
  <!-- <option value = "tandc">제목과 내용</opthion> -->
  <option value = "writer">작성자</option>
  <option value = "torc">제목 또는 내용</option>
</select>
<!-- <button type = "submit" value = "검색"/> -->
<button style="background:gray" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">검색</button>
</form>
