

<form name = "search" method = "post" action = "./result.php">
  <br>
  <input type = "text"name = "searchKeyword" placeholder = "검색어 입력" required/>
  <select name = "option" required>
  <option value = "title">제목</opthion>
  <option value = "comment">내용</opthion>
  <option value = "tandc">제목과 내용</opthion>
  <option value = "torc">제목 또는 내용</opthion>
</select>
<input type = "submit" value = "검색" />
</form>
