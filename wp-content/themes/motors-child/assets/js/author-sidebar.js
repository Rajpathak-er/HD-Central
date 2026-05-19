var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

jQuery(".stm-usersidebar-left .submenu a.active").parents('.submenu').css("display", "block");


jQuery(".stm-usersidebar-left .submenu a.active").parents('.submenu').parent(".hasmenu").find(jQuery(".parent-menu")).addClass("active");