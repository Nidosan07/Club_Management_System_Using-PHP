 <!-- Navbar -->
 <?php

class YourClass {
    public function sess_des() {
        // Start or resume session
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Return true to indicate successful session destruction
        return true;
    }

    public function slogout() {
        if ($this->sess_des()) {
            // Redirect to the login page
            redirect('student/login.php');
        }
    }
}



// Create an instance of YourClass
$yourInstance = new YourClass();

// Check if the logout URL is accessed
if (isset($_GET['logout'])) {
    // Call the logout function
    $yourInstance->slogout();
}

?>


 <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="./" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
                        <?= $_settings->info('short_name') ?>
                        </a>
                            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon mt-2">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </span>
                            </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "home" ? "text-primary" : "" ?>" href="./" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i> Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "clubs" ? "text-primary" : "" ?>" href="./?page=clubs" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">widgets</i> Clubs
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "Club_events" ? "text-primary" : "" ?>" href="./?page=Club_events" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">widgets</i> Events
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center <?= $page == "about" ? "text-primary" : "" ?>" href="./?page=about" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">info</i> About Us
                                    </a>
                                </li>
                                <!-- <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" href="./admin" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">admin_panel_settings</i> Admin Login
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" href="../club_admin" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">person</i> Club Admin/Staff Login
                                    </a>
                                </li> -->
                                <li class="nav-item my-auto ms-3 ms-lg-0">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><img src="<?= validate_image($_settings->userdata('avatar')) ?>" alt="<?= $_settings->userdata('username') ?> Image" class="image-user img-thumbnail rounded-circle"></span>
                                        Hi, <?= $_settings->userdata('username') ?>
                                        <img src="<?= base_url ?>assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">
                                        <div class="d-lg-block d-sm-block">
                                        <ul class="list-group">
                                            <li class="nav-item list-group-item border-0 p-0">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="<?= base_url ?>student/?page=manage_account">
                                                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0"><span class="material-icons me-2">manage_accounts</span> Manage Account</h6>
                                                </a>
                                            </li>
                                            <li class="nav-item list-group-item border-0 p-0">
                                                <a class="dropdown-item py-2 ps-3 border-radius-md" href="?logout=true">
                                                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0"><span class="material-icons me-2">logout</span> Logout</h6>
                                                </a>
                                            </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>