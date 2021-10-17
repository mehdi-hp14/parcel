<div class="grid_12 header-repeat">
    <div id="branding">
        <div class="floatleft">
            <img src="img/logo.png" alt="Logo" /></div>
        <div class="floatright">
            <div class="floatleft">
                <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
            <div class="floatleft marginleft10">
                <ul class="inline-ul floatleft">
                    <li>Hello <a href="<?= config('general.ADMIN_PROFILE_PAGE'); ?>"><?= auth()->guard('adminGuard')->user()->name ?? 'Admin' ?></a></li>
                    <li><a href="<?= config('general.ADMIN_LOGOUT'); ?>">Logout</a></li>
                </ul>
                <br />
                <span class="small grey">Current Time : <span id="time"></span></span>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
