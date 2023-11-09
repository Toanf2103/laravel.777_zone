<header>
    <div class="head d-flex align-items-center justify-content-center">
        <div class="header-logo">
            <a href="#">
                <img src="https://cdn.freebiesupply.com/images/large/2x/google-logo-transparent.png" alt="">
            </a>
        </div>
        <ul class="header-menu d-flex align-items-center justify-content-start ">
            <li class="active">
                <a href="#">Iphone</a>
            </li>
            <li>
                <a href="#">Iphone</a>
            </li>
            <li>
                <a href="#">Iphone</a>
            </li>
            <li>
                <a href="#">Iphone</a>
            </li>
            <li>
                <a href="#">Iphone</a>
            </li>
        </ul>
        <div class="d-flex align-items-center gap-3 header-search_cart justify-content-center ">
            <div class="wrapper-icon" onclick="showSearchForm()">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="wrapper-icon">
                <i class="fa-sharp fa-solid fa-cart-shopping"></i>
            </div>
            <div class="login dropdown">
                <!-- <a href="#">Đăng nhập</a> -->
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF7TvgBaM6ZAsPwj9vSPIYbrgptnGsQTKOTx92T_R1hdjIMwbwchEExCIdxVAdCAAVi74&usqp=CAU" alt="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>

        <form action="" class="header-form-search d-flex align-items-center gap-3 none">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Tìm kiếm sản phẩm">
            <i class="fas fa-times" onclick="hiddenSearchForm()" style="cursor: pointer;"></i>
        </form>

    </div>
</header>
<div class="bg-overlay none" id="bg-overlay">

</div>