<?php
$user = auth()->guard('adminGuard')->user();
?>
<div class="grid_12 header-repeat">
    <div id="branding">
        <div class="floatleft">
            <img src="img/logo.png" alt="Logo"/></div>
        <div class="floatright">
            <div class="floatleft">
                <img src="img/img-profile.jpg" alt="Profile Pic"/></div>
            <div class="floatleft marginleft10">
                <ul class="inline-ul floatleft">
                    <li>Hello <a href="<?= config('general.ADMIN_PROFILE_PAGE'); ?>"><?= $user->name ?? '' ?></a></li>
                    <li><a href="<?= config('general.ADMIN_LOGOUT'); ?>">Logout</a></li>
                    <?php
                    if ($user && $user->rank >= \Kaban\General\Enums\EAdminRank::superAdmin):
                        ?>
                        <li><a href="<?= config('routes.ADMIN_LIST'); ?>">Admins List</a></li>
                    <?php endif; ?>
                </ul>
                <br/>
                <a href="<?= config('general.ADMIN_LOGOUT'); ?>?next=<?= config('routes.REGISTER_ADMIN_PAGE'); ?>">register a new admin</a>
                <br/>
                <span class="small grey">Current Time : <span id="time"></span></span>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
