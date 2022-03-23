function searchClick() {
  var url = "search.php";
  var params = "?search_title=";
  var searchValue = document.getElementById("searchInput").value;
  if(searchValue != "") {
    window.location.href= url + params + searchValue;
  }
}