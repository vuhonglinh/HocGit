var checkAll = document.getElementById("checkAll");
checkAll.addEventListener("click", function () {
    var checkItem = document.querySelectorAll(".checkItem");
    if (checkAll.checked == true) {
        for (var i = 0; i < checkItem.length; i++) {
            checkItem[i].checked = true;
        }
    } else {
        for (var i = 0; i < checkItem.length; i++) {
            checkItem[i].checked = false;
        }
    }
});

