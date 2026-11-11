</div>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.onscroll = function() {
        myFunction()
    };

    var header = document.getElementById("dashboardHeader");

    function myFunction() {
        if (window.pageYOffset > 10) { // start after 100px scroll
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
<script>
    // function showsubMenuDiv() {
    //     var htmlShow = document.getElementById("subMenu");
    //     if (htmlShow.style.display === "block") {
    //         htmlShow.style.display = "none";
    //     } else {
    //         htmlShow.style.display = "block";
    //     }
    // }

    function showManageUser() {
        var htmlShow = document.getElementById("submenuUser");
        if (htmlShow.style.display === "block") {
            htmlShow.style.display = "none";
        } else {
            htmlShow.style.display = "block";
        }
    }
</script>






<script>
function showsubMenuDiv() {
    var htmlShow = document.getElementById("subMenu");
    if (htmlShow.style.display === "block") {
        htmlShow.style.display = "none";
    } else {
        htmlShow.style.display = "block";
    }
}

// Optional: keep submenu open if the current page is active
window.addEventListener('DOMContentLoaded', function() {
    var currentRoute = "{{ Route::currentRouteName() }}"; // Laravel current route
    var subMenu = document.getElementById("subMenu");
    if(currentRoute === "designer.rfq" || currentRoute === "designer.received.quotation") {
        subMenu.style.display = "block";
    }
});
</script>



</body>

</html>