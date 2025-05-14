let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

document.addEventListener("DOMContentLoaded", function(){
   document.querySelector(".bx-menu").addEventListener("click", function(e){
      e.preventDefault();
      var navi = document.querySelector(".sidebar");
      var header = document.querySelector(".c-header.c-header-fixed");
      var container = document.querySelector(".container-fluid");
      var title = document.querySelector(".c-header-title");
      var navi_ativo = navi.dataset.ativo;
      var navi_header = header.dataset.ativo;
      var navi_container = container.dataset.ativo;
      var navi_title = title.dataset.ativo;
      navi.setAttribute("data-ativo", navi_ativo == "open" ? "close" : "open");
      header.setAttribute("data-ativo", navi_header == "open" ? "close" : "open");
      container.setAttribute("data-ativo", navi_container == "open" ? "close" : "open");
      title.setAttribute("data-ativo", navi_title == "open" ? "close" : "open");
   });
});
